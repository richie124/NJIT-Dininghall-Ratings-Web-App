<?php
	session_start();
  include ("account.php") ;

	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	$db = mysqli_connect($hostname, $username, $password , $project);

	$food_name = $_POST["id"];
	mysqli_select_db( $db, $project );
  $s = "update gds_food set flags = flags + '1' where name = '$food_name'";
  mysqli_query ( $db , $s );

  $t = mysqli_query($db, "select flags from gds_food where name = '$food_name'");
  echo "poop";
  $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
  $numFlags = $r["flags"];
  if($numFlags>10){
    $s = "delete from gds_food where name = '$food_name'";
    mysqli_query ( $db , $s );
  }

?>