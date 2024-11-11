<?php
include("connect.php");

session_start();
session_destroy();
session_start();

$error = "";

if (isset($_POST['btnLogin'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM clients JOIN userinfo ON clients.userInfoID = userinfo.userInfoID WHERE email = '$email' AND password = '$password'";
  $result = executeQuery($query);

  if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_assoc($result)) {
      $_SESSION['firstName'] = $user['firstName'];
      $_SESSION['lastName'] = $user['lastName'];
      $_SESSION['birthDay'] = $user['birthDay'];
      $_SESSION['phoneNumber'] = $user['phoneNumber'];
      $_SESSION['email'] = $user['email'];
    }

    header("Location: index.php");
  } else {
    $error = "Not found";
  }
}
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
    <link rel="stylesheet" href="login.css">
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
  <div class="container">

    <?php if ($error == "Not found") { ?>

      <div class="row">
        <div class="col">
          <div style="height: 50px; font-family: Georgia; font-size: 20px" class="alert alert-danger d-flex align-items-center justify-content-center text-center" role="alert">
            User not found.
          </div>
        </div>
      </div>

    <?php } ?>

    <div class="row my-5 justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card text-center">
          <div class="h3 mb-5" style="color: white; font-family: Georgia">Login</div>
          <form method="POST">
            <input class="my-3 form-control" placeholder="Email" name="email" type="email">
            <input class="my-3 form-control" placeholder="Password" name="password" type="password">
            <button class="my-5 btn btn-primary" name="btnLogin">Login</button>
          </form>
          <p style="color: white">Don't have an account? <a href ="signup.php" >Register here</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>