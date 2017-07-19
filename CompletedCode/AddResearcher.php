<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="StarMatchCSS.css">
</head>
	<ul id="tabs">
        <li><a href="Home.html">Home</a></li>
        <li.selected><a href="Admin.html">Admin</a></li.selected>
        <li><a href="Find%20Researcher.html">Find Researcher</a></li>
        <li><a href="Find%20Institution.html">Find Institution</a></li>
        <li><a href="Find%20Object.html">Find Object</a></li>
        <li><a href="Locate%20Planet.html">Locate Planet</a></li>
    </ul>
<body>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./connect.php');

$mysqli = get_mysqli_conn();

?>

<?php

// SQL statement
$sql = 'Insert into Researchers VALUES (?, ?, ?, ?, ?)';
	
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

// Prepared statement, stage 2: bind and execute 
$FName = $_GET['FName']; 
$LName = $_GET['LName'];
$Salary = $_GET['RSalary'];
$maxIDString = $_GET['rid'];
$Field = 'Unknown';


$stmt->bind_param('sssds', $FName, $LName, $maxIDString, $Salary, $Field);



//$stmt->execute();
	
if ($stmt->execute()) 
{ 
echo '<h1>Success!</h1>'; 
echo '<p>Researcher #' . $maxIDString . ' has been added </p>'; 
} 
else 
{
echo '<h1>You Failed</h1>'; 
echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error; 
} 

$stmt->close(); 
$mysqli->close();

?>

</body>
</html>