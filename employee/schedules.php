<?php 
  // DATABASE 
  require_once $_SERVER['DOCUMENT_ROOT'] . './facility_management/database/connection.php';
  // SESSION
  require './php/session.php';

  // USERS SESSION
  // $users_id = $_SESSION['users_id'];
  // $queryReadUsers = "SELECT * FROM users_accounts WHERE id = '$users_id' ";
  // $sqlReadUsers = mysqli_query($con, $queryReadUsers);
  // $rows = mysqli_fetch_assoc($sqlReadUsers);

  // RESERVATION QUERY
  // $queryReadReservations = "SELECT * FROM reservations";
  // $sqlReadReservations = mysqli_query($con, $queryReadReservations);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SCHEDULES</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/schedules.css" />
  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="./js/calendar_schedules.js" defer></script>
  <script src="../node_modules/fullcalendar/index.global.js"></script>
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
            <a href="dashboard.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="reservation.php" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="schedules.php" class="nav-link text-light">Schedules</a>
          </li>
          <li class="nav-item text-center">
            <a href="cancellation.php" class="nav-link text-light">Cancellation</a>
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
                <a class="dropdown-item" href="./php/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="container mt-5">
      <div id="calendar"></div>

    </div>
  </div>
  <!-- INQUIRE -->
  <!-- <div class="container-fluid mt-5">
    <div class="container shadow p-3 mb-5 bg-body rounded w-auto">
      <div class="table-responsive mt-5">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Room No.</th>
              <th scope="col">8:00 A.M</th>
              <th scope="col">8:30 A.M</th>
              <th scope="col">9:00 A.M</th>
              <th scope="col">9:30 A.M</th>
              <th scope="col">10:00 A.M</th>
              <th scope="col">10:30 A.M</th>
              <th scope="col">11:00 A.M</th>
              <th scope="col">11:30 A.M</th>
              <th scope="col">12:00 NN</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td>Sample Room No.</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
            </tr>
            <tr>
              <td>Sample Room No.</td>
              <td>Sample Reserved</td>
              <td>Sample Reserved</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>Sample Reserved</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div> -->
</body>

</html>