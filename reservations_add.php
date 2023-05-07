<?php
require_once('midlwares/cors.php');
require_once('config/connectionDB.php');

$postData = json_decode(file_get_contents("php://input"), true);

if (is_null($postData)) {
    echo json_encode(array("error" => "Invalid input"));
    exit;
}

$name = mysqli_real_escape_string($conn, $postData['name']);
$phone = mysqli_real_escape_string($conn, $postData['phone']);
$dateStr = $postData['date'];
$dateObj = DateTime::createFromFormat('d/m/Y - l', substr($dateStr, 0, 10) . " - " . substr($dateStr, 13));
$date = $dateObj->format('Y-m-d');
$timeStr = $postData['time'];
$time = date('H:i:s', strtotime($timeStr));
$people = (int) $postData['number_of_people'];
$table = (int) $postData['table'];

$sql = "INSERT INTO reservations (your_name, phone_number, select_a_date, select_a_time, how_many_people_will, select_a_table) 
VALUES ('$name', '$phone', '$date', '$time', '$people', '$table')";

if ($conn->query($sql) === FALSE) {
    echo json_encode(array("error" => "Error inserting data: " . $conn->error));
    exit;
} else if ($conn->affected_rows == 0) {
    echo json_encode(array("error" => "No rows were affected, data not inserted"));
    exit;
}

echo json_encode(array("message" => "Data successfully inserted"));

$conn->close();
?>