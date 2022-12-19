<?php 
  // DATABASE
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  // SESSION
  require './php/session.php';

  // RESERVATIONS
  $queryReadReservations = "SELECT * FROM reservations WHERE statuses = 'REJECT'";
  $sqlReadReservations = mysqli_query($con, $queryReadReservations);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CANCELLATION</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="./styles/cancellation.css" />

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
                <a class="dropdown-item" href="#">Change Password</a>
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

  <!-- CANCELLATION -->
  <div class="container-fluid mt-5">

    <div class="modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <p class="h1 text-center mb-5">Cancel Reservation</p>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">RSVN No.</th>
              <th scope="col">Room Type:</th>
              <th scope="col">Date From:</th>
              <th scope="col">Time From:</th>
              <th scope="col">Time To:</th>
              <th scope="col">Reserved By:</th>
              <th scope="col">Status:</th>
              <th scope="col">Reasons:</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php while($rowReservations = mysqli_fetch_assoc($sqlReadReservations)) { ?>
            <tr>
              <td><?php echo $rowReservations['rsvn_no'] ?></td>
              <td><?php echo $rowReservations['room_type'] ?></td>
              <td><?php echo $rowReservations['date_from'] ?></td>
              <td><?php echo $rowReservations['time_from'] ?></td>
              <td><?php echo $rowReservations['time_to'] ?></td>
              <td><?php echo $rowReservations['created_by'] ?></td>
              <td><?php echo $rowReservations['statuses'] ?></td>
              <td>
                <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#modalReasons">Write a
                  Reasons</button>
                <!-- Modal -->
                <div class="modal fade" id="modalReasons" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5"">Write a Reasons</h1>
                        <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="./php/reasons_create.php" method="post">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <textarea name="reasons" placeholder="Write a Reasons..." class="w-100 p-3"
                                style="height: 200px;"></textarea>
                              <input type="text" name="reasons_id" value="<?php echo $rowReservations['id'] ?>">
                              <input type="text" name="" id="" value="<?php echo $rowReservations['users_id'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" name="submit_reasons" value="SUBMIT" class="btn btn-success fw-bold">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
              <td></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
</body>

</html>