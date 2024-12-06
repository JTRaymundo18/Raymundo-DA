<?php
include("connect.php");

$aircraftFilter = '';
$creditCardFilter = '';
$sort = '';
$order = '';

if(isset($_GET['btnSubmit'])){
$aircraftFilter = $_GET['aircraftType'];
$creditCardFilter = $_GET['creditCardType'];
$sort = $_GET['sort'];
$order = $_GET['order'];
}

$flightsQuery = "SELECT * FROM flightlogs";

if ($aircraftFilter != '' || $creditCardFilter != '') {
  $flightsQuery = $flightsQuery . " WHERE";

  if ($aircraftFilter != '') {
    $flightsQuery = $flightsQuery . " aircraftType ='$aircraftFilter'";
  }

  if ($aircraftFilter != '' && $creditCardFilter != '') {
    $flightsQuery = $flightsQuery . " AND";
  }

  if ($creditCardFilter != '') {
    $flightsQuery = $flightsQuery . " creditCardType ='$creditCardFilter'";
  }
}

if ($sort != '') {
  $flightsQuery = $flightsQuery . " ORDER BY $sort";

  if ($order != '') {
    $flightsQuery = $flightsQuery . " $order";
  }
}

$sortClass = function ($column) use ($sort) {
  return ($sort == $column) ? 'sorted' : '';
};

$flightResults = executeQuery($flightsQuery);

$aircraftQuery = "SELECT DISTINCT(aircraftType) FROM flightlogs";
$aircraftResults = executeQuery($aircraftQuery);

$creditCardQuery = "SELECT DISTINCT(creditCardType) FROM flightlogs";
$creditCardResults = executeQuery($creditCardQuery);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/icon.png">
  <title>Flight Information Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
  td.sorted {
    background-color: #4dff91 !important;
    font-weight: bold;
  }
</style>

<body>
  <div class="container">

    <div class="display-3 my-5 text-center" style="font-family: Times New Roman">
      PUP Airport Information Finder
    </div>

    <div class="row my-5">
      <div class="col-12">

        <form>
          <div class="card p-4 rounded-5 shadow" style="border: 5px solid #2056e8; background-color: #caede9">
            <div class="row">
              <div class="h1 text-center" style="font-family: Times New Roman">
                <b>Filter Options</b>
              </div>
              <div class="col">


                <label class=" my-3" for="creditCardTypeSelect"><b>Credit Card Type</b></label>
                <select id="creditCardTypeSelect" name="creditCardType" class="ms-2 form-control"
                  style="width: fit-content; border: 3px solid #2056e8">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($creditCardResults) > 0) {
                    while ($creditCardRow = mysqli_fetch_assoc($creditCardResults)) {
                      ?>

                      <option <?php if ($creditCardFilter == $creditCardRow['creditCardType']) {
                        echo "selected";
                      } ?>
                        value="<?php echo $creditCardRow['creditCardType'] ?>">
                        <?php echo $creditCardRow['creditCardType'] ?>
                      </option>

                      <?php
                    }
                  }
                  ?>
                </select>


                <label class=" my-3" for="aircraftTypeSelect"><b>Aircraft Type</b></label>
                <select id="aircraftTypeSelect" name="aircraftType" class="ms-2 form-control"
                  style="width: fit-content; border: 3px solid #2056e8">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($aircraftResults) > 0) {
                    while ($aircraftRow = mysqli_fetch_assoc($aircraftResults)) {
                      ?>

                      <option <?php if ($aircraftFilter == $aircraftRow['aircraftType']) {
                        echo "selected";
                      } ?>
                        value="<?php echo $aircraftRow['aircraftType'] ?>">
                        <?php echo $aircraftRow['aircraftType'] ?>
                      </option>

                      <?php
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="col">
                <label for="sort" class="ms-2 mb-2 my-3"><b>Sort By</b></label>
                <select id="sort" name="sort" class="ms-2 form-control"
                  style="width: fit-content; border: 3px solid #2056e8">
                  <option value="">None</option>
                  <option <?php if ($sort == "pilotName") {
                    echo "selected";
                  } ?> value="pilotName">Pilot Name</option>
                  <option <?php if ($sort == "airlineName") {
                    echo "selected";
                  } ?> value="airlineName">Airline Name
                  </option>
                  <option <?php if ($sort == "flightNumber") {
                    echo "selected";
                  } ?> value="flightNumber">Flight Number
                  </option>
                  <option <?php if ($sort == "ticketPrice") {
                    echo "selected";
                  } ?> value="ticketPrice">Ticket Price
                  </option>
                  <option <?php if ($sort == "flightDurationMinutes") {
                    echo "selected";
                  } ?> value="flightDurationMinutes">
                    Flight Duration
                  </option>
                </select>

                <label for="order" class="ms-2 mt-4 mb-2"><b>Order</b></label>
                <select id="order" name="order" class="ms-2 form-control"
                  style="width: fit-content; border: 3px solid #2056e8">
                  <option <?php if ($order == "ASC") {
                    echo "selected";
                  } ?> value="ASC">Ascending</option>
                  <option <?php if ($order == "DESC") {
                    echo "selected";
                  } ?> value="DESC">Descending</option>
                </select>
              </div>
            </div>

            <div class="text-center">
              <button class="btn btn-primary ms-2 mt-4" style="width: fit-content" name="btnSubmit">Process Query</button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row my-5">
      <div class="col">
        <div class="card p-4 rounded-5" style="border: 5px solid #2056e8; background-color: #e8fcfa;">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Flight Number</th>
                  <th scope="col">Pilot Name</th>
                  <th scope="col">Aircraft Type</th>
                  <th scope="col">Airline Name</th>
                  <th scope="col">Flight Duration</th>
                  <th scope="col">Ticket Price</th>
                  <th scope="col">Credit Card Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($flightResults) > 0) {
                  while ($flightRow = mysqli_fetch_assoc($flightResults)) {

                    // Converts 'flightDurationMinutes' into hours and minutes notation
                    $flightHour = '';
                    $flightMinute = '';
                    $flightTime = '';

                    // Hour Conversion Conditions
                    if ($flightRow['flightDurationMinutes'] < 60) {
                      $flightHour = '';
                    } else if ($flightRow['flightDurationMinutes'] >= 60 && $flightRow['flightDurationMinutes'] < 120) {
                      $flightHour = (int) ($flightRow['flightDurationMinutes'] / 60) . " hr.";
                    } else {
                      $flightHour = (int) ($flightRow['flightDurationMinutes'] / 60) . " hrs.";
                    }

                    // Minute Conversion Conditions
                    if ($flightRow['flightDurationMinutes'] % 60 == 0) {
                      $flightMinute = '';
                    } else if ($flightRow['flightDurationMinutes'] % 60 == 1) {
                      $flightMinute = ($flightRow['flightDurationMinutes'] % 60) . " minute";
                    } else {
                      $flightMinute = ($flightRow['flightDurationMinutes'] % 60) . " minutes";
                    }

                    // flightTime Implementation
                    if ($flightHour != '' && $flightMinute != '') {
                      $flightTime = $flightHour . " & " . $flightMinute;
                    } else {
                      $flightTime = $flightHour . "" . $flightMinute;
                    }

                    ?>
                    <tr>
                      <td class="<?php echo $sortClass('flightNumber'); ?>">
                        <?php echo $flightRow['flightNumber'] ?></th>
                      <td class="<?php echo $sortClass('pilotName'); ?>"><?php echo $flightRow['pilotName'] ?></td>
                      <td class="<?php echo $sortClass('aircraftType'); ?>"><?php echo $flightRow['aircraftType'] ?></td>
                      <td class="<?php echo $sortClass('airlineName'); ?>"><?php echo $flightRow['airlineName'] ?></td>
                      <td class="<?php echo $sortClass('flightDurationMinutes'); ?>"><?php echo $flightTime ?></td>
                      <td class="<?php echo $sortClass('ticketPrice'); ?>"><?php echo $flightRow['ticketPrice'] ?></td>
                      <td class="<?php echo $sortClass('creditCardType'); ?>"><?php echo $flightRow['creditCardType'] ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
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