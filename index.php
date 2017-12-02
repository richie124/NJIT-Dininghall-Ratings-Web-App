<!DOCTYPE html>
<!--Home Page-->
<?php
	session_start();
	
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors' , 1);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	date_default_timezone_set("America/New_York");
	
	include ("PHP/account.php") ;
	include("PHP/Process_Function.php");
	


	
	if (!(isset($_SESSION["logged"]))){
		$_SESSION["logged"] = 0;
	}
	$db = mysqli_connect($hostname, $username, $password , $project);

	mysqli_select_db( $db, $project ); 
 //	cleardata();

	//showFoodEntree();
?>


	<html>

	<head>
		<title>GDS Ratings</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="CSS/CSS.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="JavaScript/SubmitForm.js"></script>
		<script src="JavaScript/Stars.js"></script>
		<script src="JavaScript/IndexStars.js"></script>
	</head>

	<body>

		<div class="container">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading" class="col-xs-1" align="center">
						<div class="row">
							<a href="GDSRate.php" id="AddFood">							Add Food</a>
							<a href="Login.php" id="Login">									Log In 	</a>
							<a href="PHP/ProcessSignOut.php" id="SignOut">	Sign Out 	</a>
							<a href="registration.php" id="Register">				Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading" class="col-xs-1">
						<h2>Carving Station</h2>
					</div>
					<br>
					<div class="form-group">
						<label for="user" class="col-md-8 col-sm-12 control-label">   <?php showFoodCarving() ?></label>
					</div>
					<div class="row">
					</div>
					<br>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading" class="col-xs-1">
						<h2>International Entrées Station</h2>
					</div>
					<br>
					<div class="form-group">
						<label for="user" class="col-md-8 col-sm-12 control-label">   <?php showFoodEntree() ?> </label>
					</div>
					<div class="row">
					</div>
					<br>
				</div>
			</div>
		</div>
		
	<script>
		$(document).ready(function(){
			$(".deleteFood").click(function(){
				var ID = $(this).attr('id');;
				
				$.ajax({
					url: "PHP/Process_DeleteFood.php",
					method:"POST",
					data:{id:ID}
					
				})
			});
			
			$(".submitRatingLink").click(function(){
				var ID = $(this).attr('id');

				var starAt = 0;
				$(this).parent().find("i").each(function() {
					if (!$(this).hasClass("fa-star-o")) {
						starAt++;
					}
				});
				
				console.log("Sending id:" + ID + " rating: " + starAt);

				$.ajax({
				url: "PHP/Process_Rating.php",
				method:"POST",
				data:{id:ID, rating:starAt}
				});
			});
			
			$(".flagFood").click(function(){
				var ID = $(this).attr('id');
				$.ajax({
					url: "PHP/Process_Flags.php",
					method:"POST",
					data:{id:ID}
				});
			})
		});
		
		function login() {
			ptr1 = document.getElementById("Register")
			ptr2 = document.getElementById("Login")
			ptr3 = document.getElementById("SignOut")
			ptr4 = document.getElementById("AddFood")
			logged = <?php echo $_SESSION["logged"];?>;
			if ( logged != 0) {
				ptr1.style.display = "none";
				ptr2.style.display = "none";
				ptr3.style.display = "block";
				ptr4.style.display = "block"
				} 
			else {
				ptr1.style.display = "block";
				ptr2.style.display = "block";
				ptr3.style.display = "none";
				ptr4.style.display = "none";
			}
		}


		login();
	</script>
	</body>

	</html>