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
    $registrationId = $_POST["id"];

    // Εκτέλεση των απαραίτητων ενεργειών ανάλογα με το action
    if ($action === "user") {
      // Μεταφορά των δεδομένων από τον πίνακα "register" στον πίνακα "user"
      // και διαγραφή από τον πίνακα "register"
      $sqlTransferUser = "INSERT INTO user SELECT * FROM register WHERE id = $registrationId";
      $sqlDeleteRegister = "DELETE FROM register WHERE id = $registrationId";
      
      if ($conn->query($sqlTransferUser) === TRUE && $conn->query($sqlDeleteRegister) === TRUE) {
        echo "User registration was successful";
      } else {
        echo "Error: " . $conn->error;
      }
    } elseif ($action === "admin") {
      // Μεταφορά των δεδομένων από τον πίνακα "register" στον πίνακα "admin"
      // και διαγραφή από τον πίνακα "register"
      $sqlTransferAdmin = "INSERT INTO admin SELECT * FROM register WHERE id = $registrationId";
      $sqlDeleteRegister = "DELETE FROM register WHERE id = $registrationId";
      
      if ($conn->query($sqlTransferAdmin) === TRUE && $conn->query($sqlDeleteRegister) === TRUE) {
        echo "Admin registration was successful";
      } else {
        echo "Error: " . $conn->error;
      }
    } elseif ($action === "delete") {
      // Διαγραφή της εγγραφής από τον πίνακα "register"
      $sqlDeleteRegister = "DELETE FROM register WHERE id = $registrationId";
      
      if ($conn->query($sqlDeleteRegister) === TRUE) {
        echo "Registration deleted successfully";
      } else {
        echo "Error: " . $conn->error;
      }
    }

    // Κλείσιμο της σύνδεσης
    $conn->close();
  }
?>