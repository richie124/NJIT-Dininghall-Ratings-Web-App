<?php
session_start();
include ("Process_Function.php");
unset($_SESSION["logged"]);
$message = "Trolololo lololo lololo";
redirect($message, "../index.php", 0);




?>