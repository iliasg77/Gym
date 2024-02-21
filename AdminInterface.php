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

    /* Στυλ για την εμφάνιση του modal */
    #myModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }



        #newsAdd {
    width: 300px; 
    height: 100px; 
  }


  #myNewsModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-News-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
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

<script>
    $(document).ready(function() {
      $(".registration-action-button").click(function() {
        // Αποκρύπτει όλα τα περιεχόμενα
        $(".tab-content").hide();

        // Εμφανίζει το συγκεκριμένο περιεχόμενο
        var tabId = $(this).attr("data-tab");
        $("#" + tabId).show();

        // Κάνει AJAX request για να εκτελέσει τις απαραίτητες ενέργειες
        var action = $(this).attr("data-action");
        var registrationId = $(this).closest(".registration-item").attr("data-id");

        $.ajax({
          type: "POST",
          url: "RegistrationRequests.php", 
          data: { action: action, id: registrationId },
          success: function(response) {
            console.log(response);
          }
        });
      });

        //Ομοίως και ο παρακάτω κώδικας για τη καρτέλα "Users"

      $(".user-action-button").click(function() {
        var tabId = $(this).attr("data-tab");
        $("#" + tabId).show();
        var action = $(this).attr("data-action");
        var userId = $(this).closest(".user-item").attr("data-id");

        $.ajax({
            type: "POST",
            url: "UsersHandle.php",
            data: { action: action, id: userId },
            success: function(response) {
                console.log(response);
            }
        });
    });

    //Ομοίως και ο παρακάτω κώδικας για τη καρτέλα "Administrators"

    $(".admin-action-button").click(function() {
        var tabId = $(this).attr("data-tab");
        $("#" + tabId).show();
        var action = $(this).attr("data-action");
        var adminId = $(this).closest(".admin-item").attr("data-id");

        $.ajax({
            type: "POST",
            url: "AdminsHandle.php",
            data: { action: action, id: adminId },
            success: function(response) {
                console.log(response);
            }
        });
    });

    $("#submit-program").click(function() {
        var trainer = $("#trainer").val();
        var type = $("#type").val();
        var day = $("#day").val();
        var startTime = $("#startTime").val();
        var finishTime = $("#finishTime").val();
        var capacity = $("#capacity").val();

        $.ajax({
          type: "POST",
          url: "ProgramsHandle.php", 
          data: { trainer: trainer, type: type, day: day, startTime: startTime, finishTime: finishTime, capacity: capacity },
          success: function(response) {
            console.log(response);
            
          }
        });
      });


      $("#submit-news").click(function() {
        var news = $("#newsAdd").val();
        

        $.ajax({
          type: "POST",
          url: "NewsHandle.php", 
          data: { news: news },
          success: function(response) {
            console.log(response);
            
          }
        });
      });
  });

    // Εμφάνιση του modal. Οι συναρτήσεις οι από κάτω μέχρι τη συνάρτηση "deleteFunction" αφορούν τη καρτέλα "programs"
    function openModal(id) {
        // Προβολή των τρεχουσών τιμών στο modal
    var trainerElement = document.getElementById('trainer_' + id);
    if (trainerElement) {
        document.getElementById('editTrainer').value = trainerElement.innerText;
    }

    var typeElement = document.getElementById('type_' + id);
    if (typeElement) {
        document.getElementById('editType').value = typeElement.innerText;
    }

    var dayElement = document.getElementById('day_' + id);
    if (dayElement) {
        document.getElementById('editDay').value = dayElement.innerText;
    }

    var startTimeElement = document.getElementById('startTime_' + id);
    if (startTimeElement) {
        document.getElementById('editStartTime').value = startTimeElement.innerText;
    }

    var finishTimeElement = document.getElementById('finishTime_' + id);
    if (finishTimeElement) {
        document.getElementById('editFinishTime').value = finishTimeElement.innerText;
    }

    var capacityElement = document.getElementById('capacity_' + id);
    if (capacityElement) {
        document.getElementById('editCapacity').value = capacityElement.innerText;
    }

    document.getElementById('editId').value = id;

    // Εμφάνιση του modal
    document.getElementById('myModal').style.display = 'block';
    }

    // Κλείσιμο του modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Αποθήκευση των αλλαγών
    function saveChanges() {
        var id = document.getElementById('editId').value;
        var trainer = document.getElementById('editTrainer').value;
        var type = document.getElementById('editType').value;
        var day = document.getElementById('editDay').value;
        var startTime = document.getElementById('editStartTime').value;
        var finishTime = document.getElementById('editFinishTime').value;
        var capacity = document.getElementById('editCapacity').value;

        // Εδώ θα χρειαστεί να καλέσετε έναν server-side κώδικα για να αποθηκεύσετε τις αλλαγές στη βάση δεδομένων
        // Παράδειγμα με χρήση του fetch:
        fetch('update_program.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + id + '&trainer=' + trainer + '&type=' + type + '&day=' + day + '&startTime=' + startTime + '&finishTime=' + finishTime + '&capacity=' + capacity,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                closeModal();
                // Επαναφορά της σελίδας για να ανανεωθούν τα δεδομένα
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    function deleteFunction(id) {
        // Υλοποίηση της διαγραφής από τη βάση δεδομένων
        // Σε αυτό το παράδειγμα χρησιμοποιείται JavaScript για επικοινωνία με τον server
        
        var confirmation = confirm("Are you sure you want to delete the program with ID " + id + "?");

        if (confirmation) {
            
            // Παράδειγμα με χρήση του fetch:
            fetch('delete_program.php?id=' + id, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    alert("Program with ID " + id + " deleted successfully");
                    // Επαναφορά της σελίδας για να ανανεωθούν τα δεδομένα
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
        }
    }


    // Εμφάνιση του modal. Οι συναρτήσεις οι από κάτω μέχρι τη συνάρτηση "deleteNewsFunction" αφορούν τη καρτέλα "news"
    function openNewsModal(id) {
        // Προβολή των τρεχουσών τιμών στο modal
    var trainerElement = document.getElementById('text_' + id);
    if (trainerElement) {
        document.getElementById('editText').value = trainerElement.innerText;
    }

    document.getElementById('editNewsId').value = id;

    // Εμφάνιση του modal
    document.getElementById('myNewsModal').style.display = 'block';
    }

    // Κλείσιμο του modal
    function closeNewsModal() {
        document.getElementById('myNewsModal').style.display = 'none';
    }


    function saveNewsChanges() {
        var id = document.getElementById('editNewsId').value;
        var text = document.getElementById('editText').value;
        

        // Εδώ θα χρειαστεί να καλέσετε έναν server-side κώδικα για να αποθηκεύσετε τις αλλαγές στη βάση δεδομένων
        // Παράδειγμα με χρήση του fetch:
        fetch('update_news.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + id + '&text=' + text,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                closeNewsModal();
                // Επαναφορά της σελίδας για να ανανεωθούν τα δεδομένα
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteNewsFunction(id) {
        // Υλοποίηση της διαγραφής από τη βάση δεδομένων
        // Σε αυτό το παράδειγμα χρησιμοποιείται JavaScript για επικοινωνία με τον server
        
        var confirmation = confirm("Are you sure you want to delete the news with ID " + id + "?");

        if (confirmation) {
            
            // Παράδειγμα με χρήση του fetch:
            fetch('delete_news.php?id=' + id, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    alert("Program with ID " + id + " deleted successfully");
                    // Επαναφορά της σελίδας για να ανανεωθούν τα δεδομένα
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
        }
    }


  </script>

</head>
<body>
<div>Gym-Application</div>

<div id="tabs">
  <div class="tab" data-tab="news">News</div>
  <div class="tab" data-tab="programs">Programs</div>
  <div class="tab" data-tab="users">Users</div>
  <div class="tab" data-tab="admins">Administrators</div>
  <div class="tab" data-tab="registrations">Registrations</div>
</div>

<div id="news" class="tab-content">
 
<form id="news-form">
    <label for="newsAdd">News:</label>
    <input type="text" id="newsAdd" name="newsAdd" required>

    <button type="button" id="submit-news">Add News</button>
  </form>
  
    <p>News</p>


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

    // Εκτέλεση ερωτήματος για να ανακτήσετε τα δεδομένα από τον πίνακα "news"
    $sql = "SELECT ID, Text FROM news";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Εμφάνιση των δεδομένων σε πίνακα
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Text</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Text"] . "</td>";
            echo "<td><button onclick='openNewsModal(" . $row["ID"] . ")'>Edit</button>";
            echo "<button onclick='deleteNewsFunction(" . $row["ID"] . ")'>Delete</button></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

<div id="myNewsModal" class="modal">
    <div class="modal-News-content">
        <span class="close" onclick="closeNewsModal()">&times;</span>
        <h2>Edit News</h2>
        <form id="editNewsForm">
            <label for="editText">Text:</label>
            <input type="text" id="editText" name="editText" required>

            <input type="hidden" id="editNewsId" name="editNewsId">
            <button type="button" onclick="saveNewsChanges()">Save Changes</button>
        </form>
    </div>
</div>



</div>

<div id="programs" class="tab-content">
<form id="programs-form">
    <label for="trainer">Trainer:</label>
    <input type="text" id="trainer" name="trainer" required>

    <label for="type">Type of program:</label>
    <input type="text" id="type" name="type" required>

    <label for="day">Day:</label>
    <input type="text" id="day" name="day" required>

    <label for="startTime">Starting Time:</label>
    <input type="time" id="startTime" name="startTime" required>

    <label for="finishTime">Finishing Time:</label>
    <input type="time" id="finishTime" name="finishTime" required>

    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" required>

    <button type="button" id="submit-program">Add Program</button>
  </form>
  
  <p>Available Programs </p>

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
        echo "<tr><th>ID</th><th>Trainer</th><th>Type</th><th>Day</th><th>StartTime</th><th>FinishTime</th><th>Capacity</th><th>Actions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Trainer"] . "</td>";
            echo "<td>" . $row["Type"] . "</td>";
            echo "<td>" . $row["Day"] . "</td>";
            echo "<td>" . $row["StartTime"] . "</td>";
            echo "<td>" . $row["FinishTime"] . "</td>";
            echo "<td>" . $row["Capacity"] . "</td>";
            echo "<td><button onclick='openModal(" . $row["ID"] . ")'>Edit</button>";
            echo "<button onclick='deleteFunction(" . $row["ID"] . ")'>Delete</button></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Program</h2>
        <form id="editForm">
            <label for="editTrainer">Trainer:</label>
            <input type="text" id="editTrainer" name="editTrainer" required>

            <label for="editType">Type of program:</label>
            <input type="text" id="editType" name="editType" required>

            <label for="editDay">Day:</label>
            <input type="text" id="editDay" name="editDay" required>

            <label for="editStartTime">Starting Time:</label>
            <input type="time" id="editStartTime" name="editStartTime" required>

            <label for="editFinishTime">Finishing Time:</label>
            <input type="time" id="editFinishTime" name="editFinishTime" required>

            <label for="editCapacity">Capacity:</label>
            <input type="number" id="editCapacity" name="editCapacity" required>

            <input type="hidden" id="editId" name="editId">
            <button type="button" onclick="saveChanges()">Save Changes</button>
        </form>
    </div>
</div>



</div>

<div id="users" class="tab-content">

<?php 
  $servername = "localhost";
  $username = "root";
  $password = ""; 
  $dbname = "gym";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection error: " . $conn->connect_error);
  }

  // Επιλογή όλων των εγγραφών από τον πίνακα "register"
  $sql = "SELECT * FROM user";
  $result = $conn->query($sql);

  // Εμφάνιση των εγγραφών σε μια HTML λίστα
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="user-item" data-id="' . $row['ID'] . '">';
      echo '<p><strong>Name:</strong> ' . $row['Name'] . '</p>';
        echo '<p><strong>Last Name:</strong> ' . $row['Lastname'] . '</p>';
        echo '<p><strong>Country:</strong> ' . $row['Country'] . '</p>';
        echo '<p><strong>City:</strong> ' . $row['City'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $row['Address'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $row['Email'] . '</p>';
      echo '<p> <strong>Username:</strong> '. $row['Username'] . '</p>';
      echo '<button class="user-action-button" data-action="admin">Admin</button>';
      echo '<button class="user-action-button" data-action="delete">Delete</button>';
      echo '</div>';
    }
  }
  ?>
  
  
</div>

<div id="admins" class="tab-content">
<?php 
  $servername = "localhost";
  $username = "root";
  $password = ""; 
  $dbname = "gym";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection error: " . $conn->connect_error);
  }

  // Επιλογή όλων των εγγραφών από τον πίνακα "register"
  $sql = "SELECT * FROM admin";
  $result = $conn->query($sql);

  // Εμφάνιση των εγγραφών σε μια HTML λίστα
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="admin-item" data-id="' . $row['ID'] . '">';
      echo '<p><strong>Name:</strong> ' . $row['Name'] . '</p>';
        echo '<p><strong>Last Name:</strong> ' . $row['Lastname'] . '</p>';
        echo '<p><strong>Country:</strong> ' . $row['Country'] . '</p>';
        echo '<p><strong>City:</strong> ' . $row['City'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $row['Address'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $row['Email'] . '</p>';
      echo '<p> <strong>Username:</strong> '. $row['Username'] . '</p>';
      echo '<button class="admin-action-button" data-action="user">User</button>';
      echo '<button class="admin-action-button" data-action="delete">Delete</button>';
      echo '</div>';
    }
  }
  ?>
  
  
</div>

<div id="registrations" class="tab-content">
  
  <?php 
  $servername = "localhost";
  $username = "root";
  $password = ""; 
  $dbname = "gym";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection error: " . $conn->connect_error);
  }

  // Επιλογή όλων των εγγραφών από τον πίνακα "register"
  $sql = "SELECT * FROM register";
  $result = $conn->query($sql);

  // Εμφάνιση των εγγραφών σε μια HTML λίστα
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="registration-item" data-id="' . $row['ID'] . '">';
      echo '<p><strong>Name:</strong> ' . $row['NAME'] . '</p>';
        echo '<p><strong>Last Name:</strong> ' . $row['Lastname'] . '</p>';
        echo '<p><strong>Country:</strong> ' . $row['Country'] . '</p>';
        echo '<p><strong>City:</strong> ' . $row['City'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $row['Address'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $row['Email'] . '</p>';
      echo '<p> <strong>Username:</strong> '. $row['Username'] . '</p>';
      echo '<button class="registration-action-button" data-action="user">User</button>';
      echo '<button class="registration-action-button" data-action="admin">Admin</button>';
      echo '<button class="registration-action-button" data-action="delete">Delete</button>';
      echo '</div>';
    }
  }
  ?>
  
</div>






</body>
</html>