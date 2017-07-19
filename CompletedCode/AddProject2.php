<body>

<?php 

//------------part 2 entering Project-Institution information-------------
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./connect.php');
$mysqli = get_mysqli_conn();

// SQL statement
$sql = 'Insert into Projects VALUES (?, ?, ?, 0000-00-00)';
		
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

// Prepared statement, stage 2: bind and execute 
$OID = $_GET['OID']; 
$IName = $_GET['IName']; 
$Project = $_GET['Project']; 
$PName = $_GET['PName']; 

// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('sss', $OID, $Project, $IName); 

//$stmt->execute();

if ($stmt->execute()) 
	{ 
	echo '<label for = "result" > Researcher ' . $PName . ' and Project ' . $Project . ' has been added.</label><br>'; 
	echo 'Project ' . $Project . ' by ' . $IName . ' studying ' . OID . ' has been added.</label>'; 

	
	}
else {
	echo '<label for="result">Record not found</label><br>';
	printf("Error: %s.\n", $stmt->error);

	}

$stmt->close(); 
$mysqli->close();

?>

</body>