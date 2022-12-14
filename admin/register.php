<?php 
    // DATABASE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
    require './php/session.php';
    
    $queryUsers = "SELECT * FROM users_accounts";
    $sqlUsers = mysqli_query($con, $queryUsers);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>REGISTER A USER</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="./styles/register.css" />

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <!-- <script src="./js/forms.js" defer></script> -->
  <!-- <script src="./js/validation.js" defer></script> -->
  <script src="./js/modal.js" defer></script>

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
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="dashboard-admin.php">Facility Management
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
              <li><a class="dropdown-item" href="#">Floor Master</a></li>
              <li><a class="dropdown-item" href="#">Facility Type</a></li>
              <li><a class="dropdown-item" href="#">Facility Room</a></li>
            </ul>
          </li>

          <li class="nav-item text-center">
            <form action="./php/logout.php" method="post">
              <input type="submit" value="Logout" class="btn btn-primary" />
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form for registering the users -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/create_users.php" method="post" class="needs-validation">
        <p class="h1 mb-3">Register a Users</p>

        <div class="row">

          <!-- LAST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3" id="lastNameGroup" class="form-group">
              <label for="lastName" class="form-label">Last name:</label>
              <input type="text" name="last_name" id="lastName" class="form-control" />
              <!-- <div class="invalid-feedback">
                Please fill-up the Lastname
              </div> -->
            </div>
          </div>
          <!-- FIRST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3" id="firstNameGroup" class="form-group">
              <label for="firstName" class="form-label">First name:</label>
              <input type="text" name="first_name" id="firstName" class="form-control" />
              <!-- <div class="invalid-feedback">
                Please fill-up the Firstname
              </div> -->
            </div>
          </div>
          <!-- USERNAME -->
          <div class="col-12">
            <div class="mb-3" id="lastNameGroup" class="form-group">
              <label for="userName" class="form-label">Username:</label>
              <input type="text" name="username" id="userName" class="form-control" />
              <!-- <div class="invalid-feedback">
                Please fill-up the Lastname
              </div> -->
            </div>
          </div>
          <!-- EMAIL -->
          <div class="col-12">
            <div class="mb-3" id="emailGroup" class="form-group">
              <label for="email" class="form-label">Company Email:</label>
              <input type="email" name="email" id="email" class="form-control" />
              <!-- <div class="invalid-feedback">
                Please fill-up the Email
              </div> -->
            </div>
          </div>
          <!-- PASSWORD -->
          <div class="col-12">
            <div class="mb-3" id="passwordGroup" class="form-group">
              <label for="password" class="form-label">Password:</label>
              <input type="password" name="password" id="password" class="form-control" />
              <!-- <div class="invalid-feedback">
                Please fill-up the Password
              </div> -->
            </div>
          </div>
          <!-- STATUS -->
          <div class="col-12">
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="status" id="status" class="form-select">
                <option disabled selected value>-- Select Status --</option>
                <option value="">ACTIVE</option>
                <option value="">INACTIVE</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="register" value="REGISTER" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- USERS LIST -->
  <div class="container-fluid">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">Lastname:</th>
              <th scope="col">Firstname:</th>
              <th scope="col">Username:</th>
              <th scope="col">Company Email:</th>
              <th scope="col">Password:</th>
              <th scope="col">Status:</th>
              <th col="2">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while($results = mysqli_fetch_assoc($sqlUsers)) { ?>
            <tr>
              <td><?php echo $results['last_names'] ?></td>
              <td><?php echo $results['first_names'] ?></td>
              <td><?php echo $results['emails'] ?></td>
              <td><?php echo $results['passwords'] ?></td>
              <td>
                <form action="./php/update_users.php" method="post">
                  <input type="submit" name="edit" value="EDIT" class="btn btn-success fw-bold">
                  <input type="hidden" name="edit_id" value="<?php echo $results['id'] ?>">
                  <input type="hidden" name="edit_last_name" value="<?php echo $results['last_names'] ?>">
                  <input type="hidden" name="edit_first_name" value="<?php echo $results['first_names'] ?>">
                  <input type="hidden" name="edit_email" value="<?php echo $results['emails'] ?>">
                  <input type="hidden" name="edit_password" value="<?php echo $results['passwords'] ?>">
                </form>
              </td>
              <td>
                <form action="./php/delete_users.php" method="post">
                  <input type="submit" name="delete" value="DELETE" class="btn btn-danger fw-bold">
                  <input type="hidden" name="deleteId" value="<?php echo $results['id'] ?>">
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