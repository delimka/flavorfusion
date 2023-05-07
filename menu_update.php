<?php
require_once('midlwares/cors.php');


require_once('config/connectionDB.php');


// Retrieve data from the request
$id = $_POST["id"];
$category = $_POST["category"];
$name = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["description"];
$action = $_POST["action"];

if ($action == "add") {
  $sql = "INSERT INTO menu (category, item_name, price, description) VALUES ('$category', '$name', '$price', '$description')";
} elseif ($action == "update") {
  $sql = "UPDATE menu SET category='$category', item_name='$name', price='$price', description='$description' WHERE id='$id'";
} elseif ($action == "delete") {
  $sql = "DELETE FROM menu WHERE id='$id'";
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