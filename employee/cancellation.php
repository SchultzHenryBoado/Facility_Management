<?php 
  // DATABASE 
  require_once $_SERVER['DOCUMENT_ROOT'] . './facility_management/database/connection.php';
  // SESSION
  require './php/session.php';

  $users_id = $_SESSION['users_id'];
  
  $sqlReservationCancel = "SELECT * FROM reservations WHERE users_id=? AND statuses='REJECT'";
  $stmtCancel = $con->prepare($sqlReservationCancel);
  $stmtCancel->execute([$users_id]);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CANCEL</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="./styles/cancel.css" />

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
      <p class="h1 text-center mb-3">Reservation Cancelled</p>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Room Type:</th>
            <th scope="col">Date:</th>
            <th scope="col">Time From:</th>
            <th scope="col">Time To:</th>
            <th scope="col">Status:</th>
            <th scope="col">Reasons:</th>
            <th scope="col">Actions:</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php while($rowReserveCancel = $stmtCancel->fetch()) { ?>
          <tr>
            <td><?php echo $rowReserveCancel->room_type ?></td>
            <td><?php echo $rowReserveCancel->date_from ?></td>
            <td><?php echo date("h:i A" , strtotime($rowReserveCancel->time_from))?></td>
            <td><?php echo date("h:i A", strtotime($rowReserveCancel->time_to)) ?></td>
            <td><?php echo $rowReserveCancel->statuses ?></td>
            <td><?php echo $rowReserveCancel->cancel_reasons ?></td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>

              <!-- Modal -->
              <div class="modal fade" id="editModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Update Reservation</h1>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="rsvn_no" class="form-label">RSVN No.</label>
                            <input type="text" name="update_rsvn_no" id="rsvn_no" class="form-control">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="createdBy" class="form-label">Created By</label>
                            <input type="text" name="update_created_by" id="createdBy" class="form-control">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="roomType" class="form-label">Room Type</label>
                            <select name="update_room_type" id="roomType" class="form-select"></select>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="dateFrom" class="form-label">Date from</label>
                            <input type="date" name="update_date_from" id="dateFrom" class="form-control">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="dateTo" class="form-label">Date To</label>
                            <input type="date" name="update_date_to" id="dateTo" class="form-control">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="timeFrom" class="form-label">Time From</label>
                            <input type="time" name="update_time_from" id="timeFrom" class="form-control">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="timeTo" class="form-label">Time To</label>
                            <input type="time" name="update_time_to" id="timeTo" class="form-control">
                          </div>
                        </div>
                        <div class="col-12">
                          <label for="status" class="form-label">Status</label>
                          <select name="update_status" id="status" class="form-select">
                            <option></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success">Edit</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>