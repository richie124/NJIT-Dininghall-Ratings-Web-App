<?php
	session_start();


	if (isset($_SESSION["rated"]) && isset($_SESSION["rated"][$_POST["id"]]) && $_SESSION["rated"][$_POST["id"]] == 1) {
		echo "bad";
	} else {
		
		if (!isset($_SESSION["rated"])) {
			$_SESSION["rated"] = array();
		}
		$_SESSION["rated"][$_POST["id"]] = 1;
		
		include ("account.php") ;

		$db = mysqli_connect($hostname, $username, $password , $project);

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}

		mysqli_select_db( $db, $project );

		$s = "insert into gds_ratings values (0, ".$_POST['id'].", ".$_POST['rating'].", NOW())";
		$t = mysqli_query($db, $s) or die (mysqli_error($db));
		
	}

  

?>