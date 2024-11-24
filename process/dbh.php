<?php

$servername = "localhost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "ems";

// $servername = "localhost";
// $dBUsername = "hindmara_skpf_dbUser";
// $dbPassword = "Ji)jlq^!q~tq";
// $dBName = "hindmara_skfp_india";

$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

if(!$conn){
	echo "Databese Connection Failed";
}

?>