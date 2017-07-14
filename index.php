<body>
<h1>Select Researcher </h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./connect.php');
$mysqli = get_mysqli_conn();
?>

<?php
// SQL statement
$sql = "SELECT r.rid, concat(r.first_name,' ',r.last_name) "
	. "FROM Researchers r";
	
// Prepared statement, stage 1: prepare
$stmt = $mysqli->prepare($sql);

// Prepared statement, stage 2: execute
$stmt->execute();

// Bind result variables 
$stmt->bind_result($researcher_id, $researcher_name); 

/* fetch values */ 
echo '<label for="aid">Pick Researcher: </label>'; 
echo '<select name="aid">'; 
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>', $researcher_id, $researcher_name); 
}
echo '</select><br>'; 

/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>

<br>
<input type="submit" value="Continue"/>
</br>
</form>
</body>