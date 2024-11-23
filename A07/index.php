<?php
session_start();
include("connect.php");

$error = "";

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}

$clientID = $_SESSION['clientID'];

if (isset($_POST['btnUpdateInfo'])) {
  $userName = $_POST['userName'];
  $confirmPassword = $_POST['confirmPassword'];
  $newPassword = $_POST['newPassword'];
  $phoneNumber = $_POST['phoneNumber'];
  $email = $_POST['email'];

  if ($newPassword == $confirmPassword) {
    $updateInfoQuery = "UPDATE clients SET userName = '$userName' , password = '$confirmPassword', `email`= '$email',`phoneNumber`='$phoneNumber' WHERE clientID = '$clientID' ";
    executeQuery($updateInfoQuery);

    $query = "SELECT * FROM clients WHERE clientID = '$clientID'";
    $result = executeQuery($query);

    $_SESSION['userName'] = $user['userName'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['phoneNumber'] = $user['phoneNumber'];

    header("Location: index.php");
    exit();

  } else {
    $error = "FAILED";
  }

}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?></title>
  <link rel="icon" href="images/usericon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<style>
  @keyframes gradientMove {
    0% {
      background-position: 0% 0%;
    }

    50% {
      background-position: 100% 0%;
    }

    100% {
      background-position: 0% 0%;
    }
  }

  .card {
    border: 3px solid black;
    background: linear-gradient(to top left, #16ebfa, #bafaff);
    animation: gradientMove 3s ease-in-out infinite;
    transition: transform 0.3s;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" style="border: 3px solid #000000; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; 
    background: linear-gradient(to bottom, #ffffff,  #1978fc)">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center mx-3" href="index.php" style="font-family: monospace;">
        <h2>HOME</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-3">
            <a class="nav-link active" aria-current="page" href="login.php"
              style="color:#000000; font-family: Georgia; font-size: 20px">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row my-5">
      <div class="col">
        <div class="display-3">
          Welcome, <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?>!
        </div>
      </div>
    </div>
    <div class="row my-5">
      <div class="col">
        <div class="card p-5">
          <div class="h1 mb-4" style="font-family: Georgia">User Info</div>
          <div class="my-2" style="font-family: Arial; font-size: large"><b>Username: <?php echo $_SESSION['userName'] ?></b></div>
          <div class="my-2" style="font-family: Arial; font-size: large"><b>Phone: <?php echo $_SESSION['phoneNumber'] ?></b></div>
          <div class="my-2" style="font-family: Arial; font-size: large"><b>Email: <?php echo $_SESSION['email'] ?></b></div>
          <div class="my-2" style="font-family: Arial; font-size: large">
            <b>
              <?php
              if (isset($_SESSION['birthDay']) && $_SESSION['birthDay'] !== '0000-00-00') {
                echo "Birthday: " . $_SESSION['birthDay'];
              } else {
                echo "Birthday has not been set";
              }
              ?></b>
          </div>
          
          <div class="container mt-5">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#accountCard"
              aria-expanded="false" aria-controls="accountCard">
              Update Account
            </button>
          </div>
        </div>
      </div>
    </div>

    <?php if ($error == "FAILED") { ?>

      <div class="row">
        <div class="col">
          <div style="height: 50px; font-family: Georgia; font-size: 20px"
            class="alert alert-danger d-flex align-items-center justify-content-center text-center" role="alert">
            Update Failed
          </div>
        </div>
      </div>

    <?php } ?>

    <div class="row my-5 justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="collapse" id="accountCard">
          <div class="card p-3 text-center" style="background: #78ffc2">
            <h2 class="mb-5" style="color: black; font-family: Georgia">Update your Account</h2>

            <form method="post">
              <div class="mb-3 d-flex align-items-center">
                <label for="userName" class="col-form-label" style="width: 150px;">Username</label>
                <input type="text" name="userName" placeholder="<?php echo $_SESSION['userName'] ?>"
                  class="form-control" required>
              </div>

              <div class="mb-3 d-flex align-items-center">
                <label for="newPassword" class="col-form-label" style="width: 150px;">New Password</label>
                <input type="password" name="newPassword" placeholder="New Password" class="form-control" required>
              </div>

              <div class="mb-3 d-flex align-items-center">
                <label for="confirmPassword" class="col-form-label" style="width: 150px;">Confirm New Password</label>
                <input type="password" name="confirmPassword" placeholder="Confirm New Password" class="form-control"
                  required>
              </div>

              <div class="mb-3 d-flex align-items-center">
                <label for="phoneNumber" class="col-form-label" style="width: 150px;">Phone Number</label>
                <input type="text" name="phoneNumber" placeholder="<?php echo $_SESSION['phoneNumber'] ?>"
                  class="form-control" required>
              </div>

              <div class="mb-3 d-flex align-items-center">
                <label for="email" class="col-form-label" style="width: 150px;">Change Email</label>
                <input type="email" name="email" placeholder="<?php echo $_SESSION['email'] ?>" class="form-control"
                  required>
              </div>

              <button type="submit" name="btnUpdateInfo" class="btn btn-primary w-100">
                Submit
              </button>
            </form>

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