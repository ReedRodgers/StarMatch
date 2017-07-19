<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="StarMatchCSS.css">
</head>
<body>
    <ul id="tabs">
        <li><a href="Home.html">Home</a></li>
        <li.selected><a href="Admin.html">Admin</a></li.selected>
        <li><a href="Find%20Researcher.html">Find Researcher</a></li>
        <li><a href="Find%20Institution.html">Find Institution</a></li>
        <li><a href="Find%20Object.html">Find Object</a></li>
        <li><a href="Locate%20Planet.html">Locate Planet</a></li>
    </ul>
    <h1>Here you can update the database as necessary.</h1>
    <p>
        If there is any out of date informtation, you can take the intiative to
        updete it. If you knowingly submit false information you will be swiftly executed.
    </p>
	
    <h1>Add</h1>
    <h2>Add Researcher</h2>
    <form action="AddResearcher.php" method="get">
		Researcher ID <input type="text" name="rid"/>
		<?php
		// Enable error logging: 
		error_reporting(E_ALL ^ E_NOTICE);
		// mysqli connection via user-defined function
		include ('./connect.php');
		$mysqli = get_mysqli_conn();
		?>

		<?php
		// SQL statement
		$sql = "Select max(CAST(rid as UNSIGNED))
				From Researchers";

		// Prepared statement, stage 1: prepare
		$stmt = $mysqli->prepare($sql);

		$stmt->execute();

		// Bind result variables 
		$stmt->bind_result($maxID); 

		/* fetch values */ 
		if ($stmt->fetch()) 
			{ 
			echo '<label for = "result" > Note: ID Must be bigger than: ' . $maxID . ' </label>';
			} 
			else
			{
			echo '<label for="aname">Record not found</label>'; 
		}

		/* close statement and connection*/ 
		$stmt->close(); 
		$mysqli->close();
		?>
		<br>
        Researcher First Name <input type="text" name="FName"/><br>
		
		
		
		Researcher Last Name <input type="text" name="LName"/><br>
        Salary<input type="number" name="RSalary"><br>
        <input type="submit" value="Submit"/><br>
    </form>
	
    <h2>Add Project</h2>
    <form action= "AddProject.php" method = "get">
        <label for="Prid">Researcher ID:</label>
        <input type="text" name="Prid"><br>
        <label for="Poid">Organization Name:</label>
        <input type="text" name="Poid"><br>
        <label for="Pname">Project Name</label>
        <input type="text" name="PName"><br>
        <label for="Purpose">Object Researched:</label>
        <input type="text" name="Purpose"><br>
        <input type="submit" value = "Submit"/><br>
    </form><br><br><br>
	
    <h1>Update</h1>
    <h2>Change Jobs</h2>
    <form action="UpdateJobs.php" method="get">
        Researcher ID <input type="text" name="rid"/><br>
        New Institution Name <input type="text" name="Uiid"/><br>
        <input type="submit" value="Submit"/>
    </form><br><br><br>
	
    <h1>Delete</h1><br>
    <h2>Delete Researcher</h2>
    <form action="on_delete.php" method="get">
        <label for="Drid">RID:</label>
        <input type="text" name="Drid"><br>
        <input type="submit" value="Submit"/>
    </form>
</body>
</html>