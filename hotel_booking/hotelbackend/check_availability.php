<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $room_type = $_GET['room_type'];
    $sql = "SELECT available_rooms FROM rooms WHERE type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $room_type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode(["available_rooms" => $row['available_rooms']]);
    } else {
        echo json_encode(["error" => "Room type not found."]);
    }
}
?>
