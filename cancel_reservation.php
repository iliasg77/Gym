<?php
if (isset($_POST['cancelReservation'])) {
    // Σύνδεση στη βάση δεδομένων. Αντικαταστήστε τα στοιχεία σύνδεσης με τα δικά σας.
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "gym";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ανακτήστε το ID της κράτησης που θα ακυρωθεί
    $reservationID = $_POST['reservationID'];

    // Διαγραφή της κράτησης από τον πίνακα "reservations"
    $deleteReservationQuery = "DELETE FROM reservations WHERE ID = $reservationID";
    
    if ($conn->query($deleteReservationQuery) === TRUE) {
        echo "Reservation canceled successfully!";
    } else {
        echo "Error canceling reservation: " . $conn->error;
    }

    $conn->close();
}
?>
