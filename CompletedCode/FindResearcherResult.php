<head>
    <meta charset="UTF-8">
    <title>Found Researcher</title>
    <link rel="stylesheet" href="StarMatchCSS.css">
</head>
<body>
<ul id="tabs">
    <li><a href="Home.html">Home</a></li>
    <li><a href="Admin.html">Admin</a></li>
    <li.selected><a href="Find%20Researcher.html">Find Researcher</a></li.selected>
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

$sql = 'Select r.first_name, r.last_name, r.income 
From Researchers as r, Projects as p, Projects_rid as pr 
Where p.oid = ? and r.rid = pr.rid and pr.pname = p.pname';
// Prepared statement, stage 1: prepare
$stmt = $mysqli-> prepare($sql);

// Prepared statement, stage 2: bind and execute
$object = $_GET['Object'];

// "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt-> bind_param('s', $object);

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