<?php
// DATABASE 
require_once '../database/connection.php';
// SESSION
require './php/session.php';

function pathTo($destination)
{
  echo "<script>window.location.href = './$destination.php'</script>";
}

$users_id = $_SESSION['users_approval_id'];

$sqlReservationCancel = "SELECT * FROM reservations WHERE users_id=? AND statuses='REJECT'";
$stmtCancel = $con->prepare($sqlReservationCancel);
$stmtCancel->execute([$users_id]);

// RESERVATIONS
$sqlReadReservations = "SELECT * FROM reservations";
$stmtReservations = $con->prepare($sqlReadReservations);
$stmtReservations->execute();

if (isset($_POST['update'])) {
  $updateId = $_POST['update_id'];
  $updateRsvnNo = filter_input(INPUT_POST, 'update_rsvn_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $updateRoomType = filter_input(INPUT_POST, 'update_room_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $updateDateFrom = filter_input(INPUT_POST, 'update_date_from', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $updateDateTo = filter_input(INPUT_POST, 'update_date_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $updateTimeFrom = filter_input(INPUT_POST, 'update_time_from', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $updateTimeTo = filter_input(INPUT_POST, 'update_time_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $updateStatus = filter_input(INPUT_POST, 'update_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $sqlUpdate = "UPDATE reservations SET rsvn_no=?, room_type=?, date_from=?, date_to=?, time_from=?, time_to=?, statuses=? WHERE id=?";
  $stmtUpdate = $con->prepare($sqlUpdate);
  $stmtUpdate->execute([$updateRsvnNo, $updateRoomType, $updateDateFrom, $updateDateTo, $updateTimeFrom, $updateTimeTo, $updateStatus, $updateId]);

  pathTo('reservation');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CANCEL</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./styles/cancel.css" />

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
  <script src="./js/dataTable.js" defer></script>
  <script src="./js/date.js" defer></script>
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
      <p class="h1 text-center mb-3">Reservation Cancelled</p>
      <table class="table table-striped table-hover" id="myTable">
        <thead>
          <tr>
            <th>Room Type:</th>
            <th>Date:</th>
            <th>Time From:</th>
            <th>Time To:</th>
            <th>Status:</th>
            <th>Actions:</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($rowReserveCancel = $stmtCancel->fetch()) { ?>
            <tr>
              <td><?php echo $rowReserveCancel->room_type ?></td>
              <td><?php echo $rowReserveCancel->date_from ?></td>
              <td><?php echo date("h:i A", strtotime($rowReserveCancel->time_from)) ?></td>
              <td><?php echo date("h:i A", strtotime($rowReserveCancel->time_to)) ?></td>
              <td><?php echo $rowReserveCancel->statuses ?></td>
              <td>
                <div class="d-inline-block">
                  <button type="button" class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#reasonModal-<?php echo $rowReserveCancel->id ?>">
                    <i class="fa-solid fa-eye"></i>
                  </button>

                  <div class="modal fade" id="reasonModal-<?php echo $rowReserveCancel->id ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <p class="fs-5 fw-bold m-0">Reason for rejection</p>
                        </div>
                        <div class="modal-body">
                          <p class="fs-5 text-break"><?php echo $rowReserveCancel->cancel_reasons ?></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="d-inline-block">
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $rowReserveCancel->id ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>

                  <form action="./cancellation.php" method="post" class="needs-validation" novalidate>
                    <?php
                    $sqlRoom = "SELECT * FROM facilities";
                    $stmtRoom = $con->prepare($sqlRoom);
                    $stmtRoom->execute();
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="editModal-<?php echo $rowReserveCancel->id ?>" tabindex="-1">
                      <input type="hidden" name="update_id" value="<?php echo $rowReserveCancel->id ?>">
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
                                  <input type="text" name="update_rsvn_no" id="rsvn_no" class="form-control" value="<?php echo $rowReserveCancel->rsvn_no ?>" required>
                                  <div class="invalid-feedback">
                                    Please input an rsvn no.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3">
                                  <label for="roomType" class="form-label">Room Type</label>
                                  <select name="update_room_type" id="roomType" class="form-select" required>
                                    <option disabled selected value>--Choose a room type</option>
                                    <?php while ($rowRoomType = $stmtRoom->fetch()) { ?>
                                      <option value="<?php echo $rowRoomType->facility_name ?>">
                                        <?php echo $rowRoomType->facility_name ?></option>
                                    <?php } ?>
                                  </select>
                                  <div class="invalid-feedback">
                                    Please choose in room type.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3">
                                  <label for="updateDateFrom" class="form-label">Date from</label>
                                  <input type="date" name="update_date_from" id="updateDateFrom" class="form-control" value="<?php echo $rowReserveCancel->date_from ?>" required>
                                  <div class="invalid-feedback">
                                    Please input a date from.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3">
                                  <label for="updateDateTo" class="form-label">Date To</label>
                                  <input type="date" name="update_date_to" id="updateDateTo" class="form-control" value="<?php echo $rowReserveCancel->date_to ?>" required>
                                  <div class="invalid-feedback">
                                    Please input a date to.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3">
                                  <label for="updateTimeFrom" class="form-label">Time From</label>
                                  <input type="time" name="update_time_from" id="updateTimeFrom" class="form-control" value="<?php echo $rowReserveCancel->time_from ?>" required>
                                  <div class="invalid-feedback">
                                    Please input a time from.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3">
                                  <label for="updateTimeTo" class="form-label">Time To</label>
                                  <input type="time" name="update_time_to" id="updateTimeTo" class="form-control" value="<?php echo $rowReserveCancel->time_to ?>" required>
                                  <div class="invalid-feedback">
                                    Please input a time to.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" name="update_status" class="form-control" id="status" value="PENDING" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success fw-bold" name="update">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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