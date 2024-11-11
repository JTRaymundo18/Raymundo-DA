<?php
include('connect.php');

// CHECK IF THE BUTTON WAS CLICKED
if(isset($_POST['btnSubmitInfo'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $phoneNumber = $_POST['phoneNumber'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];


  
$accountQuery = "INSERT INTO clients(username, password, email, phoneNumber) VALUES ('$username', '$password', '$email', '$phoneNumber')";
executeQuery($accountQuery);

$userQuery = "INSERT INTO userInfo(firstName, lastName) VALUES ('$firstName', '$lastName')";
executeQuery($userQuery);
  header("Location: login.php");
}

$query = "SELECT * FROM clients JOIN userinfo ON clients.userInfoID = userinfo.userInfoID";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>M01</title>
  <link rel="icon" href="images/usericon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="shared/css/style.css">
</head>

<style>
    body {
        background-image: url('images/signup.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100vh;
        margin: 0;
    }

    .glass-shine-effect {
        background: linear-gradient(135 deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

</style>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top"
    style="border: 3px solid #000000; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; 
    background: linear-gradient(to top right, #ffffff, #1978fc)">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center mx-3" href="login.php" style="font-family: Georgia;">
            <h2>Back to Login</h2>
        </a>
    </div>
</nav>
<div class="container">
    <div class="row my-5">
        <div class="col">
            <div class="display-3 text-center" style="color: white; font-family: Georgia">
                Sign Up
            </div>
        </div>
    </div>

  <div class="container glass-shine-effect my-5">
    <div class="row my-5 justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card p-3 text-center" style="background-color: rgba(255, 255, 255, 0);">
                <h2 class="mb-5" style="color: white; font-family: Georgia">Create New Account</h2>
                <form method="post">
                    <div class="mb-3">

                    <input type="text" name="firstName" placeholder="First Name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3 glass-shine-effect">
                    <input type="text" name="lastName" placeholder="Last Name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3 glass-shine-effect">
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                    </div>
                    
                    <div class="mb-3 glass-shine-effect">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                    </div>
                    
                    <div class="mb-3 glass-shine-effect">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                    </div>
                    
                    <div class="mb-3 glass-shine-effect">
                    <input type="text" name="phoneNumber" placeholder="Phone Number" class="form-control">
                    </div>

                    <button type="submit" name="btnSubmitInfo" class="btn btn-primary w-100">
                    Submit
                    </button>
                    
                </form>
            </div>
        </div>
    </div>
    </div>
</div>

   
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>