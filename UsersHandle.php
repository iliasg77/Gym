<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Σύνδεση με τη βάση δεδομένων
    $servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

    // Λήψη των δεδομένων από το AJAX request
    $action = $_POST["action"];
    $userId = $_POST["id"];

    // Εκτέλεση των απαραίτητων ενεργειών ανάλογα με το action
    if ($action === "admin") {
        // Μεταφορά των δεδομένων από τον πίνακα "user" στον πίνακα "admin"
        // και διαγραφή από τον πίνακα "user"
        $sqlTransferAdmin = "INSERT INTO admin SELECT * FROM user WHERE id = $userId";
        $sqlDeleteUser = "DELETE FROM user WHERE id = $userId";

        if ($conn->query($sqlTransferAdmin) === TRUE && $conn->query($sqlDeleteUser) === TRUE) {
            echo "Admin transfer successful";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === "delete") {
        // Διαγραφή της εγγραφής από τον πίνακα "user"
        $sqlDeleteUser = "DELETE FROM user WHERE id = $userId";

        if ($conn->query($sqlDeleteUser) === TRUE) {
            echo "User deleted successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Κλείσιμο της σύνδεσης
    $conn->close();
}
?>