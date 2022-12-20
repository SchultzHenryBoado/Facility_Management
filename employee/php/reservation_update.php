<?php 
  // DATABASE 
  require_once $_SERVER['DOCUMENT_ROOT'] . './facility_management/database/connection.php';
  // SESSION
  require './session.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/employee/$destination.php'</script>";
  }
  
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

  // EDIT RESERVATIONS
  if (isset($_POST['edit'])) {
    $editId = $_POST['edit_id'];
    $editRsvn = mysqli_real_escape_string($con, $_POST['edit_rsvn']);
    $editRoomType = mysqli_real_escape_string($con, $_POST['edit_room_type']);
    $editDateFrom = mysqli_real_escape_string($con, $_POST['edit_date_from']);
    $editDateTo = mysqli_real_escape_string($con, $_POST['edit_date_to']);
    $editTimeFrom = mysqli_real_escape_string($con, $_POST['edit_time_from']);
    $editTimeTo = mysqli_real_escape_string($con, $_POST['edit_time_to']);
    $editPendingStatus = mysqli_real_escape_string($con, $_POST['pending_status']);
  }

  // UPDATE RESERVATIONS
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

    pathTo('reservation');
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
            <a href="../dashboard.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="../reservation.php" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Inquire</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Cancellation</a>
          </li>
          <li class="nav-item text-center">
            <form action="./logout.php" method="post">
              <input type="submit" value="Logout" class="btn btn-primary" />
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- RESERVATION FORM -->
  <div class="container-fluid mt-5">
    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
      <form action="./reservation_update.php" method="post">
        <div class="row justify-content-center">
          <p class="h1 mb-4 ">Update Reservation</p>
          <!-- ID -->
          <input type="hidden" name="update_id" value="<?php echo $editId ?>">
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
              <input type="text" name="update_rsvn_no" id="rsvn-no" class="form-control"
                value="<?php echo $editRsvn ?>" />
            </div>
          </div>

          <!-- CREATED BY -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdBy" class="form-label">Created By:</label>
              <input type="text" id="createdBy" name="update_created_by" class="form-control"
                value="<?php echo $rows['last_names'] . ', ' . $rows['first_names'] ?>" readonly />
            </div>
          </div>

          <!-- ROOM TYPE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="roomType" class="form-label">Room Type:</label>
              <select name="update_room_type" id="roomType" class="form-select" value="<?php echo $editRoomType ?>">
                <option disabled selected value>-- Room Type --</option>
                <?php while($rowFacilities = mysqli_fetch_assoc($sqlReadFacilities)) { ?>
                <option value=" <?php echo $rowFacilities['facility_name'] ?>">
                  <?php echo $rowFacilities['facility_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- DATE FROM-->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateFrom" class="form-label">Date From:</label>
              <input type="date" name="update_date_from" id="dateFrom" class="form-control"
                value="<?php echo $editDateFrom ?>" />
            </div>
          </div>

          <!-- DATE TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateTo" class="form-label">Date To:</label>
              <input type="date" name="update_date_to" id="dateTo" class="form-control"
                value="<?php echo $editDateTo ?>" />
            </div>
          </div>

          <!-- TIME FROM -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeFrom" class="form-label">Time From:</label>
              <input type="time" name="update_time_from" id="timeFrom" class="form-control"
                value="<?php echo $editTimeFrom ?>" />
            </div>
          </div>

          <!-- TIME TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeTo" class="form-label">Time To:</label>
              <input type="time" name="update_time_to" id="timeTo" class="form-control"
                value="<?php echo $editTimeTo ?>" />
            </div>
          </div>

          <!-- PENDING -->
          <div class="col-12">
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="update_status" id="status" class="form-select" value="<?php echo $editPendingStatus  ?>">
                <option value="PENDING">PENDING</option>
              </select>
            </div>
          </div>

          <!-- SUBMIT BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="update_reservation" id="submit" class="btn btn-success fw-bold float-end"
                value="UPDATE" />
            </div>
          </div>
      </form>
    </div>
  </div>
</body>

</html>