<?php 

 $servername = "localhost";
 $username = "root";
 $password = ""; 
 $dbname = "gym";
 
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
     die("Connection error: " . $conn->connect_error);
 }
 
     $name = $_POST['name'];
     $last_name = $_POST['lname'];
     $country = $_POST['country'];
     $city = $_POST['city'];
     $address = $_POST['address'];
     $email = $_POST['email'];
     $username = $_POST['uname'];
     $password = $_POST['pass'];
     $cpassword = $_POST['cpass'];
 
     $check_query = "SELECT * FROM register WHERE Username = '$username' OR Email = '$email'";
     $result = mysqli_query($conn, $check_query);
 
     if ($result) {
         $user = mysqli_fetch_assoc($result);
 
         if ($user) {
             echo "User already exists";
         } else {
             if (empty($name) || empty($last_name) || empty($country) || empty($city) || empty($address) || empty($email) || empty($username) || empty($password) || empty($cpassword)) {
                 echo "Please fill in all fields.";
             } else {
                 if ($password != $cpassword) {
                     echo "The passwords do not match";
                 } else {
                     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                     $sql = "INSERT INTO register (NAME, Lastname, Country, City, Address, Email, Username, PASSWORD) VALUES ('$name', '$last_name', '$country', '$city', '$address', '$email', '$username', '$hashed_password')";
                     $conn->query($sql);
                     echo "Registration pending";
                 }
             }
         }
     } else {
         echo "Error in query execution: " . mysqli_error($conn);
     }
 
 ?>