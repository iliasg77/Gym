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
    $adminId = $_POST["id"];

    // Εκτέλεση των απαραίτητων ενεργειών ανάλογα με το action
    if ($action === "user") {
        // Μεταφορά των δεδομένων από τον πίνακα "user" στον πίνακα "admin"
        // και διαγραφή από τον πίνακα "user"
        $sqlTransferAdmin = "INSERT INTO user SELECT * FROM admin WHERE id = $adminId";
        $sqlDeleteUser = "DELETE FROM admin WHERE id = $adminId";

        if ($conn->query($sqlTransferAdmin) === TRUE && $conn->query($sqlDeleteUser) === TRUE) {
            echo "User transfer successful";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === "delete") {
        // Διαγραφή της εγγραφής από τον πίνακα "user"
        $sqlDeleteUser = "DELETE FROM admin WHERE id = $adminId";

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