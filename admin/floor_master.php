<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  require './php/session.php';

  // FLOOR DATABASE
  $queryFloor = "SELECT * FROM floors";
  $sqlFloor = mysqli_query($con, $queryFloor);
  
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
              <li><a class="dropdown-item" href="register.php">User</a></li>
              <li><a class="dropdown-item" href="company.php">Company</a></li>
              <li><a class="dropdown-item" href="floor_master.php">Floor Master</a></li>
              <li><a class="dropdown-item" href="facility_type.php">Facility Type</a></li>
              <li><a class="dropdown-item" href="facility_room_master.php">Facility Room Master</a></li>
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
              <th scope="col">Description:</th>
              <th col="2">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while($rows = mysqli_fetch_assoc($sqlFloor)) { ?>
            <tr>
              <td><?php echo $rows['floor_code'] ?></td>
              <td><?php echo $rows['floor_name'] ?></td>
              <td>
                <form action="./php/floormaster_update.php" method="post">
                  <input type="submit" name="edit" value="EDIT" class="btn btn-success fw-bold">
                  <input type="hidden" name="edit_id" value="<?php echo $rows['id'] ?>">
                  <input type="hidden" name="edit_floor_code" value="<?php echo $rows['floor_code'] ?>">
                  <input type="hidden" name="edit_floor_name" value="<?php echo $rows['floor_name'] ?>">
                </form>
              </td>
              <td>
                <form action="./php/floormaster_delete.php" method="post">
                  <input type="submit" name="delete" value="DELETE" class="btn btn-danger fw-bold">
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