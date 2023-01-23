<?php
// DATABASE 
require_once '../database/connection.php';
// SESSION
require './php/session.php';

$date = date('m/d/Y');

// USERS
$sqlUsers = "SELECT * FROM users_accounts";
$stmtUsers = $con->prepare($sqlUsers);
$stmtUsers->execute();
$results = $stmtUsers->fetch();
$company = $_SESSION['company_name'] = $results->company;

// RESERVATIONS
$sqlReservation = "SELECT * FROM reservations WHERE statuses = 'APPROVED' AND date_from = CURRENT_DATE() ORDER BY time_from ASC";
$stmtReservation = $con->prepare($sqlReservation);
$stmtReservation->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SCHEDULES</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./styles/dashboard.css" />

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
  <script src="./js/dataTable.js" defer></script>

  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/8cbc2e0f0e.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <i class="fa-sharp fa-solid fa-bars-staggered __icon"></i>
      </button>
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="#">Facility Management System</a>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
          <li class="nav-item text-center">
            <a href="schedules.php" class="nav-link text-light">Schedules</a>
          </li>
          <li class="nav-item text-center">
            <a href="reservation.php" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="accept.php" class="nav-link text-light">Approved</a>
          </li>
          <li class="nav-item text-center">
            <a href="cancellation.php" class="nav-link text-light">Cancellation</a>
          </li>
          <li class="nav-item text-center">
            <a href="./pending_reservation.php" class="nav-link text-light">Pending Reservation</a>
          </li>

          <!-- USERS MENU -->
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <i class="fa-sharp fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li class="nav-item text-center">
                <a class="dropdown-item" href="./change_pass.php">Change Password</a>
              </li>
              <li class="nav-item text-center">
                <a class="dropdown-item" href="./history.php">History</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="nav-item text-center">
                <a class="dropdown-item" href="./php/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <!-- TABLE -->
  <div class="container-fluid mt-5">
    <div class="container bg-primary shadow p-3 mb-5 bg-body rounded">
      <p class="h1 text-center mb-3">Schedules Today</p>
      <table class="table table-striped table-hover" id="myTable">
        <thead>
          <tr>
            <th>Room No.</th>
            <th>Room Type</th>
            <th>Time From</th>
            <th>Time To</th>
            <th>Reserved By</th>
            <th>Company</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($rowReservations = $stmtReservation->fetch()) { ?>
            <tr>
              <td><?php echo $rowReservations->rsvn_no ?></td>
              <td><?php echo $rowReservations->room_type ?></td>
              <td><?php echo date("h:i A", strtotime($rowReservations->time_from)) ?></td>
              <td><?php echo date("h:i A", strtotime($rowReservations->time_to)) ?></td>
              <td><?php echo $rowReservations->created_by ?></td>
              <td><?php echo $company ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>