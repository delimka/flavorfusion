<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

require_once('config/connectionDB.php');

$postData = json_decode(file_get_contents("php://input"), true);

if (is_null($postData)) {
    echo json_encode(array("error" => "Invalid JSON input"));
    exit;
}

foreach($postData as $key => $value) {
    $sql = "UPDATE HomeContent SET value = '$value' WHERE `key` = '$key'";
    echo $sql . "\n"; // check if SQL query is correctly constructed

    if ($conn->query($sql) === FALSE) {
        echo json_encode(array("error" => "Error updating data: " . $conn->error));
        exit;
    }
}

echo json_encode(array("message" => "Data successfully updated"));

$conn->close();
?>