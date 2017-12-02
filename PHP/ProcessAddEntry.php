<?php
session_start();
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

// Get data from form
echo "<br> Station: "; getdata("Station", $station);
echo "<br> Item: "; getdata("Item", $item);
echo "<br> Rating: "; getdata("Rating", $rating);

if($station == "" || $item == "" || $rating > 5 || $rating < 0) {
	// exit ("Input is bad");
} else {
	// Everything is good!
	// TODO: Redirect to index.php
}

executeAddEntry($item, $rating, $station);

redirect("", "../index.php", 1);


?>