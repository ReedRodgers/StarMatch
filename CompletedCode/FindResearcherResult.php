<head>
    <meta charset="UTF-8">
    <title>Found Researcher</title>
    <link rel="stylesheet" href="StarMatchCSS.css">
</head>
<body>
<ul id="tabs">
    <li><a href="Home.html">Home</a></li>
    <li><a href="Admin.html">Admin</a></li>
    <li class="selected"><a href="Find%20Researcher.html">Find Researcher</a></li>
    <li><a href="Find%20Institution.html">Find Institution</a></li>
    <li><a href="Find%20Object.html">Find Object</a></li>
    <li><a href="Locate%20Planet.html">Locate Planet</a></li>
</ul>
<?php
// Enable error logging:
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include ('./Connect.php');


$mysqli = get_mysqli_conn();

?>

<?php

$sql = 'SELECT DISTINCT r.first_name, r.last_name, r.income 
FROM Researchers as r, Projects as p, Projects_rid as pr 
WHERE r.rid = pr.rid AND pr.pname = p.pname 
AND pr.rid IN 
    (SELECT pr1.rid 
     FROM Projects_rid AS pr1, Projects AS p1, Deep_Space_Object 
     INNER JOIN Objects2 ON Deep_Space_Object.oid = Objects2.oid 
     WHERE Deep_Space_Object.oid = p1.oid 
     AND pr1.pname = p1.pname 
    AND Deep_Space_Object.oid NOT IN 
     (SELECT o2.oid FROM Deep_Space_Object as o2 WHERE o2.type like ?)) 
AND pr.rid NOT IN 
    (SELECT pr1.rid 
     FROM Projects_rid AS pr1, Projects AS p1, Star_System 
     INNER JOIN Objects2 ON Star_System.oid = Objects2.oid 
     WHERE Star_System.oid = p1.oid 
     AND pr1.pname = p1.pname)
AND pr.rid NOT IN 
    (SELECT pr1.rid 
     FROM Projects_rid AS pr1, Projects AS p1, local_system
     INNER JOIN Objects2 ON local_system.oid = Objects2.oid 
     WHERE local_system.oid = p1.oid 
     AND pr1.pname = p1.pname)';
// Prepared statement, stage 1: prepare
$stmt = $mysqli-> prepare($sql);

// Prepared statement, stage 2: bind and execute
$type = $_GET['Type']; //object exists

// "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt-> bind_param('i', $type); //looks good

$stmt-> execute();
// Bind result variables
$stmt-> bind_result($fname, $lname, $income);

if ($stmt-> fetch()) {
    echo '<p>First name: ' . $fname . ' Last name: ' . $lname . ' Income: ' . $income . '</p><br>';
    while($stmt->fetch()){
        echo '<p>First name: ' . $fname . ' Last name: ' . $lname . ' Income: ' . $income . '</p><br>';
    }
}
else {
    echo '<p>Record not found</p><br>';
}
?>