<?php

session_start();
$_SESSION["delay"] = 0;
date_default_timezone_set("America/New_York");

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);
if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }

include ("account.php") ;
include ("Process_Function.php");
$db = mysqli_connect($hostname, $username, $password , $project);
print "<br>Successfully connected to MySQL.<br>";

mysqli_select_db( $db, $project ); 
$bad = false;
//Connects to database and includes files

getdata("user", $user);
getdata("password", $pass);
getdata("password2", $pass2);
getdata("email", $email);
echo "User: $user<br>"; 
echo "Pass: $pass<br>"; 
echo "Pass2: $pass2<br>" ;
echo "Email: $email<br>"; 
//Gets data from registration.php 

register($user, $pass, $pass2, $email);


auth ($user, $pass, $t);

if(!($t) ) {
	redirect("....", "/~rc425/GDSRatings/registration.php", 10);
	echo "Credentials are bad";
	exit ("Credentials are bad");
}

if($t){
		$_SESSION["logged"] = true;
		$_SESSION["user"] = $user;
		mailer($user, $pass);
}

if($bad) {
	exit ("bad input");
}
echo "Credentials have been verified";
$message = "I need water";

gatekeeper();
redirect ($message, "../index.php", 10);


?>