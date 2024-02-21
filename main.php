<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Gym Application</title>
</head>
<body>
<div>Gym-Application</div>
<?php
$showRegisterForm = false;
 $showLoginForm = false;
 $showLogin1Form = false;
 $showServices = false;


if (isset($_POST['login'])){
    $showLoginForm = true;
    include "Login.php";
 
}

if(isset($_POST['register'])){
    $showRegisterForm = true;
    include "Register.php";
}

if (isset($_POST['login1'])){
    $showLogin1Form = true;
    include "Login1.php";
 
}

if (isset($_POST['services'])){
    $showServices = true;
    include "Services.php";
 
}

?>

<?php if (!$showLoginForm) : ?>
<?php if (!$showRegisterForm) : ?>
<?php if (!$showLogin1Form) : ?>    
 <?php if (!$showServices) : ?>


<form method="post" action="">
    <button type="submit" name="services">Gym Services</button>
    <button type="submit" name="login">Login/User</button>
    <button type="submit" name="login1">Login/Admin</button>
    <button type="submit" name="register">Register</button>
</form>

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

</body>
</html>
