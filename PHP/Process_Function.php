<?php

function register ($user, $pass, $pass2, $email){
	global $db;
	
	$invalid = False;
	//Validate Email
	if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
		echo "Invalid email<br>";
		$invalid=True;
		//redirect("Invalid email", "/registration.php", 3);
		//exit();
	}
	
	if($pass != $pass2){
		echo "Your passwords do not match<br>";
		$invalid=True;
	}
	
	//Check if Username is in database
	$s = "select * from gds_users where user = '$user'" ;
  $t = mysqli_query ( $db , $s );
  $num =  mysqli_num_rows($t); 
  if ( $num > 0 ) {
		echo "Username is already taken<br>";
		$invalid=True;
		//redirect("Username is already taken", "/registration.php", 3);
	  //exit();
	}
	
	if($invalid){
		redirect("Re-enter credentials", "/~rc425/GDSRatings/registration.php", 3);
		exit();
	}
	
	//Insert user into database
  $pass = sha1($pass);
	$insert = "insert into gds_users value ( 0, '$user', 0, '$pass', '$email', 0 )";
  echo "<br> $insert <br> <br>";
  $t = mysqli_query ( $db , $insert );
	
}

function auth ($user, $pass, &$t) { 
  global $db;
  $pass = sha1($pass);
  $s = "select * from gds_users where user = '$user' and password = '$pass'" ;
  echo "<br> $s <br> <br>";
  $t = mysqli_query ( $db , $s );
  $num =  mysqli_num_rows($t); 
  if ( $num > 0 ) {
	  $t = true;
	} else {   
		$t = false;
	}
}

function authVerify ($user, $pass, &$t)
	{ 
  global $db;
  $s = "select * from gds_users where user = '$user' and password = '$pass'" ;
  echo "<br> $s <br> <br>";
  $t = mysqli_query ( $db , $s );
  $num =  mysqli_num_rows($t); 
  if ( $num > 0 ) {
	  $t = true;
	} else {   
		$t = false;
	}
}

function getdata($index, &$result){
	global $db;
  global $bad;
	
  if (!isset($_POST[$index])) {
	  $bad = true; 
	  echo " $index is undefined data <br> "; 
	  return;
	}
	
  if (($_POST[$index]) == "") {
	  $bad = true; 
	  echo"$index empty data <br> "; 
	  return;
	} else {
		echo "$_POST[$index] <br>";
	}
  $result = mysqli_real_escape_string ($db, $_POST[ $index ]);
}

function clearbase() {
	global $db;
	$s = "TRUNCATE TABLE gds_food";
	$t = mysqli_query($db, $s) or die (mysqli_error($s));
	$s = "TRUNCATE TABLE gds_ratings";
	$t = mysqli_query($db, $s) or die (mysqli_error($s));
}

function isAdmin(){
	global $db;
	$user = $_SESSION["user"];
	$s = "select * from gds_users where user = '$user'";
	$t = mysqli_query( $db, $s );
	$r = mysqli_fetch_array($t, MYSQLI_ASSOC);
	$checkAdmin=$r[ "Admin"];
	if($checkAdmin=="1"){
		return true;
	}
	return false;
}

function cleardata() {
	$time = date("H:i:s");
	if ($time > "23:23:23"){
		clearbase();
	}
	if ("15:30:00" < $time){
		if($time < "16:30:00"){
			clearbase();
		}
	}
	if( "10:00:00" < $time) {
		if($time < "11:00:00"){
		clearbase();
		}
	}
	if ($time < "7:00:00"){
		clearbase();
	}
}

function insertFoodItem($item, $category, $rating = 0) {
	global $db;
	
	$duplicate = false;
	
	$selectQuery = "select * from gds_food";
	$selectResults = mysqli_query($db, $selectQuery) or die (mysqli_error($db));
	
	$food_id = 0; // Will be used for associating a rating with the food item
	
	$thisItem = strtolower($item);
	$thisItem = preg_replace('/\s+/', '', $thisItem);
	
	while ($selectRow = mysqli_fetch_array($selectResults, MYSQLI_ASSOC) ){	
		
		$otherItem = $selectRow["name"];
		$otherItem = strtolower($otherItem);
		$otherItem = preg_replace('/\s+/', '', $otherItem);
		
		if ($thisItem == $otherItem) {
			$food_id = $selectRow["id"];
			$duplicate = true;
			break;
		}
	}
	
	if (!$duplicate) {
		// Add new entry
		$insertQuery = "insert into gds_food values (0, 0, $category , '$item' , 0, NOW())";
		$insertResults = mysqli_query($db, $insertQuery) or die (mysqli_error($db)); 
		$food_id = mysqli_insert_id($db);
	}
	
	if ($rating != 0 && !empty($rating)) {
		$s = "insert into gds_ratings values (0, '$food_id', '$rating', NOW())";
		$t = mysqli_query($db, $s) or die (mysqli_error($db));
	}
}

function insertRating($foodId, $rating) {
	$s = "insert into gds_ratings values (0, '$foodId', '$rating', NOW())";
	$t = mysqli_query($db, $s) or die (mysqli_error($db));
}

function show($user, &$out){
	global $db;
	
	$s="select * from gds_users where user = '$user' ";  
	$out .= "<br>SQL statement is: $s<br>";
	$t = mysqli_query($db, $s) or die (mysqli_error($db));
	while (   $r = mysqli_fetch_array($t, MYSQLI_ASSOC) ){	
	  $user = $r["user"];
	  $balance  = $r["cur_balance"];
     $out .= "<br> user is: $user <br>  current_balance is: $$balance <br><br>";
     }
	$s="select*from T where user = '$user' order by date desc";  
	$t = mysqli_query($db, $s) or die (mysqli_error($db));
	while (   $r = mysqli_fetch_array($t, MYSQLI_ASSOC) ){	
	  $date = $r["date"];
	  $amount  = $r["amount"];
    $type = $r["type"];
     $out .= "<br> date is: $date <br>  transaction type is: $type and amount is: $$amount <br><br>"; 	
  }
  echo $out;
}

function showItems($category) {
	global $db;
	$s = "select * from gds_food where category=$category";
	$t = mysqli_query($db, $s) or die (mysqli_error($db));
	
	$food_ids = array(); // These will be used to get the prefixes for all IDs for all stars
	
	while ($r = mysqli_fetch_array($t, MYSQLI_ASSOC)) {	
		$name = $r["name"];
		$food_id = $r["id"];

		$ratingQuery = "select * from gds_ratings where food_id=" . $food_id;
		$ratingResults = mysqli_query($db, $ratingQuery) or die (mysqli_error($db));

		$ratingSum = 0;
		$ratingNum = 0;
		while ($ratingRow = mysqli_fetch_array($ratingResults, MYSQLI_ASSOC)) {	
			$ratingNum++;
			$ratingSum += $ratingRow["rating"];
		}

		if ($ratingNum == 0) {
			$ratingAvg = "?";
		} else {
			$ratingAvg = $ratingSum / $ratingNum;
			$ratingAvg = number_format( (float) $ratingAvg , 1, '.', '');
		}


		// Construct what will be displayed
		$output =  '<div class="col-md-8 col-sm-12 panel panel-default">' .
							 '<div class="panel-body" style="padding: 8px">' .
							 '<h4>' . $name . '</h4>' .
							 '<div class="starGroup" data-rating="' . (floor($ratingAvg)-1) . '">';
		
		// Generate stars, making the right ones selected
		$output .= '<i class="fa ';
		($ratingAvg >= 1) ? ($output .= 'fa-star') : ($output .= 'fa-star-o');
		$output .= '" aria-hidden="true" id="star_'.$food_id.'_1"></i>';
		
		$output .= '<i class="fa ';
		($ratingAvg >= 2) ? ($output .= 'fa-star') : ($output .= 'fa-star-o');
		$output .= '" aria-hidden="true" id="star_'.$food_id.'_2"></i>';
		
		$output .= '<i class="fa ';
		($ratingAvg >= 3) ? ($output .= 'fa-star') : ($output .= 'fa-star-o');
		$output .= '" aria-hidden="true" id="star_'.$food_id.'_3"></i>';
		
		$output .= '<i class="fa ';
		($ratingAvg >= 4) ? ($output .= 'fa-star') : ($output .= 'fa-star-o');
		$output .= '" aria-hidden="true" id="star_'.$food_id.'_4"></i>';
		
		$output .= '<i class="fa ';
		($ratingAvg >= 5) ? ($output .= 'fa-star') : ($output .= 'fa-star-o');
		$output .= '" aria-hidden="true" id="star_'.$food_id.'_5"></i>';
		
		$output .= '<span class="ratingNum">(' . $ratingNum . ')</span><a class="submitRatingLink" id="'.$food_id.'">Submit Rating</a><span class="thankYou">Thank you!</span>';
		
		if(isAdmin()){
			$output .= '<p class="deleteFood" id="'.$name.'">X</p>';
		}
		
		$output .= '<p class="flagFood" id="'.$name.'">Flag</p><div id="responsecontainer" align="center"></div>';
		
		$output .=  '</div>' .
								'</div>' .
								'</div>';

		echo $output;
		
		$food_ids[] = $food_id;
	}
	
	/*
	// Generate JavaScript code to set up all the star listeners
	$jsOutput = "<script>" .
							"$(document).ready(function() {";
	
	for ($i = 0; $i < sizeof($food_ids); $i++) {
		$jsOutput .= "setUpStarListeners('star_" . $food_ids[$i] . "_');";
	}
	
	$jsOutput .= "});" .
							"</script>";
	
	echo $jsOutput;
	*/

}

function showfoodEntree() {
	showItems(0);
}	

function showFoodCarving() {
	
	showItems(1);
}	


function mailer ($user, $pass) {
  global $db;
  echo "<br>Executing mailer<br>";
  $s = "select*from gds_users where user = '$user'";
  $t = mysqli_query ($db, $s) or die (mysqli_error($db));
  $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
  $mailaddress = $r["email"];
  print "'$mailaddress'";
  $to      = $mailaddress;
	$pass = sha1($pass);
  $subject = "Verification". date("Y/m/d"). "  ". date("h:i:sa");
 	$message = "
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '$user'
Password: '$pass'
------------------------
 
Please click this link to activate your account:
http://gds-ratings-richard1ching383332.codeanyapp.com/PHP/ProcessVerify.php?user='$user'&pass='$pass'
 
"; //message above including the link
                     
mail($to, $subject, $message); // Send our email
}

function verify ($user, $pass){
	global $db;
	$s = "update gds_users set Active = 1 where user = '$user' and password = '$pass'" ;
	$t = mysqli_query ($db, $s) or die (mysqli_error($db));
}

function executeAddEntry ($item, $rating, $station) {
	if ($station == "") {
		exit ("No station was specified.");
	} else if ($station == "Entree") {
		echo "<br> Item "; getdata("Item", $item);
		insertFoodItem($item, 0, $rating);
	} else if ($station == "Carving") {
		echo "<br> Item: "; getdata("Item", $item);
		insertFoodItem($item, 1, $rating);
	}
		 
}

function redirect ($message, $url, $delay) {
	echo $message;
	header("refresh: $delay; url = '$url'");
	exit();
}

function gatekeeper() {
?>

<!DOCTYPE html>
<html>
<style>
	.green { color: green;  font-weight: bold }
	.red   { color: red;    font-weight: bold }
</style>
<body>
	
<?php	

$delay = $_SESSION['delay'];
if (!isset($_SESSION["logged"])){
	$message = "<p class ='red'>Please login again, wrong credentials </p>";
	redirect($message, "Login.php", $delay); 
	//If you want hardcode just replace $delay with 3, but this will work in circumstances given 
	//(will have a delay of 3 even if formpage (I called it Proto6-Action) is called without setting delay in the Proto6Form)
}

} // This ends function gatekeeper()
?>
	
</body>
</html>

