<head>
    <meta charset="UTF-8">
    <title>Found Object</title>
    <link rel="stylesheet" href="StarMatchCSS.css">
</head>
<body>
<ul id="tabs">
    <li><a href="Home.html">Home</a></li>
    <li><a href="Admin.html">Admin</a></li>
    <li><a href="Find%20Researcher.html">Find Researcher</a></li>
    <li.selected><a href="Find%20Institution.html">Find Institution</a></li.selected>
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
// SQL statement
$sql = 'SELECT i.ri_name 
FROM  Instruments i, Projects p
WHERE i.iname = ?
AND p.oid = ?
AND i.ri_name = p.iname 
GROUP BY p.oid
HAVING COUNT(*) > ?';

// Prepared statement, stage 1: prepare
$stmt = $mysqli-> prepare($sql);

// Prepared statement, stage 2: bind and execute
$Instrument = $_GET['Instrument1'];
$Object = $_GET['Object'];
$Number = $_GET['NoProj'];

// "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt-> bind_param('ssi', $Instrument, $Object, $Number);

$stmt-> execute();
// Bind result variables
$stmt-> bind_result($institution);
if ($stmt-> fetch())
{
    echo '<p>' . $institution . '</p><br>';
    while($stmt->fetch()){
        echo '<p>' . $institution . '</p><br>';
    }
}
else {
    echo '<p>Record not found</p><br>';
}
?>