<?php
  include_once "../database/connection.php";

  // path
  function path($destination) {
    echo "<script>window.location.href = './$destination.php'</script>";
  }

  session_start();

  if ($_SESSION['users_status'] == 'invalid' || empty($_SESSION['users_status'])) {
    // default status
    $_SESSION['users_status'] = 'invalid';
  }

  if ($_SESSION['users_status'] == 'valid') {
    path('schedules');
  }

  if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $sqlLogin = "SELECT * FROM users_accounts WHERE emails=? AND passwords=? ";
    $stmtLogin = $con->prepare($sqlLogin);
    $stmtLogin->execute([$email, $password]);
    $rowLogin = $stmtLogin->fetch();

    if ($stmtLogin->rowCount() > 0) {

      if ($password == 'e99a18c428cb38d5f260853678922e03') {
        path('change_pass');
      }

      $_SESSION['users_id'] = $rowLogin->id;
      $_SESSION['users_status'] = 'valid';
      path('schedules');

    } else {
      echo '
        <div class="container mt-5 d-flex justify-content-center">
          <div class="alert alert-danger text-center w-25 mt-2">Invalid Credential</div>
        </div
      ';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LOGIN</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- JS -->
  <script src="./js/validation.js" defer></script>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-normal fs-2">Facility Management System</h5>
            <form action="index.php" method="post" class="needs-validation" novalidate>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="Email" name="email" required>
                <label for="floatingInput" class="form-label">Enter your Email</label>
                <div class="invalid-feedback">
                  Please fill-up the Email.
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                  required>
                <label for="floatingPassword" class="form-label">Enter your Password</label>
                <div class="invalid-feedback">
                  Please fill-up the Password.
                </div>
              </div>

              <div class="mb-3">
                <a href="./forgot_password.php"
                  class="h6 text-dark text-decoration-none text-primary fst-italic float-end">Forgot
                  Password</a>
              </div>
              <div class=" mt-5 d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold mt-1" type="submit" name="login">Sign
                  in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>