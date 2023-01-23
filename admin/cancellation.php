  <?php
  // DATABASE
  include_once '../database/connection.php';
  // SESSION
  include_once './php/session.php';

  // RESERVATIONS
  $sqlReadReservations = "SELECT * FROM reservations WHERE statuses = 'REJECT'";
  $stmt = $con->prepare($sqlReadReservations);
  $stmt->execute();

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CANCELLATION</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./styles/cancellation.css" />

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
              <a href="approved.php" class="nav-link text-light">Approved</a>
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

    <!-- TABLE FOR CANCELLATION -->
    <div class="container-fluid mt-5">
      <div class="container shadow p-3 mb-5 bg-body-rounded">
        <div class="table-responsive">
          <table class="table table-striped table-hover" style="width: 100%" id="myTable">
            <thead>
              <tr>
                <th>RSVN No.</th>
                <th>Room Type:</th>
                <th>Date From:</th>
                <th>Time From:</th>
                <th>Time To:</th>
                <th>Reserved By:</th>
                <th>Status:</th>
                <th>Reasons:</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($rowReservations = $stmt->fetch()) { ?>
                <tr>
                  <td><?php echo $rowReservations->rsvn_no ?></td>
                  <td><?php echo $rowReservations->room_type ?></td>
                  <td><?php echo $rowReservations->date_from ?></td>
                  <td><?php echo date("h:i A", strtotime($rowReservations->time_from)) ?></td>
                  <td><?php echo date("h:i A", strtotime($rowReservations->time_to)) ?></td>
                  <td><?php echo $rowReservations->created_by ?></td>
                  <td><?php echo $rowReservations->statuses ?></td>
                  <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal-<?php echo $rowReservations->id ?>">
                      <i class="fa-solid fa-eye"></i>
                    </button>

                    <div class="modal fade" id="rejectModal-<?php echo $rowReservations->id ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <p class="modal-title fs-5 fw-bold">Reasons for Rejection</p>
                          </div>
                          <div class="modal-body">
                            <p class="fs-5"><?php echo $rowReservations->cancel_reasons ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
  </body>

  </html>