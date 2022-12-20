<?php 
  // DATABASE 
  require_once $_SERVER['DOCUMENT_ROOT'] . './facility_management/database/connection.php';
  // SESSION
  require './php/session.php';
  
  // CURRENT DATE
  $date = date('m/d/Y');

  // USERS SESSION
  $users_id = $_SESSION['users_id'];
  $queryReadUsers = "SELECT * FROM users_accounts WHERE id = '$users_id' ";
  $sqlReadUsers = mysqli_query($con, $queryReadUsers);
  $rows = mysqli_fetch_assoc($sqlReadUsers);

  // FACILITIES
  $queryReadFacilities = "SELECT facility_name FROM facilities";
  $sqlReadFacilities = mysqli_query($con, $queryReadFacilities);

  // RESERVATIONS
  $queryReadReservations = "SELECT * FROM reservations WHERE users_id = '$users_id'";
  $sqlReadReservations = mysqli_query($con, $queryReadReservations);

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RESERVATION</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <!-- <link rel="stylesheet" href="./styles/reservation.css" /> -->

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

  <!-- RESERVATION FORM -->
  <div class="container-fluid mt-5">
    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
      <form action="./php/reservation_create.php" method="post">
        <div class="row justify-content-center">

          <!-- CREATED DATE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdDate" class="form-label">Created Date:</label>
              <input type="text" id="createdDate" name="created_date" class="form-control" value="<?php echo $date ?>"
                aria-label="Disabled input example" disabled readonly />
            </div>
          </div>

          <!-- RSVN NO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="rsvn-no" class="form-label">RSVN No.</label>
              <input type="text" name="rsvn_no" id="rsvn-no" class="form-control" />
            </div>
          </div>

          <!-- CREATED BY -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdBy" class="form-label">Created By:</label>
              <input type="text" id="createdBy" name="created_by" class="form-control"
                value="<?php echo $rows['last_names'] . ', ' . $rows['first_names'] ?>" readonly />
            </div>
          </div>

          <!-- ROOM TYPE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="roomType" class="form-label">Room Type:</label>
              <select name="room_type" id="roomType" class="form-select">
                <option disabled selected value>-- Room Type --</option>
                <?php while($rowFacilities = mysqli_fetch_assoc($sqlReadFacilities)) { ?>
                <option value="<?php echo $rowFacilities['facility_name'] ?>">
                  <?php echo $rowFacilities['facility_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- DATE FROM-->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateFrom" class="form-label">Date From:</label>
              <input type="date" name="date_from" id="dateFrom" class="form-control" />
            </div>
          </div>

          <!-- DATE TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateTo" class="form-label">Date To:</label>
              <input type="date" name="date_to" id="dateTo" class="form-control" />
            </div>
          </div>

          <!-- TIME FROM -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeFrom" class="form-label">Time From:</label>
              <input type="time" name="time_from" id="timeFrom" class="form-control" />
            </div>
          </div>

          <!-- TIME TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeTo" class="form-label">Time To:</label>
              <input type="time" name="time_to" id="timeTo" class="form-control" />
            </div>
          </div>

          <!-- PENDING -->
          <div class="col-12">
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="pending_status" id="status" class="form-select">
                <option value="PENDING">PENDING</option>
              </select>
            </div>
          </div>

          <!-- SUBMIT BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="submit" id="submit" class="btn btn-success fw-bold float-end"
                value="RESERVE" />
            </div>
          </div>
      </form>
    </div>
  </div>

  <!-- RESERVATION LIST -->
  <div class="container-fluid">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Created Date:</th>
              <th scope="col">RSVN No.</th>
              <th scope="col">Created By:</th>
              <th scope="col">Room Type:</th>
              <th scope="col">Date From:</th>
              <th scope="col">Date To:</th>
              <th scope="col">Time From:</th>
              <th scope="col">Time To:</th>
              <th scope="col">Status:</th>
              <th col="2">Actions:</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php while($rowReservations = mysqli_fetch_assoc($sqlReadReservations) ) { ?>
            <tr>
              <td><?php echo $rowReservations['created_date'] ?></td>
              <td><?php echo $rowReservations['rsvn_no'] ?></td>
              <td><?php echo $rowReservations['created_by'] ?></td>
              <td><?php echo $rowReservations['room_type'] ?></td>
              <td><?php echo $rowReservations['date_from'] ?></td>
              <td><?php echo $rowReservations['date_to'] ?></td>
              <td><?php echo date("h:i:A", strtotime($rowReservations['time_from'])) ?></td>
              <td><?php echo date("h:i:A", strtotime($rowReservations['time_to']))  ?></td>
              <td><?php echo $rowReservations['statuses'] ?></td>
              <td>
                <form action="./php/reservation_update.php" method="post">
                  <input type="submit" name="edit" class="btn btn-success fw-bold" value="EDIT">
                  <input type="hidden" name="edit_id" value="<?php echo $rowReservations['id'] ?>">
                  <input type="hidden" name="edit_rsvn" value="<?php echo $rowReservations['rsvn_no'] ?>">
                  <input type="hidden" name="edit_room_type" value="<?php echo $rowReservations['room_type'] ?>">
                  <input type="hidden" name="edit_date_from" value="<?php echo $rowReservations['date_to'] ?>">
                  <input type="hidden" name="edit_date_to" value="<?php echo $rowReservations['date_to'] ?>">
                  <input type="hidden" name="edit_time_from" value="<?php echo $rowReservations['time_from'] ?>">
                  <input type="hidden" name="edit_time_to" value="<?php echo $rowReservations['time_to'] ?>">
                  <input type="hidden" name="edit_pending_status" value="<?php echo $rowReservations['statuses'] ?>">
                </form>
              </td>
              <td>
                <form action="./php/reservation_delete.php" method="post">
                  <input type="submit" name="delete" value="DELETE" class="btn btn-danger fw-bold">
                  <input type="hidden" name="delete_id" value="<?php echo $rowReservations['id'] ?>">
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>