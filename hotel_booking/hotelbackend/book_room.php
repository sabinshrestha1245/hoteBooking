<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $check_in_date = $_POST['check_in_date'];
    $room_type = $_POST['room_type'];
    $persons = $_POST['persons'];

    // Check availability
    $sql_check = "SELECT available_rooms, max_persons FROM rooms WHERE type = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $room_type);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        if ($row['available_rooms'] > 0 && $persons <= $row['max_persons']) {
            // Reduce room availability
            $sql_update = "UPDATE rooms SET available_rooms = available_rooms - 1 WHERE type = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("s", $room_type);
            $stmt_update->execute();

            // Add booking
            $sql_insert = "INSERT INTO bookings (name, email, phone, check_in_date, room_type, persons) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sssssi", $name, $email, $phone, $check_in_date, $room_type, $persons);
            $stmt_insert->execute();

            echo json_encode(["success" => true, "message" => "Booking successful!"]);
        } else {
            echo json_encode(["success" => false, "message" => "No rooms available or exceeds max persons limit."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Room type not found."]);
    }
}
?>
