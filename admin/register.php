<?php 
  // DATABASE
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
  require './php/session.php';
  
  // USERS
  $queryUsers = "SELECT * FROM users_accounts";
  $sqlUsers = mysqli_query($con, $queryUsers);

  // COMPANY
  $queryCompany = "SELECT company_name FROM companies";
  $sqlCompany = mysqli_query($con, $queryCompany);

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
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="dashboard-admin.php">Facility Management
        System</a>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
          <li class="nav-item text-center">
            <a href="dashboard_admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="pending_reservation" class="nav-link text-light">Reservation</a>
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

  <!-- Form for registering the users -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/users_create.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Register a Users</p>

        <div class="row">

          <!-- LAST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3" class="form-group">
              <label for="lastName" class="form-label ">Last name:</label>
              <input type="text" name="last_name" id="lastName" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the lastname.
              </div>
            </div>
          </div>
          <!-- FIRST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3" class="form-group">
              <label for="firstName" class="form-label">First name:</label>
              <input type="text" name="first_name" id="firstName" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the firstname.
              </div>
            </div>
          </div>
          <!-- USERNAME -->
          <div class="col-12">
            <div class="mb-3" class="form-group">
              <label for="userName" class="form-label">Username:</label>
              <input type="text" name="username" id="userName" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the username.
              </div>
            </div>
          </div>
          <!-- COMPANY -->
          <div class="col-12">
            <div class="mb-3" class="form-group">
              <label for="company" class="form-label">Company:</label>
              <select name="company" id="company" class="form-select" required>
                <option disabled selected value>-- Select Company --</option>
                <?php while($rowCompanyName = mysqli_fetch_assoc($sqlCompany)) { ?>
                <option value="<?php echo $rowCompanyName['company_name'] ?>">
                  <?php echo $rowCompanyName['company_name'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Please choose a company.
              </div>
            </div>
          </div>
          <!-- EMAIL -->
          <div class="col-12">
            <div class="mb-3" class="form-group">
              <label for="email" class="form-label">Company Email:</label>
              <input type="email" name="email" id="email" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the email.
              </div>
            </div>
          </div>
          <!-- PASSWORD -->
          <div class="col-12">
            <div class="mb-3" id="passwordGroup" class="form-group">
              <label for="password" class="form-label">Password:</label>
              <input type="password" name="password" id="password" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the password.
              </div>
            </div>
          </div>
          <!-- STATUS -->
          <div class="col-12">
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="status" id="status" class="form-select" required>
                <option disabled selected value>-- Select Status --</option>
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
              </select>
              <div class="invalid-feedback">
                Please choose a status.
              </div>
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
              <th scope="col">Company:</th>
              <th scope="col">Company Email:</th>
              <th scope="col">Password:</th>
              <th scope="col">Status:</th>
              <th scope="col">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while($results = mysqli_fetch_assoc($sqlUsers)) { ?>
            <tr>
              <td><?php echo $results['last_names'] ?></td>
              <td><?php echo $results['first_names'] ?></td>
              <td><?php echo $results['username'] ?></td>
              <td><?php echo $results['company'] ?></td>
              <td><?php echo $results['emails'] ?></td>
              <td><?php echo $results['passwords'] ?></td>
              <td><?php echo $results['statuses'] ?></td>
              <td>
                <form action="./php/users_update.php" method="post">
                  <input type="submit" name="edit" value="EDIT" class="btn btn-success fw-bold">
                  <input type="hidden" name="edit_id" value="<?php echo $results['id'] ?>">
                  <input type="hidden" name="edit_last_name" value="<?php echo $results['last_names'] ?>">
                  <input type="hidden" name="edit_first_name" value="<?php echo $results['first_names'] ?>">
                  <input type="hidden" name="edit_username" value="<?php echo $results['username'] ?>">
                  <input type="hidden" name="edit_company" value="<?php echo $results['company'] ?>">
                  <input type="hidden" name="edit_email" value="<?php echo $results['emails'] ?>">
                  <input type="hidden" name="edit_password" value="<?php echo $results['passwords'] ?>">
                  <input type="hidden" name="edit_status" value="<?php echo $results['statuses'] ?>">
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