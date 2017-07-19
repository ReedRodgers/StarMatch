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
$sql = "UPDATE Works_For w "
. "SET w.name = ? "
. "WHERE w.rid = ?";
		
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);		

// Prepared statement, stage 2: bind and execute 
$Iname = $_GET['Uiid']; 
$RID = $_GET['rid'];


if(isset($_GET['rid'])) {
    echo '<p>RID empty</p><br>';
	echo '<p>RID is:</p>';
	echo '<p>' . $RID . '</p>';
}
else {
	echo '<p>RID does not empty</p>';
}


// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('ss', $Iname, $RID); 

$stmt->execute();
?>
<p> Update Status:</p>

<?php

if ($stmt->execute()) 
{ 
echo '<h1>Success!</h1>'; 
echo '<p>Researcher #' . $RID . ' Institution has been updated to ' . $Iname . '.</p>'; 
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