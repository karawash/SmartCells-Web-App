<?php

$smtp = $_POST ['smtp']; // ex: 'smtp.gmail.com';
$port = $_POST ['port']; // ex: 587;
$authSec = $_POST ['authSec']; // 'tls';
$myemail = $_POST ['myemail']; // 'your email';
$pass = $_POST ['pass']; // 'password';
$To = $_POST ['To']; // 'to whom ';
$msg = $_POST ['msg']; // "ex: Hello !";
$Subject = $_POST ['Subject']; // "salam";
$fromName = $_POST ['fromName']; // ex: "Ahmad karawash";
$toName = $_POST ['toName']; // "A name";
//$mailservice = $_POST ['mailservice'];
//$mailserverwsdl = $_POST ['mailserverwsdl'];

$conn = mysql_connect("localhost", "root", "");

if (!$conn) {
	echo "Unable to connect to DB: " . mysql_error();
	exit;
}

if (!mysql_select_db("phpmonitor")) {
	echo "Unable to select mydbname: " . mysql_error();
	exit;
}

$sql = "Select *
		FROM   monitor_servers
		Where rtime=(SELECT min(rtime) FROM  monitor_servers WHERE  Cell_id = 2)";

$result = mysql_query($sql);

if (!$result) {
	echo "Could not successfully run query ($sql) from DB: " . mysql_error();
	exit;
}

if (mysql_num_rows($result) == 0) {
	echo "No rows found, nothing to print so am exiting";
	exit;
}

//while ($row = mysql_fetch_assoc($result)) {
//echo $row['ip'];

//}
$row = mysql_fetch_assoc($result);
$mailserverwsdl = $row['ip'];
$mailservice = $row['method'];

mysql_free_result($result);

?>