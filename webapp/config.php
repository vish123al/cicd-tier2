<?php
//$currency = '₹';
//$db_username = 'wordpress';
//$db_password = 'secrete';
//$db_name = 'wordpress';
//$db_host = '10.0.1.82:3348';
//$mysqli =new mysqli($db_host, $db_username, $db_password, $db_name);
//$mysqli = new mysqli('10.0.1.82','jfrogdcos','jfrogdcos','artdb',3306);
$mysqli = new mysqli("3.3.0.6","root","root","myapp",3306);
if ($mysqli->connect_errno) {
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";
?>
