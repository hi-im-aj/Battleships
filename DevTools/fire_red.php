<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_battleships";
	$shotted = $_POST["red_txt"];

	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE BlueShipData SET shot='True' WHERE td_id='$shotted'";
	// Prepare statement
	$stmt = $conn->prepare($sql);
	// execute the query
	$stmt->execute();
    // echo a message to say the UPDATE succeeded
    //echo $stmt->rowCount() . " ship record(s) UPDATED successfully" . "<br>";
    }
	catch(PDOException $e) {
    	echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;

	header("Location: /DevTools/player_red.php")
?>