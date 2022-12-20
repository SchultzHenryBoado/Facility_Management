<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

   // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  // EDIT FLOOR
  if (isset($_POST['edit'])) {
    $editId = $_POST['edit_id'];
    $editFloorCode = mysqli_real_escape_string($con, $_POST['edit_floor_code']);
    $editFloorName = mysqli_real_escape_string($con, $_POST['edit_floor_name']);
  }

  // UPDATE FLOOR
  if (isset($_POST['update_floormaster'])) {
    $updateId = $_POST['update_id'];
    $updateFloorCode = mysqli_real_escape_string($con, $_POST['update_floor_code']);
    $updateFloorCodeUpper = strtoupper($updateFloorCode);
    $updateFloorName = mysqli_real_escape_string($con, $_POST['update_floor_name']);

    $queryUpdate = "UPDATE floors SET floor_code = '$updateFloorCodeUpper', floor_name = '$updateFloorName' WHERE id = '$updateId' ";
    $sqlUpdate = mysqli_query($con, $queryUpdate);

    pathTo('floor_master');
  }

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE FLOOR MASTER</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/company.css" />


  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="../js/validation.js" defer></script>
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
            <a href="../dashboard_admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="../pending_reservation.php" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="../cancellation.php" class="nav-link text-light">Cancellation</a>
          </li>
          <li class="nav-item dropdown text-center">
            <a class="nav-link dropdown-toggle text-center text-light" href="#" data-bs-toggle="dropdown">
              Masterfile
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../register.php">User</a></li>
              <li><a class="dropdown-item" href="../company.php">Company</a></li>
              <li><a class="dropdown-item" href="../floor_master.php">Floor Master</a></li>
              <li><a class="dropdown-item" href="../facility_type.php">Facility Type</a></li>
              <li><a class="dropdown-item" href="../facility_room_master.php">Facility Room Master</a></li>
            </ul>
          </li>
          <!-- USERS MENU -->
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <i class="fa-sharp fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li class="nav-item text-center">
                <a class="dropdown-item" href="../change_password.php">Change Password</a>
              </li>
              <li class="nav-item text-center">
                <a class="dropdown-item" href="../php/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <!-- FLOOR MASTER -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./floormaster_update.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Update Floor Master</p>

        <div class="row">
          <!-- ID -->
          <input type="hidden" name="update_id" value="<?php echo $editId ?>">
          <!-- CODE -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="code" class="form-label">Code:</label>
              <input type="text" name="update_floor_code" id="code" class="form-control"
                value="<?php echo $editFloorCode ?>" required />
              <div class="invalid-feedback">
                Please fill-up the floor code.
              </div>
            </div>
          </div>
          <!-- DESCRIPTION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="floor" class="form-label">Floor Number:</label>
              <input type="text" name="update_floor_name" id="floor" class="form-control"
                value="<?php echo $editFloorName ?>" required>
              <div class="invalid-feedback">
                Please fill-up the floor number.
              </div>
            </div>
          </div>
          <!-- BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="update_floormaster" value="UPDATE" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>