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
$sql = 'delete from Researchers
		where rid = ?';
		
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

// Prepared statement, stage 2: bind and execute 
$RID = $_GET['Drid']; 
// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('s', $RID); 

$stmt->execute();

if ($stmt->execute()) 
	{ 
	echo '<label for = "result" > Researcher ' . $RID . ' has been deleted.</label>'; 
	}
else {
	echo '<label for="result">Record not found</label><br>';
	}
?>

</body>