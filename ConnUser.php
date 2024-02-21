<?php 
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$username = $_POST['uname'];
$password = $_POST['pass'];

$sql = "SELECT Password FROM user WHERE Username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result){
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['Password'])){
        header("Location: UserInterface.php?username=$username&password=$password");
    }else{
        echo "Incorrect password.";
    }
}else{
    echo "Incorrect Username";
}
mysqli_close($conn);
?>