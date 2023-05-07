<?php
require_once('midlwares/cors.php');

require_once('config/connectionDB.php');

// Retrieve data from the request
$name = mysqli_real_escape_string($conn, $_POST["your_name"]);
$phone = mysqli_real_escape_string($conn, $_POST["phone_number"]);
$date = mysqli_real_escape_string($conn, $_POST["select_a_date"]);
$time = mysqli_real_escape_string($conn, $_POST["select_a_time"]);
$people = mysqli_real_escape_string($conn, $_POST["how_many_people_will"]);
$table = mysqli_real_escape_string($conn, $_POST["select_a_table"]);
$action = $_POST["action"];



if ($action == "add") {
  $sql = "INSERT INTO reservations (your_name, phone_number, select_a_date, select_a_time, how_many_people_will, select_a_table) VALUES ('$name', '$phone', '$date', '$time', '$people', '$table')";
} elseif ($action == "update") {
  $id = mysqli_real_escape_string($conn, $_POST["id"]);
  $sql = "UPDATE reservations SET your_name='$name', phone_number='$phone', select_a_date='$date', select_a_time='$time', how_many_people_will='$people', select_a_table='$table' WHERE id='$id'";
} elseif ($action == "delete") {
  $id = mysqli_real_escape_string($conn, $_POST["id"]);
  $sql = "DELETE FROM reservations WHERE id='$id'";
}

$result = $conn->query($sql);

// Send the response
if ($result) {
  echo json_encode(array("status" => "success"));
} else {
  echo json_encode(array("status" => "error"));
}

$conn->close();
?>