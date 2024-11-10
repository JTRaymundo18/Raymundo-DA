<?php
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?></title>
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

    .card:hover {
      transform: scale(1.05);
    }
</style>

<body> 
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top"
    style="border: 3px solid #000000; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; 
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
          <div class="h2 mb-4" style="font-family: Georgia">User Info</div>
            <div><b>
                <?php 
                if (isset($_SESSION['birthDay']) && $_SESSION['birthDay'] !== '0000-00-00') {
                    echo "Birthday: " . $_SESSION['birthDay'];
                } else {
                    echo "Birthday has not been set";
                }
                ?></b>
            </div>          
            <div><b>Phone: <?php echo $_SESSION['phoneNumber'] ?></b></div>
          <div><b>Email: <?php echo $_SESSION['email'] ?></b></div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>