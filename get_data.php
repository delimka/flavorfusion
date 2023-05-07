<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once('config/connectionDB.php');

$sql = "SELECT * FROM HomeContent";
$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[$row["key"]] = $row["value"];
}

echo json_encode($rows);

$conn->close();
?>
