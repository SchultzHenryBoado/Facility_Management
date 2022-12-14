<?php 
    // DATABASE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';
    
    // EDIT USERS
    if (isset($_POST['edit'])) {
      $editId = mysqli_real_escape_string($con, $_POST['edit_id']);
      $editLastname = mysqli_real_escape_string($con, $_POST['edit_last_name']);
      $editFirstname = mysqli_real_escape_string($con, $_POST['edit_first_name']);
      $editEmail = mysqli_real_escape_string($con, $_POST['edit_email']);
      $editPassword = mysqli_real_escape_string($con, $_POST['edit_password']);
    }

    // UPDATE USERS
    if (isset($_POST['update'])) {
      $updateId = mysqli_real_escape_string($con, $_POST['update_id']);
      $updateLastname = mysqli_real_escape_string($con, $_POST['update_last_name']);
      $updateFirstname = mysqli_real_escape_string($con, $_POST['update_first_name']);
      $updateEmail = mysqli_real_escape_string($con, $_POST['update_email']);
      $updatePassword = mysqli_real_escape_string($con, $_POST['update_password']);
      $encryptUpdatePassword = md5($updatePassword);

      $queryUpdateUsers = "UPDATE users_accounts SET last_names = '$updateLastname', first_names = '$updateFirstname', emails = '$updateEmail', passwords = '$encryptUpdatePassword' WHERE id = '$updateId' ";
      $sqlUpdateUsers = mysqli_query($con, $queryUpdateUsers);

      header("Location: ../register.php");
    }
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

  <link rel="stylesheet" href="../styles/register.css" />

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
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="#">Facility Management System</a>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
          <li class="nav-item text-center">
            <a href="dashboard-admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Cancellation</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Master File</a>
          </li>
          <li class="nav-item text-center">
            <a href="register.php" class="nav-link text-light">Register a User</a>
          </li>
          <li class="nav-item text-center">
            <form action="#" method="post">
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
      <form action="update_users.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Update a Users</p>

        <div class="row">
          <!-- LAST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <input type="hidden" name="update_id" value="<?php echo $editId ?>">

              <label for="lastName" class="form-label">Last name:</label>
              <input type="text" name="update_last_name" id="lastName" class="form-control"
                value="<?php echo $editLastname ?>" required />
              <div class="invalid-feedback">
                Please input an update Lastname
              </div>
            </div>
          </div>
          <!-- FIRST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="firstName" class="form-label">First name:</label>
              <input type="text" name="update_first_name" id="firstName" class="form-control"
                value="<?php echo $editFirstname ?>" required />
              <div class="invalid-feedback">
                Please input an update Firstname
              </div>
            </div>
          </div>
          <!-- EMAIL -->
          <div class="col">
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" name="update_email" id="email" class="form-control" value="<?php echo $editEmail ?>"
                required />
              <div class="invalid-feedback">
                Please input an update Email
              </div>
            </div>
          </div>
          <!-- PASSWORD -->
          <div class="col-12">
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password" name="update_password" id="password" class="form-control"
                value="<?php echo $editPassword ?>" required />
              <div class="invalid-feedback">
                Please input an update Password
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="update" value="UPDATE" class="btn btn-success fw-bold float-end" />
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</body>

</html>