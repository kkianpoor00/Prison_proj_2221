<!--
    variables:

    inmateName
    inmateID

-->

<?php
	require_once '../helperFunctions.php';
    $conn = connectToDatabase();

	$InmateID=$_POST['inmateID'];
    $InmateName=$_POST['inmateName'];

	//Checking connection
	if($conn->connect_error){
		die("Connection failed: ". $conn->connecte_error);
	}

	//construct query
	$query = "SELECT * FROM inmate WHERE name = '$InmateName' OR Inmate_ID = '$InmateID'";
	$result = $conn->query($query);

	//Execute query
	if($result->num_rows > 0){

		echo "<h1>Inmates based on this search are: </h1>";
        echo "<table align=\"center\"border= \"1\">";
        echo "<tr><th>Inmate_ID</th><th>Inmate_Name</th><th>Security_Level</th></tr>";
        // output data for each row
        while($row = $result->fetch_assoc()){
			$link = $row["Inmate_ID"];
			//echo "<p><a href='./inmateProfile.php?login&id=$link'>$link</a>";
        	echo "<tr><td>" . "<p><a href='../Guard/inmateProfile.php?login&id=$link'>$link</a>". " </td><td>". $row[ "Name"]
        		. "</td><td>" . $row["Security_Level"] . "</td></tr>";
        }

	}	else{
		echo "<h1>0 result found with this ID and Name</h1>";
	}
	$conn->close();
?>
