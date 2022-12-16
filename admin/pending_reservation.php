<?php 
  // DATABASE
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  // SESSION
  require './php/session.php';

  // RESERVATIONS
  $queryReadReservations = "SELECT * FROM reservations";
  $sqlReadReservations = mysqli_query($con, $queryReadReservations);
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PENDING RESERVATION</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/company.css" />


  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="./js/validation.js" defer></script>
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
            <a href="#" class="nav-link text-light">Cancellation</a>
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

          <li class="nav-item text-center">
            <form action="./php/logout.php" method="post">
              <input type="submit" value="Logout" class="btn btn-primary" />
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- PENDING RESERVATION LIST -->
  <div class="container-fluid mt-5">
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
            <?php while($rowReservations = mysqli_fetch_assoc($sqlReadReservations)) { ?>
            <tr>
              <td><?php echo $rowReservations['created_date'] ?></td>
              <td><?php echo $rowReservations['rsvn_no'] ?></td>
              <td><?php echo $rowReservations['created_by'] ?></td>
              <td><?php echo $rowReservations['room_type'] ?></td>
              <td><?php echo $rowReservations['date_from'] ?></td>
              <td><?php echo $rowReservations['date_to'] ?></td>
              <td><?php echo $rowReservations['time_from'] ?></td>
              <td><?php echo $rowReservations['time_to'] ?></td>
              <td><?php echo $rowReservations['statuses'] ?></td>
              <td>
                <form action="./php/reservation_accept.php" method="post">
                  <input type="submit" name="accept_reservation" value="ACCEPT" class="btn btn-success fw-bold">
                  <input type="hidden" name="accept_id" value="<?php echo $rowReservations['id'] ?>">
                </form>
              </td>
              <td>
                <form action="./php/reservation_reject.php" method="post">
                  <input type="submit" name="reject_reservation" value="REJECT" class="btn btn-danger fw-bold">
                  <input type="hidden" name="reject_id" value="<?php echo $rowReservations['id'] ?>">
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
</body>

</html>