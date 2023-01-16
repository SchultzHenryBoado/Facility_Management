<?php
// DATABASE
include_once '../database/connection.php';
// SESSION
include_once './php/session.php';

// RESERVATIONS
$sqlReadReservations = "SELECT * FROM reservations WHERE statuses = 'PENDING'";
$stmt = $con->prepare($sqlReadReservations);
$stmt->execute();

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
  <link rel="stylesheet" href="./styles/reserve.css" />


  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

  <!-- PENDING RESERVATION LIST -->
  <div class="container-fluid mt-5">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <p class="h1 text-center mb-5">Pending Reservation</p>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="bg-primary text-white">
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
              <th scope="col" col="2">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($rowReservations = $stmt->fetch()) { ?>
            <tr id="myTableRow">
              <td><?php echo $rowReservations->created_date ?></td>
              <td><?php echo $rowReservations->rsvn_no ?></td>
              <td><?php echo $rowReservations->created_by ?></td>
              <td><?php echo $rowReservations->room_type ?></td>
              <td><?php echo $rowReservations->date_from ?></td>
              <td><?php echo $rowReservations->date_to ?></td>
              <td><?php echo date("h:i A", strtotime($rowReservations->time_from)) ?></td>
              <td><?php echo date("h:i A", strtotime($rowReservations->time_to)) ?></td>
              <td><?php echo $rowReservations->statuses ?></td>

              <!-- ACCEPT -->
              <td>
                <form action="./php/reservation_accept.php" method="post">
                  <input type="hidden" name="accept_id" value="<?php echo $rowReservations->id ?>">
                  <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal"
                    data-bs-target="#acceptModal-<?php echo $rowReservations->id ?>"
                    value="<?php echo $rowReservations->id ?>">
                    <i class="fa-solid fa-thumbs-up"></i>
                  </button>

                  <div class="modal fade" id="acceptModal-<?php echo $rowReservations->id ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <p class="modal-title fs-3 fw-bold">Are you sure?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                          <input type="submit" class="btn btn-success" name="accept_reservation" value="Yes"
                            id="acceptBtn">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
              <!-- REJECT -->
              <td>
                <form action="./php/reservation_reject.php" method="post">
                  <input type="hidden" name="reject_id" id="" value="<?php echo $rowReservations->id ?>">
                  <button type="button" class="btn btn-danger fw-bold" data-bs-toggle="modal"
                    data-bs-target="#rejectModal-<?php echo $rowReservations->id ?>"
                    value="<?php echo $rowReservations->id ?>">
                    <i class="fa-solid fa-thumbs-down"></i>
                  </button>
                  <div class="modal fade" id="rejectModal-<?php echo $rowReservations->id ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <p class="modal-title fs-5 fw-bold">Reason for rejection</p>
                        </div>
                        <div class="modal-body">
                          <textarea name="reject_reasons" class="form-control w-100" placeholder="Write a reasons..."
                            style="height: 300px" required></textarea>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" name="reject_reservation" value="SUBMIT" class="btn btn-success">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
</body>

</html>