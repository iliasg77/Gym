<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Gym Application</title>

    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    #tabs {
      display: flex;
      justify-content: space-around;
      background-color: #333;
      color: #fff;
      padding: 10px;
    }

    .tab {
      cursor: pointer;
    }

    .tab-content {
      display: none;
      padding: 20px;
    }

    .active-tab {
      background-color: #555; 
    }


  </style>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".tab").click(function() {
        // Αποκρύπτει όλα τα περιεχόμενα
        $(".tab-content").hide();

        // Εμφανίζει το συγκεκριμένο περιεχόμενο
        var tabId = $(this).attr("data-tab");
        $("#" + tabId).show();
      });
    });
  </script>

</head>
<body>
<div>Gym-Application</div>

<div id="tabs">
  <div class="tab" data-tab="news">News</div>
  <div class="tab" data-tab="programs">Programs</div>
  <div class="tab" data-tab="reservation">Make a Reservation</div>
  <div class="tab" data-tab="myReservations">My Reservations</div>
</div>

<div id="news" class="tab-content">
 
  <h2>Latest news</h2>

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
    $sql = "SELECT Text FROM news";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Εμφάνιση των δεδομένων σε πίνακα
        echo "<table border='1'>";
        echo "<tr><th>News</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Text"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
  
</div>

<div id="programs" class="tab-content">
 
  <h2>Available Programs</h2>

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
    $sql = "SELECT ID, Trainer, Type, Day, StartTime, FinishTime, Capacity FROM programs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Εμφάνιση των δεδομένων σε πίνακα
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Trainer</th><th>Type</th><th>Day</th><th>StartTime</th><th>FinishTime</th><th>Capacity</th><th>Reservations</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Trainer"] . "</td>";
            echo "<td>" . $row["Type"] . "</td>";
            echo "<td>" . $row["Day"] . "</td>";
            echo "<td>" . $row["StartTime"] . "</td>";
            echo "<td>" . $row["FinishTime"] . "</td>";
            echo "<td>" . $row["Capacity"] . "</td>";
            $reservationsQuery = "SELECT COUNT(*) as ReservationCount FROM reservations WHERE programsID = " . $row["ID"];
        $reservationsResult = $conn->query($reservationsQuery);
        $reservationsCount = ($reservationsResult->num_rows > 0) ? $reservationsResult->fetch_assoc()["ReservationCount"] : 0;

        echo "<td>" . $reservationsCount . "</td>";
        
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

  
</div>

<div id="reservation" class="tab-content">
<?php
$username = isset($_GET['username']) ? $_GET['username'] : '';
?>
  
  <h2>Make a Reservation</h2>
  
  <form action="make_reservation.php" method="post">
  <input type="hidden" name="username" value="<?php echo $username; ?>">
        <label for="programID">Enter Program ID:</label>
        <input type="number" id="programID" name="programID" required>
        <button type="submit" name="makeReservation">Make a Reservation</button>
    </form>
</div>

<div id="myReservations" class="tab-content">

  <h2>My Reservations</h2>

  <?php
  // Σύνδεση στη βάση δεδομένων. Αντικαταστήστε τα στοιχεία σύνδεσης με τα δικά σας.
  $servername = "localhost";
  $username_db = "root";
  $password_db = "";
  $dbname = "gym";

  $conn = new mysqli($servername, $username_db, $password_db, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Ανακτήστε το ID του χρήστη με βάση το όνομα χρήστη
  $getUserIDQuery = "SELECT ID FROM user WHERE Username = '$username'";
  $userResult = $conn->query($getUserIDQuery);

  if ($userResult !== false && $userResult->num_rows > 0) {
      $userData = $userResult->fetch_assoc();
      $userID = $userData['ID'];

      // Ανακτήστε όλες τις κρατήσεις του χρήστη
      $getReservationsQuery = "SELECT * FROM reservations WHERE userID = $userID";
      $reservationsResult = $conn->query($getReservationsQuery);

      if ($reservationsResult !== false && $reservationsResult->num_rows > 0) {
          // Εμφανίστε τις λεπτομέρειες κάθε κράτησης με ένα κουμπί "Cancel Reservation"
          while ($reservationData = $reservationsResult->fetch_assoc()) {
              echo "<li>";
              echo "Program ID: " . $reservationData['programsID'] . "<br>";

              // Εμφανίστε τα υπόλοιπα στοιχεία του προγράμματος
              $programID = $reservationData['programsID'];
              $getProgramQuery = "SELECT * FROM programs WHERE ID = $programID";
              $programResult = $conn->query($getProgramQuery);

              if ($programResult !== false && $programResult->num_rows > 0) {
                  $programData = $programResult->fetch_assoc();
                  echo "Trainer: " . $programData['Trainer'] . "<br>";
                  echo "Type: " . $programData['Type'] . "<br>";
                  echo "Day: " . $programData['Day'] . "<br>";
                  echo "StartTime: " . $programData['StartTime'] . "<br>";
                  echo "FinishTime: " . $programData['FinishTime'] . "<br>";
              }

              // Προσθέστε το κουμπί "Cancel Reservation" με ένα form που χρησιμοποιεί τη μέθοδο POST
              echo "<form action='cancel_reservation.php' method='post'>";
              echo "<input type='hidden' name='reservationID' value='" . $reservationData['ID'] . "'>";
              echo "<button type='submit' name='cancelReservation'>Cancel Reservation</button>";
              echo "</form>";

              echo "</li><br>";
          }
      } else {
          echo "You have no reservations.";
      }
  } else {
      echo "Invalid username.";
  }

  $conn->close();
  ?>
   
    
  
  
  
  
</div>






</body>
</html>