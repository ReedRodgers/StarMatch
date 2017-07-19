<body>

<form action = "AddProject2.php" method = "get" />
<?php
/*
//-----------attempt to put it together--------------
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./connect.php');
$mysqli = get_mysqli_conn();
echo "done1";

// SQL statement
$sql = 'Insert into Projects_rid VALUES (?, ?);
		Insert into Projects VALUES (?, ?, ?, 0000-00-00)';

echo "done2";		
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

echo "done3";
// Prepared statement, stage 2: bind and execute 
$PName = $_GET['Prid']; 
$Project = $_GET['PName']; 
$OID = $_GET['Purpose']; 
$IName = $_GET['Poid']; 

echo "done4";
$stmt->bind_param('sssss', $PName, $Project, $OID, $Project, $IName);
echo "done5";
if ($mysqli->multi_query($sql)) {
	echo '<label for = "result" > Researcher ' . $PName . ' and Project ' . $Project . ' has been added.</label><br>'; 
	echo 'Project' . $Project . ' by ' . $IName . ' studying ' . OID . ' has been added.</label>'; 
}
else {
	echo '<label for="result">Record not added</label><br>';
	printf("Error: %s.\n", $stmt->error);
}
*/
//------------part 1 entering Project-Reseaercher information-------------
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./connect.php');
$mysqli = get_mysqli_conn();

// SQL statement
$sql = 'Insert into Projects_rid VALUES (?, ?)';
		
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

// Prepared statement, stage 2: bind and execute 
$PName = $_GET['Prid']; 
$Project = $_GET['PName']; 
$OID = $_GET['Purpose']; 
$IName = $_GET['Poid']; 

// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('ss', $PName, $Project); 

//$stmt->execute();

if ($stmt->execute()) 
	{ 
	echo '<label for = "result" > Researcher ' . $PName . ' and Project ' . $Project . ' has been added.</label><br>'; 
	echo '<input type="hidden" name="PName" value="'.$PName .'"/>'; 
	echo '<input type="hidden" name="Project" value="'.$Project .'"/>'; 
	echo '<input type="hidden" name="OID" value="'.$OID .'"/>'; 
	echo '<input type="hidden" name="IName" value="'.$IName .'"/>'; 
	}
else {
	echo '<label for="result">Record not added</label><br>';
	printf("Error: %s.\n", $stmt->error);

	}
$stmt->close(); 
$mysqli->close();

?>
<br>
<input type="submit" value="Next"/>
</form>
</body>