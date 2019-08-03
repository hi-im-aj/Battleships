<!DOCTYPE html>
<html>
<head>
	<title>Player blue</title>
	<link rel="stylesheet" type="text/css" href="t_style.css">
</head>
<body>
	<img id="alpha_row" style="" src="Images/AlphaRow.png">
	<img id="alpha_row_2" style="" src="Images/AlphaRow.png">
	<img id="num_row" style="" src="Images/NumRow.png">
	<img id="num_row_2" style="" src="Images/NumRow.png">
	<form class="fire_tool" action="fire_blue.php" method="post">
		<input type="text" name="blue_txt" placeholder="A0">
		<input type="submit" id="fire_button" value="Fire!">
	</form>
	<p>
		You are playing as blue!
	</p>
	<?php
	//Server login, database navn mm.
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_battleships";
	//html kode der bruges i scriptet
	$td_empty = "<td></td>";
	$td_hit = "<td class='td_hit'>*</td>";
	$td_miss = "<td class='td_miss'>x</td>";
	$td_myship = "<td class='td_myship'>*</td>";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//tager data fra databasen og gemmer dem som array
	$sql = "SELECT td_id, ship, shot FROM BlueShipData";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		foreach ($result as $i) {
			$blue_td_id[] = $i["td_id"];
			$blue_ship[] = $i["ship"];
			$blue_shot[] = $i["shot"];
		}
		//print out blue table
		$count = 0;
		echo "<table class='table_blue'>";
		for ($i_0 = 0; $i_0 < 7; $i_0++) {
			echo "<tr>";
			for ($i_1 = 0; $i_1 < 7; $i_1++) {
				if ($blue_shot[$count] == "True" and $blue_ship[$count] == "True") {
		    		echo $td_hit;
		    	}
		    	elseif ($blue_shot[$count] == "True" and $blue_ship[$count] == "False") {
		    		echo $td_miss;
		    	}
		    	elseif ($blue_shot[$count] == "False" and $blue_ship[$count] == "True") {
		    		echo $td_myship;
		    	}
		    	else {
		    		echo $td_empty;
		    	}
		    	$count++;
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
	    echo "error message: 0 data in table";
	}
	$conn->close();

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//tager data fra databasen og gemmer dem som array
	$sql = "SELECT td_id, ship, shot FROM RedShipData";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		foreach ($result as $i) {
			$red_td_id[] = $i["td_id"];
			$red_ship[] = $i["ship"];
			$red_shot[] = $i["shot"];
		}
		//print out red table
		$count = 0;
		echo "<table class='table_red'>";
		for ($i_0 = 0; $i_0 < 7; $i_0++) {
			echo "<tr>";
			for ($i_1 = 0; $i_1 < 7; $i_1++) {
				if ($red_shot[$count] == "True" and $red_ship[$count] == "True") {
		    		echo $td_hit;
		    	}
		    	elseif ($red_shot[$count] == "True" and $red_ship[$count] == "False") {
		    		echo $td_miss;
		    	}
		    	else {
		    		echo $td_empty;
		    	}
		    	$count++;
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
	    echo "error message: 0 data in table";
	}
	$conn->close();
	//player_red.php kører efter samme princip
	?>
</body>
</html>