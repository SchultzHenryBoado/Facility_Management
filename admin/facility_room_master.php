<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  require './php/session.php';

  // FACILITY ROOM MASTER DATABASE
  $queryFacilityRoomMaster = "SELECT * FROM facility_room_masters";
  $sqlFacilityRoomMaster = mysqli_query($con, $queryFacilityRoomMaster);

  // FACILITIES DATABASE
  $queryFacilities = "SELECT facility_name FROM facilities";
  $sqlFacilities = mysqli_query($con, $queryFacilities);

  // FLOORS DATABASE
  $queryFloors = "SELECT floor_name FROM floors";
  $sqlFloors = mysqli_query($con, $queryFloors);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FACILITY ROOM MASTER</title>

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

  <!-- FACILITY ROOM MASTER -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/master_facility_room_create.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Facility Room Master </p>

        <div class="row">

          <!-- FACILITY TYPE -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="facilityType" class="form-label">Facility Type:</label>
              <select name="facility_type" id="facilityType" class="form-select" required>
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
              <input type="text" name="facility_number" id="facilityNumber" class="form-control" required>
              <div class="invalid-feedback">
                Please choose in the facility Number.
              </div>
            </div>
          </div>
          <!-- DESCRIPTION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="description" class="form-label">Description:</label>
              <input type="text" name="description" id="description" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the description.
              </div>
            </div>
          </div>
          <!-- FLOOR LOCATION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="floorLocation" class="form-label">Floor Location:</label>
              <select name="floor_location" id="floorLocation" class="form-select" required>
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
              <input type="text" name="max_capacity" id="maxCapacity" class="form-control" required>
              <div class="invalid-feedback">
                Please fill-up the max capacity.
              </div>
            </div>
          </div>
          <!-- STATUS -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="status" class="form-label">Status:</label>
              <select name="status" id="status" class="form-select" required>
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
              <input type="submit" name="register_facility" value="OK" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- FACILITY ROOM MASTER LIST -->
  <div class="container-fluid">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">Facility Type:</th>
              <th scope="col">Facility Number:</th>
              <th scope="col">Description:</th>
              <th scope="col">Floor Location:</th>
              <th scope="col">Max Capacity:</th>
              <th scope="col">Status:</th>
              <th col="2">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while($rows = mysqli_fetch_assoc($sqlFacilityRoomMaster)) { ?>
            <tr>
              <td><?php echo $rows['facility_type'] ?></td>
              <td><?php echo $rows['facility_number'] ?></td>
              <td><?php echo $rows['descriptions'] ?></td>
              <td><?php echo $rows['floor_location'] ?></td>
              <td><?php echo $rows['max_capacity'] ?></td>
              <td><?php echo $rows['statuses'] ?></td>
              <td>
                <form action="./php/master_facility_room_update.php" method="post">
                  <input type="submit" name="edit" value="EDIT" class="btn btn-success fw-bold">
                  <input type="hidden" name="edit_id" value="<?php echo $rows['id'] ?>">
                  <input type="hidden" name="edit_facility_type" value="<?php echo $rows['facility_type'] ?>">
                  <input type="hidden" name="edit_facility_number" value="<?php echo $rows['facility_number'] ?>">
                  <input type="hidden" name="edit_description" value="<?php echo $rows['descriptions'] ?>">
                  <input type="hidden" name="edit_floor_location" value="<?php echo $rows['floor_location'] ?>">
                  <input type="hidden" name="edit_max_capacity" value="<?php echo $rows['max_capacity'] ?>">
                  <input type="hidden" name="edit_status" value="<?php echo $rows['statuses'] ?>">
                </form>
              </td>
              <td>
                <form action="./php/master_facility_room_delete.php" method="post">
                  <input type="submit" name="delete" class="btn btn-danger fw-bold" value="DELETE">
                  <input type="hidden" name="delete_id" value="<?php echo $rows['id'] ?>">
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