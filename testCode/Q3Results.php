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
$sql = 'select o.oid, o.cid
		from Objects2 o
		where oid = ?';
		
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

// Prepared statement, stage 2: bind and execute 
$oid = $_GET['oid']; 
// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('s', $oid); 

$stmt->execute();

// Bind result variables 
$stmt->bind_result($object, $cid);

if ($stmt->fetch()) 
	{ 
	echo '<label for = "result" > Object ' . $object . ' has cid ' . $cid . '.</label>'; 
	}
else {
	echo '<label for="result">Record not found</label><br>';
	}
?>

<a href="Q3.php">Find another object by oid</a>
</body>