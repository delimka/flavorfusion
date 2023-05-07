<?php
require_once('midlwares/cors.php');


require_once('config/connectionDB.php');

// Fetch data from the menu table
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);


$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}


echo json_encode($rows);

$conn->close();
?>