<?php
include "./database/connection.php";

session_start();

// Session for users
if ($_SESSION['users_status'] == 'invalid' || empty($_SESSION['users_status'])) {
  // Default status
  $_SESSION['users_status'] = 'invalid';
}

if ($_SESSION['users_status'] == 'valid') {
  header("Location: ./employee/schedules.php");
}

// Session for users approval
if ($_SESSION['users_approval_status'] == 'invalid' || empty($_SESSION['users_approval_status'])) {
  // Default status
  $_SESSION['users_approval_status'] = 'invalid';
}

if ($_SESSION['users_approval_status'] == 'valid') {
  header("Location: ./employee_approval/schedules.php");
}

// Session for admin
if ($_SESSION['admin_status'] == 'invalid' || empty($_SESSION['admin_status'])) {
  // Default status
  $_SESSION['admin_status'] = 'invalid';
}

if ($_SESSION['admin_status'] == 'valid') {
  header("Location: ./admin/dashboard_admin.php");
}

if (isset($_POST['login'])) {
  $userEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $userPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $stmtLoginUsers = $con->prepare("SELECT * FROM users_accounts WHERE emails=? AND passwords=?");
  $stmtLoginUsers->execute([$userEmail, $userPassword]);
  $rowUsersAccounts = $stmtLoginUsers->fetch();

  if ($stmtLoginUsers->rowCount() > 0) {

    if ($rowUsersAccounts->roles == "Users") {

      if ($userPassword == "abc123") {
        header("Location: ./employee/change_pass.php");
      }

      $_SESSION['users_status'] = 'valid';
      $_SESSION['users_id'] = $rowUsersAccounts->id;
      header("Location: ./employee/schedules.php");
    }

    if ($rowUsersAccounts->roles == "Users Approval") {

      if ($userPassword == "abc123") {
        header("Location: ./employee_approval/change_pass.php");
      }

      $_SESSION['users_approval_status'] = 'valid';
      $_SESSION['users_approval_id'] = $rowUsersAccounts->id;
      header("Location: ./employee_approval/schedules.php");
    }

    if ($rowUsersAccounts->roles == "Admin") {
      $_SESSION['admin_status'] = 'valid';
      $_SESSION['admin_id'] = $rowUsersAccounts->id;

      header("Location: ./admin/dashboard_admin.php");
    }
  } else {
    echo "invalid credentials";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="./validation.js" defer></script>
  <script src="./carousel.js" defer></script>
</head>

<body>
  <div class="container-fluid">
    <div class="container">
      <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <!-- Carousel -->
              <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="./img/plc_logo.jpg" class="d-block w-100 img-fluid" alt="PLC Logo"
                      style="height: 500px; width: 1000px;">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/board_room.jpg" class="d-block w-100 img-fluid" alt="Board Room"
                      style="height: 500px; width: 1000px;">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/meeting_room.jpg" class="d-block w-100 img-fluid" alt="Meeting Room"
                      style="height: 500px; width: 1000px;">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/basketball_court.jpg" class="d-block w-100 img-fluid" alt="Basketball Court"
                      style="height: 500px; width: 1000px;">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/volleyball_court.jpg" class="d-block w-100 img-fluid" alt="Volleyball Court"
                      style="height: 500px; width: 1000px;">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 shadow p-3 mb-5 bg-body-tertiary rounded mt-5">

              <div class="mb-3">
                <p class="fs-2 fw-bold text-center">Facility Management System</p>
              </div>

              <form action="index.php" method="post" class="needs-validation" novalidate>
                <!-- Email input -->
                <div class="form-floating mb-4">
                  <input type="email" name="email" id="form1Example13" class="form-control " placeholder="Email address"
                    required />
                  <label class="form-label" for="form1Example13">Email address</label>
                  <div class="invalid-feedback">
                    Please input an email.
                  </div>
                </div>

                <!-- Password input -->
                <div class="form-floating mb-4">
                  <input type="password" name="password" id="form1Example23" class="form-control "
                    placeholder="Password" required />
                  <label class="form-label" for="form1Example23">Password</label>
                  <div class="invalid-feedback">
                    Please input a password.
                  </div>
                </div>

                <!-- Submit button -->
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Sign in</button>

              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>