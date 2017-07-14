<?php
// Function to obtain mysqli connection.
function get_mysqli_conn()
{
$dbhost = 'mansci-db.uwaterloo.ca'; //mansci-db.uwaterloo.ca
$dbuser = 'h463wang'; //phpMyAdmin username (quest username)
$dbpassword = 'sqladmin'; //phpMyAdmin password
$dbname = 'h463wang_StarMatch'; //database name
$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if ($mysqli->connect_errno) 
{
echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
}
return $mysqli;
}
?>
