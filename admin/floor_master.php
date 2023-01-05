<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  require './php/session.php';

  // FLOOR DATABASE
  $sqlFloor = "SELECT * FROM floors ORDER BY floor_number ASC";
  $stmt = $con->prepare($sqlFloor);
  $stmt->execute();

  // UPDATE FLOOR
  if (isset($_POST['update_floor_master'])) {
    $updateId = $_POST['update_id'];
    $updateFloorCode = strtoupper(filter_input(INPUT_POST, 'update_floor_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $updateFloorName = filter_input(INPUT_POST, 'update_floor_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlUpdate = "UPDATE floors SET floor_code=? , floor_number=? WHERE id=? ";
    $stmtUpdateFloorCode = $con->prepare($sqlUpdate);
    $stmtUpdateFloorCode->execute([$updateFloorCode, $updateFloorName, $updateId]);

    pathTo('floor_master');
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FLOOR MASTER</title>

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

  <!-- FLOOR MASTER -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/floormaster_create.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Floor Master</p>

        <div class="row">

          <!-- CODE -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="code" class="form-label">Code:</label>
              <input type="text" name="floor_code" id="code" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the floor code.
              </div>
            </div>
          </div>
          <!-- DESCRIPTION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="floor" class="form-label">Floor Number:</label>
              <input type="text" name="floor_number" id="floor" class="form-control" required>
              <div class="invalid-feedback">
                Please fill-up the floor number.
              </div>
            </div>
          </div>
          <!-- BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="floor_master" value="OK" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- COMPANY LIST -->
  <div class="container-fluid">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">Code:</th>
              <th scope="col">Floor Number:</th>
              <th col="2">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while($rowFloors = $stmt->fetch()) { ?>
            <tr>
              <td><?php echo $rowFloors->floor_code ?></td>
              <td><?php echo $rowFloors->floor_number ?></td>
              <td>
                <!-- UPDATE -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                  data-bs-target="#updateModal-<?php echo $rowFloors->id ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <form action="floor_master.php" method="post" class="needs-validation" novalidate>
                  <!-- Modal -->
                  <div class="modal fade" id="updateModal-<?php echo $rowFloors->id ?>" tabindex="-1">
                    <input type="hidden" name="update_id" value="<?php echo $rowFloors->id ?>">

                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="updateModal">Update Floor Master</h1>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="floorCode" class="form-label">Floor Code</label>
                                <input type="text" name="update_floor_code" id="floorCode" class="form-control"
                                  value="<?php echo $rowFloors->floor_code ?>" required>
                                <div class="invalid-feedback">
                                  Please fill-up the floor code.
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="floorNumber" class="form-label">Floor Number</label>
                                <input type="text" name="update_floor_number" id="floorNumber" class="form-control"
                                  value="<?php echo $rowFloors->floor_number ?>" required>
                                <div class="invalid-feedback">
                                  Please fill-up the floor number.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="update_floor_master" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
              <td>
                <!-- DELETE -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                  data-bs-target="#deleteModal-<?php echo $rowFloors->id ?>">
                  <i class="fa-solid fa-trash"></i>
                </button>

                <form action="./php/floormaster_delete.php" method="post">
                  <!-- Modal -->
                  <div class="modal fade" id="deleteModal-<?php echo $rowFloors->id ?>" tabindex="-1">
                    <input type="hidden" name="delete_id" value="<?php echo $rowFloors->id ?>">

                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="deleteModal">Are you sure you want to Delete?</h1>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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