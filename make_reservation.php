<?php
if (isset($_POST['makeReservation'])) {
   
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "gym";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username2 = $_POST['username'];

    
    $getUserIDQuery = "SELECT ID FROM user WHERE Username = '$username2'";
    $userResult = $conn->query($getUserIDQuery);

    if ($userResult !== false && $userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $userID = $userData['ID'];

        
        $programID = $_POST['programID'];

        
        $checkProgramQuery = "SELECT * FROM programs WHERE ID = $programID";
        $programResult = $conn->query($checkProgramQuery);

        if ($programResult !== false && $programResult->num_rows > 0) {
            $programData = $programResult->fetch_assoc();
            $programCapacity = $programData['Capacity'];

            
            // Έλεγχος αν υπάρχει ήδη κράτηση με τις συγκεκριμένες τιμές
            $checkExistingReservationQuery = "SELECT COUNT(*) as existingReservations FROM reservations WHERE programsID = $programID AND userID = $userID";
            $existingReservationResult = $conn->query($checkExistingReservationQuery);

            $existingReservationData = $existingReservationResult->fetch_assoc();
            $existingReservations = $existingReservationData['existingReservations'];

            if ($existingReservations == 0) {
                // Δεν υπάρχει ήδη κράτηση, πραγματοποιήστε την εισαγωγή
                $checkReservationQuery = "SELECT COUNT(*) as totalReservations FROM reservations WHERE programsID = $programID";
                $reservationResult = $conn->query($checkReservationQuery);

                $reservationData = $reservationResult->fetch_assoc();
                $totalReservations = $reservationData['totalReservations'];

                if ($totalReservations < $programCapacity) {
                    
                    $insertReservationQuery = "INSERT INTO reservations (userID, programsID) VALUES ($userID, $programID)";
                    if ($conn->query($insertReservationQuery) === TRUE) {
                        echo "Reservation successful!";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "Program is fully booked. Cannot make reservation.";
                }
            } else {
                // Υπάρχει ήδη κράτηση με αυτές τις τιμές
                echo "Already booked!";
            }
        } else {
            echo "Invalid Program ID.";
        }
    } else {
        echo "Invalid username.";
    }

    $conn->close();
}
?>
