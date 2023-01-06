<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  include './php/session.php';

  // FACILITY ROOM MASTER DATABASE
  $sqlFacilityRoomMaster = "SELECT * FROM facility_room_masters";
  $stmtFacilityRoomMaster = $con->prepare($sqlFacilityRoomMaster);
  $stmtFacilityRoomMaster->execute(); 

  // FACILITIES DATABASE
  $sqlFacilities = "SELECT facility_name FROM facilities";
  $stmtFacilities = $con->prepare($sqlFacilities);
  $stmtFacilities->execute();

  // FLOORS DATABASE
  $sqlFloors = "SELECT floor_number FROM floors";
  $stmtFloors = $con->prepare($sqlFloors);
  $stmtFloors->execute();

  // UPDATE FACILITY ROOM MASTER
  if (isset($_POST['update_facility'])) {
    $updateId = $_POST['update_id'];
    $updateFacilityType = filter_input(INPUT_POST, 'update_facility_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateFacilityNumber = filter_input(INPUT_POST, 'update_facility_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateDescription = filter_input(INPUT_POST, 'update_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateFloorLocation = filter_input(INPUT_POST, 'update_floor_location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateMaxCapacity = filter_input(INPUT_POST, 'update_max_capacity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateStatus = filter_input(INPUT_POST, 'update_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlUpdate = "UPDATE facility_room_masters SET facility_type=?, facility_number=?, descriptions=?, floor_location=?, max_capacity=?, statuses=? WHERE id=?";
    $stmtUpdate = $con->prepare($sqlUpdate);
    $stmtUpdate->execute([$updateFacilityType, $updateFacilityNumber, $updateDescription, $updateFloorLocation, $updateMaxCapacity, $updateStatus, $updateId]);

    pathTo('facility_room_master');
  }


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
                <?php while($rowFacilities = $stmtFacilities->fetch()) { ?>
                <option value="<?php echo $rowFacilities->facility_name ?>">
                  <?php echo $rowFacilities->facility_name ?></option>
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
                <?php while($rowFloorLocation = $stmtFloors->fetch()) { ?>
                <option value="<?php echo $rowFloorLocation->floor_number ?>">
                  <?php echo $rowFloorLocation->floor_number ?></option>
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
              <th scope="col" col="2">Actions:</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php while($rowFacilityRoomMaster = $stmtFacilityRoomMaster->fetch()) { ?>
            <tr>
              <td><?php echo $rowFacilityRoomMaster->facility_type ?></td>
              <td><?php echo $rowFacilityRoomMaster->facility_number ?></td>
              <td><?php echo $rowFacilityRoomMaster->descriptions ?></td>
              <td><?php echo $rowFacilityRoomMaster->floor_location ?></td>
              <td><?php echo $rowFacilityRoomMaster->max_capacity ?></td>
              <td><?php echo $rowFacilityRoomMaster->statuses ?></td>
              <td>
                <!-- UPDATE -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                  data-bs-target="#updateModal-<?php echo $rowFacilityRoomMaster->id ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <form action="facility_room_master.php" method="post" class="needs-validation" novalidate>
                  <input type="hidden" name="update_id" value="<?php echo $rowFacilityRoomMaster->id ?>">
                  <?php 
                    // FACILITIES DATABASE
                    $sqlFacilities = "SELECT facility_name FROM facilities";
                    $stmtFacilities = $con->prepare($sqlFacilities);
                    $stmtFacilities->execute();

                    // FLOORS DATABASE
                    $sqlFloors = "SELECT floor_number FROM floors";
                    $stmtFloors = $con->prepare($sqlFloors);
                    $stmtFloors->execute();
                    ?>
                  <!-- Modal -->
                  <div class="modal fade" id="updateModal-<?php echo $rowFacilityRoomMaster->id ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5">Update Facility Room Master</h1>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="facilityType" class="form-label">Facility Type</label>
                                <select name="update_facility_type" id="facilityType" class="form-select" required>
                                  <option disabled selected value>-- Facility Type --</option>
                                  <?php while($rowFacilities = $stmtFacilities->fetch()) { ?>
                                  <option value="<?php echo $rowFacilities->facility_name ?>">
                                    <?php echo $rowFacilities->facility_name ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="facilityNumber" class="form-label">Facility Number</label>
                                <input type="text" name="update_facility_number" id="facilityNumber"
                                  class="form-control" value="<?php echo $rowFacilityRoomMaster->facility_number ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="update_description" id="description" class="form-control"
                                  value="<?php echo $rowFacilityRoomMaster->descriptions ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="floorLocation" class="form-label">Floor Location</label>
                                <select name="update_floor_location" id="floorLocation" class="form-select" required>
                                  <option disabled selected value>-- Floor Location --</option>
                                  <?php while($rowFloorLocation = $stmtFloors->fetch()) { ?>
                                  <option value="<?php echo $rowFloorLocation->floor_number ?>">
                                    <?php echo $rowFloorLocation->floor_number ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="maxCapacity" class="form-label">Max Capacity</label>
                                <input type="text" name="update_max_capacity" id="maxCapacity" class="form-control"
                                  value="<?php echo $rowFacilityRoomMaster->max_capacity ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="update_status" id="status" class="form-select" required>
                                  <option disabled selected value>-- Status --</option>
                                  <option value="ACTIVE">ACTIVE</option>
                                  <option value="INACTIVE">INACTIVE</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="update_facility" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
              <td>
                <!-- DELETE -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                  data-bs-target="#deleteModal-<?php echo $rowFacilityRoomMaster->id ?>">
                  <i class="fa-solid fa-trash"></i>
                </button>

                <form action="./php/master_facility_room_delete.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $rowFacilityRoomMaster->id ?>">
                  <!-- Modal -->
                  <div class="modal fade" id="deleteModal-<?php echo $rowFacilityRoomMaster->id ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to Delete?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger" name="delete">Delete</button>
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