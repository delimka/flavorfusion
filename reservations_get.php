<?php
require_once('midlwares/cors.php');

require_once('config/connectionDB.php');



// Fetch data from the reservations table
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);

$conn->close();
?>