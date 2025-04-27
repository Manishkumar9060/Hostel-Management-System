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

    $name = $_POST['name'];
    $hostel_number = $_POST['hostel_number'];
    $room_type = $_POST['room_type'];
    $room_number = $_POST['room_number'];

    $hostel_table = "hostel_" . $hostel_number;

    $check_table_query = "SHOW TABLES LIKE '$hostel_table'";
    $result = $conn->query($check_table_query);

    if ($result->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "Hostel table for Hostel $hostel_number does not exist."]);
    } else {
        $sql = "INSERT INTO $hostel_table (name, room_type, room_number) 
                VALUES ('$name', '$room_type', '$room_number')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Room $room_number in Hostel $hostel_number allocated successfully to $name!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    }
}

$conn->close();
?>
