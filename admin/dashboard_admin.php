<?php 
  // DATABASE
  require_once $_SERVER["DOCUMENT_ROOT"] . "/facility_management/database/connection.php";
  // SESSION
  require ('./php/session.php');

  // USERS ACCOUNTS QUERY
  $queryUsers = "SELECT * FROM users_accounts";
  $sqlUsers = mysqli_query($con, $queryUsers);
  $results = mysqli_fetch_assoc($sqlUsers);
  $company = $_SESSION['company_name'] = $results['company'];

  // RESERVATION QUERY
  $queryReadReservations = "SELECT * FROM reservations WHERE statuses = 'APPROVED' AND date_from = CURRENT_DATE() ORDER BY time_from ASC ";
  $sqlReadReservations = mysqli_query($con, $queryReadReservations);

  // TOTAL RESERVATION
  $queryTotalReservations = "SELECT statuses FROM reservations ORDER BY statuses";
  $sqlTotalReservations = mysqli_query($con, $queryTotalReservations);
  $row = mysqli_num_rows($sqlTotalReservations);

  // FOR CONFIRMATION
  $queryForConfirm = "SELECT statuses FROM reservations WHERE statuses = 'PENDING' ORDER BY statuses";
  $sqlForConfirm = mysqli_query($con, $queryForConfirm);
  $rowForConfirm = mysqli_num_rows($sqlForConfirm);

  // TOTAL CONFIRMATION
  $queryTotalConfirm = "SELECT statuses FROM reservations WHERE statuses = 'APPROVED' ORDER BY statuses";
  $sqlTotalConfirm = mysqli_query($con, $queryTotalConfirm);
  $rowConfirm = mysqli_num_rows($sqlTotalConfirm);

  // TOTAL CANCELLED
  $queryTotalCancel = "SELECT statuses FROM reservations WHERE statuses = 'REJECT' ORDER BY statuses";
  $sqlTotalCancel = mysqli_query($con, $queryTotalCancel);
  $rowCancel = mysqli_num_rows($sqlTotalCancel);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DASHBOARD ADMIN</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="./styles/dashboard-admin.css" />

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>

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
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="dashboard_admin.php">Facility Management
        System</a>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
          <li class="nav-item text-center">
            <a href="dashboard_admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="pending_reservation.php" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="cancellation.php" class="nav-link text-light">Cancellation</a>
          </li>
          <li class="nav-item dropdown text-center">
            <a class="nav-link dropdown-toggle text-center text-light" href="#" data-bs-toggle="dropdown">
              Masterfile
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="register.php">User</a></li>
              <li><a class="dropdown-item" href="company.php">Company</a></li>
              <li><a class="dropdown-item" href="floor_master.php">Floor Master</a></li>
              <li><a class="dropdown-item" href="facility_type.php">Facility Type</a></li>
              <li><a class="dropdown-item" href="facility_room_master.php">Facility Room Master</a></li>
            </ul>
          </li>
          <!-- USERS MENU -->
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <i class="fa-sharp fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li class="nav-item text-center">
                <a class="dropdown-item" href="./change_password.php">Change Password</a>
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

  <!-- SCHEDULES -->
  <div class="container-fluid mt-5">
    <div class="container">
      <!-- INFORMATION -->
      <div class="row gap-3 justify-content-center">
        <div class="col-12 col-md-4 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">
            Total Reservation
          </p>
          <p class="fs-1 text-warning fw-bold text-center"><?php echo $row ?></p>
        </div>
        <div class="col-12 col-md-4 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">
            For Confirmation
          </p>
          <p class="fs-1 text-warning fw-bold text-center"><?php echo $rowForConfirm ?></p>
        </div>
        <div class="col-12 col-md-4 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">Total Confirmed</p>
          <p class="fs-1 text-warning fw-bold text-center"><?php echo $rowConfirm  ?></p>
        </div>
        <div class="col-12 col-md-4 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">Total Cancelled</p>
          <p class="fs-1 text-warning fw-bold text-center"><?php echo $rowCancel ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="container-fluid mt-5">
    <div class="container bg-primary shadow p-3 mb-5 bg-body rounded">
      <p class="h1 text-center mb-3">Schedules Today</p>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Room No.</th>
            <th scope="col">From:</th>
            <th scope="col">To:</th>
            <th scope="col">Reserved By:</th>
            <th scope="col">Company:</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php while($rowUsers = mysqli_fetch_assoc($sqlReadReservations)) { ?>
          <tr>
            <td><?php echo $rowUsers['rsvn_no'] ?></td>
            <td><?php echo date("h:i A", strtotime($rowUsers['time_from'])) ?></td>
            <td><?php echo date("h:i A", strtotime($rowUsers['time_to'])) ?></td>
            <td><?php echo $rowUsers['created_by'] ?></td>
            <td><?php echo $company ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>