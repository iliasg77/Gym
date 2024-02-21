<?php
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Σύνδεση στη βάση δεδομένων. Αντικαταστήστε τα στοιχεία σύνδεσης με τα δικά σας.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gym";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Παίρνουμε το ID από το URL
    $id = $_GET['id'];

    // Κατασκευή ερωτήματος διαγραφής
    $sql = "DELETE FROM news WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Record deleted successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting record: " . $conn->error));
    }

    $conn->close();
} else {
    // Αν δεν είναι DELETE request, επιστροφή σφάλματος
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>