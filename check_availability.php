<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_db";
   
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostel_number = $_POST['hostel_number'];
    $room_type = $_POST['room_type'];
    $room_number = $_POST['room_number'];

    $hostel_table = "hostel_" . $hostel_number;

    $check_room_query = "SELECT * FROM $hostel_table WHERE room_number = ? AND room_type = ?";
    $stmt = $conn->prepare($check_room_query);
    $stmt->bind_param("is", $room_number, $room_type);
    $stmt->execute();
    $result = $stmt->get_result();

    $allocated_count = $result->num_rows;

    $limit = ($room_type == "Double") ? 2 : ($room_type == "Triple" ? 3 : 1); 

    if ($allocated_count >= $limit) {

        echo json_encode(["status" => "error", "message" => "Sorry, the room number $room_number in Hostel $hostel_number is already fully allocated. Please choose a different room or hostel."]);
    } else {
        
        echo json_encode(["status" => "success", "message" => "Room $room_number in Hostel $hostel_number is available."]);
    }

    $stmt->close();
    $conn->close();
}
?>
