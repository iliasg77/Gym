<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$trainer = $_POST['trainer'];
$type = $_POST['type'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$finishTime = $_POST['finishTime'];
$capacity = $_POST['capacity'];

if (strtotime($startTime) < strtotime($finishTime)) {
    $sql = "INSERT INTO programs (Trainer, Type, Day, StartTime, FinishTime, Capacity) VALUES ('$trainer', '$type', '$day', '$startTime', '$finishTime', '$capacity')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Start time must be earlier than finish time.";
}

$conn->close();
?>