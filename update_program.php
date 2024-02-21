<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Σύνδεση στη βάση δεδομένων. Αντικαταστήστε τα στοιχεία σύνδεσης με τα δικά σας.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gym";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $trainer = $_POST['trainer'];
    $type = $_POST['type'];
    $day = $_POST['day'];
    $startTime = $_POST['startTime'];
    $finishTime = $_POST['finishTime'];
    $capacity = $_POST['capacity'];

    // Κατασκευή ερωτήματος ενημέρωσης
    $sql = "UPDATE programs SET Trainer='$trainer', Type='$type', Day='$day', StartTime='$startTime', FinishTime='$finishTime', Capacity='$capacity' WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Record updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating record: " . $conn->error));
    }

    $conn->close();
} else {
    // Αν δεν είναι POST request, επιστροφή σφάλματος
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>