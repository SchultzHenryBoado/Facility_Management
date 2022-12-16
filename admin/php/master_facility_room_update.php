<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  // FACILITIES DATABASE
  $queryFacilities = "SELECT facility_name FROM facilities";
  $sqlFacilities = mysqli_query($con, $queryFacilities);

  // FLOORS DATABASE
  $queryFloors = "SELECT floor_name FROM floors";
  $sqlFloors = mysqli_query($con, $queryFloors);

  // EDIT FACILITY ROOM MASTER
  if (isset($_POST['edit'])) {
    $editId = $_POST['edit_id'];
    $editFacilityType = mysqli_real_escape_string($con, $_POST['edit_facility_type']);
    $editFacilityNumber = mysqli_real_escape_string($con, $_POST['edit_facility_number']);
    $editDescription = mysqli_real_escape_string($con, $_POST['edit_description']);
    $editFloorLocation = mysqli_real_escape_string($con, $_POST['edit_floor_location']);
    $editMaxCapacity = mysqli_real_escape_string($con, $_POST['edit_max_capacity']);
    $editStatus = mysqli_real_escape_string($con, $_POST['edit_status']);
  }

  // UPDATE FACILITY ROOM MASTER
  if (isset($_POST['update_facility'])) {
    $updateId = $_POST['update_id'];
    $updateFacilityType = mysqli_real_escape_string($con, $_POST['update_facility_type']);
    $updateFacilityNumber = mysqli_real_escape_string($con, $_POST['update_facility_number']);
    $updateDescription = mysqli_real_escape_string($con, $_POST['update_description']);
    $updateFloorLocation = mysqli_real_escape_string($con, $_POST['update_floor_location']);
    $updateMaxCapacity = mysqli_real_escape_string($con, $_POST['update_max_capacity']);
    $updateStatus = mysqli_real_escape_string($con, $_POST['update_status']);

    $queryUpdateFacilityRoomMaster = "UPDATE facility_room_masters SET facility_type ='$updateFacilityType', facility_number ='$updateFacilityNumber', descriptions ='$updateDescription', floor_location ='$updateFloorLocation', max_capacity ='$updateMaxCapacity', statuses = '$updateStatus' WHERE id = '$updateId' ";
    $sqlUpdateFacilityRoomMaster = mysqli_query($con, $queryUpdateFacilityRoomMaster);

    pathTo('facility_room_master');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE FACILITY ROOM MASTER</title>

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
            <a href="../dashboard_admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Inquire</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Cancellation</a>
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

          <li class="nav-item text-center">
            <form action="./logout.php" method="post">
              <input type="submit" value="Logout" class="btn btn-primary" />
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- FACILITY ROOM MASTER -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./master_facility_room_update.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Update Facility Room Master </p>

        <div class="row">
          <input type="hidden" name="update_id" value="<?php echo $editId ?>">
          <!-- FACILITY TYPE -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="facilityType" class="form-label">Facility Type:</label>
              <select name="update_facility_type" id="facilityType" class="form-select"
                value="<?php echo $editFacilityType ?>" required>
                <option disabled selected value>-- Facility Type --</option>
                <?php while($rowFacilities = mysqli_fetch_assoc($sqlFacilities)) { ?>
                <option value="<?php echo $rowFacilities['facility_name'] ?>">
                  <?php echo $rowFacilities['facility_name']?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Please choose in the facility type.
              </div>
            </div>
          </div>
          <!-- FACILITY NUMBER -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="facilityNumber" class="form-label">Facility Number:</label>
              <input type="text" name="update_facility_number" id="facilityNumber" class="form-control"
                value="<?php echo $editFacilityNumber ?>" required>
              <div class="invalid-feedback">
                Please choose in the facility Number.
              </div>
            </div>
          </div>
          <!-- DESCRIPTION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="description" class="form-label">Description:</label>
              <input type="text" name="update_description" id="description" class="form-control"
                value="<?php echo $editDescription ?>" required />
              <div class="invalid-feedback">
                Please fill-up the description.
              </div>
            </div>
          </div>
          <!-- FLOOR LOCATION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="floorLocation" class="form-label">Floor Location:</label>
              <select name="update_floor_location" id="floorLocation" class="form-select"
                value="<?php echo $editFloorLocation ?>" required>
                <option disabled selected value>-- Floor Location --</option>
                <?php while($rowFloorLocation =mysqli_fetch_assoc($sqlFloors)) { ?>
                <option value="<?php echo $rowFloorLocation['floor_name'] ?>">
                  <?php echo $rowFloorLocation['floor_name'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Please choose in the floor location.
              </div>
            </div>
          </div>
          <!-- MAX CAPACITY -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="maxCapacity" class="form-label">Max Capacity:</label>
              <input type="text" name="update_max_capacity" id="maxCapacity" class="form-control"
                value="<?php echo $editMaxCapacity ?>" required>
              <div class="invalid-feedback">
                Please fill-up the max capacity.
              </div>
            </div>
          </div>
          <!-- STATUS -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="status" class="form-label">Status:</label>
              <select name="update_status" id="status" class="form-select" value="<?php echo $editStatus ?>" required>
                <option disabled selected value>-- Status --</option>
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
              </select>
              <div class="invalid-feedback">
                Please choose in the floor location.
              </div>
            </div>
          </div>
          <!-- BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="update_facility" value="UPDATE" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>