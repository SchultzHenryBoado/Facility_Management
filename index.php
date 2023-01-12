<?php
include './database/connection.php';

session_start();

if (isset($_POST['login_users'])) {
  $emails = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $passwords = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  $sqlLogin = "SELECT * FROM users_accounts WHERE emails=? AND passwords=?";
  $stmtLogin = $con->prepare($sqlLogin);
  $stmtLogin->execute([$emails, $passwords]);
  $rowUsersAccounts = $stmtLogin->fetch();

  if ($stmtLogin->rowCount() > 0) {
    echo 'correct';
  } else {
    echo 'wrong';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FACILITY MANAGEMENT SYSTEM</title>

  <!-- css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">

  <!-- js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="./carousel.js" defer></script>
  <script src="./validation.js" defer></script>
</head>

<body>
  <div class="container-fluid">
    <div class="container">
      <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <!-- CAROUSEL -->
            <div class="col-md-9 col-lg-6 col-xl-5">
              <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="./img/plc_logo.jpg" class="d-block w-100" alt="PLC Logo"
                      style="height: 350px; width: 700px">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/meeting_room.jpg" class="d-block w-100" alt="Meeting Room"
                      style="height: 350px; width: 700px">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/board_room.jpg" class="d-block w-100" alt="Board Room"
                      style="height: 350px; width: 700px">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/basketball_court.jpg" class="d-block w-100" alt="Basketball Court"
                      style="height: 350px; width: 700px">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/volleyball_room.jpg" class="d-block w-100" alt="Volleyball Court"
                      style="height: 350px; width: 700px">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <!-- FORMS -->
              <form action="./index.php" method="post" class="needs-validation" novalidate>
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                  <p class="fs-4 fw-bold text-center">Facility Management System</p>
                </div>

                <div class="divider d-flex align-items-center my-4">
                </div>

                <!-- Email input -->
                <div class="form-floating mb-4">
                  <input type="email" name="email" id="form3Example3" class="form-control"
                    placeholder="Enter a valid email address" required />
                  <label class="form-label" for="form3Example3">Email address</label>
                  <div class="invalid-feedback">
                    Please input an email.
                  </div>
                </div>

                <!-- Password input -->
                <div class="form-floating mb-3">
                  <input type="password" name="password" id="form3Example4" class="form-control"
                    placeholder="Enter password" required />
                  <label class="form-label" for="form3Example4">Password</label>
                  <div class="invalid-feedback">
                    Please input a password.
                  </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      Show password
                    </label>
                  </div>
                  <a href="#!" class="text-body">Forgot password?</a>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="submit" name="login_users" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                </div>

              </form>
            </div>
          </div>
        </div>
        <div
          class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
          <!-- Copyright -->
          <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
          </div>
          <!-- Copyright -->
        </div>
      </section>
    </div>
  </div>
</body>

</html>