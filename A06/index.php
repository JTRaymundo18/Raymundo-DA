<?php
include("connect.php");

$query = "SELECT clients.*, userInfo.*, addresses.*, city.name AS 'cityName', province.name AS 'provinceName' FROM clients LEFT JOIN userinfo ON clients.userInfoID = userinfo.userInfoID 
LEFT JOIN addresses ON userinfo.userInfoID = addresses.userInfoID LEFT JOIN city ON addresses.cityID = city.cityID LEFT JOIN province ON addresses.provinceID = province.provinceID; ";
$result = executeQuery($query);


if(isset($_POST['btnDelete'])){
  $clientID = $_POST['clientID'];
  $deleteUserInfoQuery = "DELETE FROM userInfo WHERE userInfoID = (SELECT userInfoID FROM clients WHERE clientID = '$clientID')";
  executeQuery($deleteUserInfoQuery);

  $deleteQuery = "DELETE FROM clients WHERE clientID = '$clientID'";
  executeQuery($deleteQuery);

}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DA AO6</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
.card {
  transition: transform 0.4s;
  }

.card:hover {
  transform: scale(1.05);
}

</style>

<body>
  <div class="container-fluid shadow mb-5 p-3" 
  style="border: 5px solid #1cc8fc; background: #080a0a; border-bottom-left-radius: 5px; border-bottom-right-radius: 5x; 
        font-family: Georgia; color: #aee7f5">
    <h1>Admin Panel</h1>
  </div>

  <div class="container">
    <div class="row">

      <!-- PHP BLOCK -->
      <?php
      if (mysqli_num_rows($result)) {
        while ($client = mysqli_fetch_assoc($result)) {
          ?>

          <div class="col-12">
            <div class="card rounded-4 shadow my-3 mx-5"
              <?php if($client["isOnline"] == "Yes"){
                echo "style='border: 5px solid #2afa62; background-color: #1a1c1f; color: #e6ffeb'";
              } else {
                echo "style='border: 5px solid #ff3b62; background-color: #1a1c1f; color: #ffe7e6'";
              }?>
            >
              <div class="card-body">
                <h3 class="card-title" style="font-family: Georgia">
                  <?php echo $client["firstName"] . " " . $client["lastName"] ?>
                </h3>
                <h5 class="card-subtitle my-3" style="font-family: Arial"><i>
                  <?php
                  if ($client["addressID"] != "") {
                    echo $client["cityName"] . ", " . $client["provinceName"];
                  } else {
                    echo "-----";
                  }
                  ?></i>
                </h5>
                <p class="card-text" style="font-family: Arial">Contact me at <u><b>
                 <?php echo $client["email"]?></b></u> OR <u><b> <?php echo $client["phoneNumber"]?></b></u>
                </p>

                <p class="card-text" style="font-family: Arial"> Did you know? My birthdate is on
                <b><?php echo $client["birthDay"]?></b>!
                </p>

                <p class="card-text" style="font-family: Arial"> I am currently <b>
                <?php if($client["isOnline"] == "Yes"){
                  echo "ONLINE :)";
                 } else {
                  echo "OFFLINE :(";
                  }?> </b>
                </p>

                <form method="post">
                  <input type="hidden" value="<?php echo $client['clientID']?>" name="clientID">
                  <button class="btn btn-danger" name="btnDelete">Remove</button>
                </form>

              </div>
            </div>
          </div>
          <?php
        }
      }
      ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>