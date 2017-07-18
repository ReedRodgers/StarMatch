<head>
    <meta charset="UTF-8">
    <title>Found Planet</title>
    <link rel="stylesheet" href="StarMatchCSS.css">
</head>
<body>
<ul id="tabs">
    <li><a href="Home.html">Home</a></li>
    <li><a href="Admin.html">Admin</a></li>
    <li><a href="Find%20Researcher.html">Find Researcher</a></li>
    <li><a href="Find%20Institution.html">Find Institution</a></li>
    <li><a href="Find%20Object.html">Find Object</a></li>
    <li.selected><a href="Locate%20Planet.html">Locate Planet</a></li.selected>
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
$sql = 'SELECT p.s_oid, o.cid 
FROM Planets p, Star_System s, Objects2 o 
WHERE p.s_oid = s.oid AND s.oid = o.oid AND p.name = ?';

// Prepared statement, stage 1: prepare
$stmt = $mysqli-> prepare($sql);

// Prepared statement, stage 2: bind and execute
$Planet = $_GET['PName'];

// "i" for integer, "d" for double, "s" for string, "b" for blob
$stmt-> bind_param('s', $Planet);

$stmt-> execute();
// Bind result variables
$stmt-> bind_result($star, $constellation);

if ($stmt-> fetch())
{
        echo '<p>Star: ' . $star . ' Constellation:' . $constellation . '</p><br>';
}
else {
    echo '<p>Record not found</p><br>';
}
?>