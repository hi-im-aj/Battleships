<!DOCTYPE html>
<html>
<head>
	<title>Battleships 2.0</title>
	<link rel="stylesheet" type="text/css" href="DevTools/style.css">
</head>
<body>
<?php
//Server login, database navn mm.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_battleships";
$coordinateArray = [
		"A0","A1","A2","A3","A4","A5","A6",
		"B0","B1","B2","B3","B4","B5","B6",
		"C0","C1","C2","C3","C4","C5","C6",
		"D0","D1","D2","D3","D4","D5","D6",
		"E0","E1","E2","E3","E4","E5","E6",
		"F0","F1","F2","F3","F4","F5","F6",
		"G0","G1","G2","G3","G4","G5","G6"];
//Et Array med shiplocations (hardcodet)
$blueShipArray = [
		"B3","C3","D3",
		"F5","F6"];
$redShipArray = [
		"C1","C2","C3",
		"F4","F5"];

//Checker forbindelsen og laver en database
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE $dbname";
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage() . "<br>";
    }
$conn = null;

//Laver table til de blå skibe
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE BlueShipData (
    td_id VARCHAR(2) PRIMARY KEY, 
    ship VARCHAR(10) NOT NULL,
    shot VARCHAR(10) NOT NULL)";

    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "Table created successfully<br>";
	}
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage() . "<br>";
    }
$conn = null;

//Laver table til de røde skibe
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE RedShipData (
    td_id VARCHAR(2) PRIMARY KEY, 
    ship VARCHAR(10) NOT NULL,
    shot VARCHAR(10) NOT NULL)";

    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "Table created successfully<br>";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage() . "<br>";
    }
$conn = null;

//Indsætter værdier i databasen
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($coordinateArray as $i_0) {
    	$sql = "INSERT INTO BlueShipData (td_id, ship, shot)
    	VALUES ('$i_0', 'False', 'False')";
    	// use exec() because no results are returned
	    $conn->exec($sql);
    }
    foreach ($coordinateArray as $i_1) {
    	$sql = "INSERT INTO RedShipData (td_id, ship, shot)
    	VALUES ('$i_1', 'False', 'False')";
    	// use exec() because no results are returned
	    $conn->exec($sql);
    }
    //echo "New records created successfully<br>";
}
catch(PDOException $e)
    {
    // echo $sql . "<br>" . $e->getMessage() . "<br>";
    }
$conn = null;

//opdaterer de blå skibes location (ship er sat til false som default)
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($blueShipArray as $i) {
    	$sql = "UPDATE BlueShipData SET ship='True' WHERE td_id='$i'";
    	// Prepare statement
    	$stmt = $conn->prepare($sql);
    	// execute the query
    	$stmt->execute();
	}
    // echo a message to say the UPDATE succeeded
    //echo $stmt->rowCount() . " ship record(s) UPDATED successfully" . "<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;

//opdaterer de røde skibes location (ship er sat til false som default)
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($redShipArray as $i) {
    	$sql = "UPDATE RedShipData SET ship='True' WHERE td_id='$i'";
    	// Prepare statement
    	$stmt = $conn->prepare($sql);
    	// execute the query
    	$stmt->execute();
	}
    // echo a message to say the UPDATE succeeded
    //echo $stmt->rowCount() . " ship record(s) UPDATED successfully" . "<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?>
<br>
<li><a target="tap_1" href="DevTools/player_blue.php">Player blue</a></li>
<li><a target="tap_2" href="DevTools/player_red.php">Player red</a></li>
</body>
</html>