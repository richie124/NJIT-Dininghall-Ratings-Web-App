<?php
session_start();
$_SESSION["delay"] = 0;
date_default_timezone_set("America/New_York");


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);
if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }

include (  "account.php" ) ;
include ("Process_Function.php");
$db = mysqli_connect($hostname, $username, $password , $project);
print "<br>Successfully connected to MySQL.<br>";

mysqli_select_db( $db, $project ); 
//logs into Mysql and selects database
$bad = false;
//used in getdata to determine bad input

echo "<br> User: "; getdata("user", $user);
echo "<br> Pass: "; getdata("password", $pass);
auth ($user, $pass, $t);
//checks user and password to verify if credentials exist in database
//If credentials are good, auth returns $t as true, otherwise its false

if(!($t) ) {
	//If credentials are bad, redirects back to login page
	redirect("", "/~rc425/GDSRatings/Login.php", 0);
	exit ("Credentials are bad");
	//Exits code to prevent any other code from running
}


if($t){
	//If credentials verified in auth function
		$_SESSION["logged"] = true;
	//Session logged is true if user has loggged in
		$_SESSION["user"] = $user;
	//Stores user into session to check for admin priveledges later
}

if($bad) {
	//If getdata returns bad due to bad input, notifies user
	exit ("bad input");
}

//Auth function returns true
echo "Credentials have been verified";

redirect ("", "../index.php", 0);
//redirects user to the home page (index.php) after log in


?>