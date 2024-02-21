<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Gym Application</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    table {
        border-collapse: collapse;
        width: 15%; 
        margin-top: 20px; 
    }

    th, td {
        border: 3px solid #ddd;
        padding: 8px;
        text-align: center;
        border-color: black;
    }

    th {
        background-color: #f2f2f2;
    }

</style>
</head>
<body>


<?php
    // Σύνδεση στη βάση δεδομένων. Αντικαταστήστε τα στοιχεία σύνδεσης με τα δικά σας.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gym";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Εκτέλεση ερωτήματος για να ανακτήσετε τα δεδομένα από τον πίνακα "programs"
    $sql = "SELECT Type FROM programs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Χρησιμοποιούμε έναν πίνακα για να αποθηκεύσουμε τις μοναδικές τιμές
        $uniqueValues = array();

        // Εμφάνιση των δεδομένων σε πίνακα
        echo "<table border='1'>";
        echo "<tr><th>Available Services</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $currentValue = $row["Type"];
            
            // Έλεγχος αν η τιμή έχει ήδη προστεθεί
            if (!in_array($currentValue, $uniqueValues)) {
                echo "<tr>";
                echo "<td>" . $currentValue . "</td>";
                echo "</tr>";

                // Προσθήκη της τρέχουσας τιμής στον πίνακα μοναδικών τιμών
                $uniqueValues[] = $currentValue;
            }
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
?>





</body>
</html>