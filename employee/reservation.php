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
  $queryReadReservations = "SELECT * FROM reservations WHERE users_id = '$users_id' AND statuses = 'PENDING'";
  $sqlReadReservations = mysqli_query($con, $queryReadReservations);

  if (isset($_POST['update_reservation'])) {
    $updateId = $_POST['update_id'];
    $updateRsvnNo = mysqli_real_escape_string($con, $_POST['update_rsvn_no']);
    $updateRoomType = mysqli_real_escape_string($con, $_POST['update_room_type']);
    $updateDateFrom = mysqli_real_escape_string($con, $_POST['update_date_from']);
    $updateDateTo = mysqli_real_escape_string($con, $_POST['update_date_to']);
    $updateTimeFrom = mysqli_real_escape_string($con, $_POST['update_time_from']);
    $updateTimeTo = mysqli_real_escape_string($con, $_POST['update_time_to']);
    $updateStatus = mysqli_real_escape_string($con, $_POST['update_status']);

    $queryUpdate = "UPDATE reservations SET rsvn_no = '$updateRsvnNo', room_type = '$updateRoomType', date_from = '$updateDateFrom', date_to = '$updateDateTo', time_from = '$updateTimeFrom', time_to = '$updateTimeTo', statuses = '$updateStatus' WHERE id = '$updateId'";
    $sqlUpdate = mysqli_query($con, $queryUpdate);

    path('reservation');
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RESERVATION</title>

  <!-- CSS -->
  <link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/reservation.css" />

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
    integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="./js/validation.js" defer></script>
  <script src="./js/date.js" defer></script>

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

  <!-- RESERVATION FORM -->
  <div class="container-fluid mt-5">
    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
      <!-- class="needs-validation" -->
      <form action="./php/reservation_create.php" method="post" novalidate>
        <div class="row justify-content-center">

          <!-- CREATED DATE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdDate" class="form-label">Created Date:</label>
              <input type="text" id="createdDate" name="created_date" class="form-control" value="<?php echo $date ?>"
                aria-label="Disabled input example" disabled readonly required />
            </div>
          </div>

          <!-- RSVN NO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="rsvn-no" class="form-label">RSVN No.</label>
              <input type="text" name="rsvn_no" id="rsvn-no" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the rsvn no.
              </div>
            </div>
          </div>

          <!-- CREATED BY -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdBy" class="form-label">Created By:</label>
              <input type="text" id="createdBy" name="created_by" class="form-control"
                value="<?php echo $rows['last_names'] . ', ' . $rows['first_names'] ?>" readonly required />
            </div>
          </div>

          <!-- ROOM TYPE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="roomType" class="form-label">Room Type:</label>
              <select name="room_type" id="roomType" class="form-select" required>
                <option disabled selected value>-- Room Type --</option>
                <?php while($rowFacilities = mysqli_fetch_assoc($sqlReadFacilities)) { ?>
                <option value="<?php echo $rowFacilities['facility_name'] ?>">
                  <?php echo $rowFacilities['facility_name'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Please choose in the room type.
              </div>
            </div>
          </div>

          <!-- DATE FROM-->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateFrom" class="form-label">Date From:</label>
              <input type="date" name="date_from" id="dateFrom" class="form-control" required />
              <div class="invalid-feedback">
                Please choose the date from.
              </div>
            </div>
          </div>

          <!-- DATE TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateTo" class="form-label">Date To:</label>
              <input type="date" name="date_to" id="dateTo" class="form-control" required />
              <div class="invalid-feedback">
                Please choose the date to.
              </div>
            </div>

          </div>

          <!-- TIME FROM -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeFrom" class="form-label">Time From:</label>
              <input type="time" name="time_from" id="timeFrom" class="form-control" required />
              <div class="invalid-feedback">
                Please choose the time from.
              </div>
            </div>
          </div>

          <!-- TIME TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeTo" class="form-label">Time To:</label>
              <input type="time" name="time_to" id="timeTo" class="form-control" required />
              <div class="invalid-feedback">
                Please choose the time to.
              </div>
            </div>
          </div>

          <!-- PENDING -->
          <div class="col-12">
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="pending_status" id="status" class="form-select" required>
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
              <td><?php echo date("h:i A", strtotime($rowReservations['time_from'])) ?></td>
              <td><?php echo date("h:i A", strtotime($rowReservations['time_to']))  ?></td>
              <td><?php echo $rowReservations['statuses'] ?></td>

              <!-- EDIT -->
              <td>
                <button class="btn btn-success fw-bold" data-bs-toggle="modal"
                  data-bs-target="#modalEdit-<?php echo $rowReservations['id'] ?>">EDIT</button>
                <form action="reservation.php" method="post">

                  <?php 
                    $query = "SELECT * FROM facilities";
                    $sql = mysqli_query($con, $query);
                  ?>

                  <div class="modal fade" id="modalEdit-<?php echo $rowReservations['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-title">
                          <p class="fs-3 my-3 text-center">Edit Reservations</p>
                        </div>
                        <div class="modal-body">
                          <input class="form-control" type="hidden" name="update_id"
                            value="<?php echo $rowReservations['id'] ?>">
                          <div class="row">
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateRsvn" class="form-label">Update RSVN No.</label>
                                <input class="form-control" type="text" name="update_rsvn_no" id="updateRsvn"
                                  value="<?php echo $rowReservations['rsvn_no'] ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateRoomType" class="form-label">Update Room Type:</label>
                                <select name="update_room_type" id="updateRoomType" class="form-select">
                                  <option disabled selected value>-- Room Type --</option>
                                  <?php while($row = mysqli_fetch_assoc($sql)) { ?>
                                  <option value="<?php echo $row['facility_name'] ?>">
                                    <?php echo $row['facility_name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateDateFrom" class="form-label">Update Date From:</label>
                                <input class="form-control" type="date" name="update_date_from" id="updateDateFrom"
                                  value="<?php echo $rowReservations['date_from'] ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateDateTo" class="form-label">Update Date To:</label>
                                <input class="form-control" type="date" name="update_date_to" id="updateDateTo"
                                  value="<?php echo $rowReservations['date_to'] ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateTimeFrom" class="form-label">Update Time From:</label>
                                <input class="form-control" type="time" name="update_time_from" id="updateTimeFrom"
                                  value="<?php echo $rowReservations['time_from'] ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateTimeTo" class="form-label">Update Time To:</label>
                                <input class="form-control" type="time" name="update_time_to" id="updateTimeTo"
                                  value="<?php echo $rowReservations['time_to'] ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="updateStatus" class="form-label">Status:</label>
                                <select class="form-control" type="text" name="update_status" id="updateStatus"
                                  value="<?php echo $rowReservations['statuses'] ?>">
                                  <option value="PENDING">PENDING</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success fw-bold" name="update_reservation">SUBMIT
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>

              <!-- DELETE -->
              <td>
                <button class="btn btn-danger fw-bold" data-bs-toggle="modal"
                  data-bs-target="#modalDelete-<?php echo $rowReservations['id'] ?>">DELETE</button>

                <form action="./php/reservation_delete.php" method="post" id="deleteForm">
                  <input type="hidden" name="delete_id" value="<?php echo $rowReservations['id'] ?>">
                  <div class="modal fade" tabindex="-1" id="modalDelete-<?php echo $rowReservations['id'] ?>">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-title text-center my-5">
                          <p class="fs-3">Are you sure you want to delete?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary" name="delete" id="deleteBtn">OK</button>
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
      </div>
    </div>
  </div>
</body>

</html>