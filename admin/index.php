<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php'; 

  session_start();

  echo $_SESSION['admin_status'];

  if ($_SESSION['admin_status'] == 'invalid' || empty($_SESSION['admin_status'])) {
    // set default invalid
    $_SESSION['admin_status'] = 'invalid';
  }

  if ($_SESSION['admin_status'] == 'valid') {
    header("Local: dashboard-admin.php");
  }

  if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $queryLogin = "SELECT * FROM admin_accounts WHERE admin_username = '$username' AND admin_password = '$password' ";
    $sqlLogin = mysqli_query($con, $queryLogin);
    $results = mysqli_fetch_assoc($sqlLogin);

    if (mysqli_num_rows($sqlLogin) > 0) {
      $_SESSION['admin_status'] = 'valid';
      $_SESSION['admin_username'] = $results['admin_username'];
      
      header("Location: dashboard-admin.php");
    } else {
      $_SESSION['admin_status'] = 'invalid';
      echo '
      <div class="container mt-5 d-flex justify-content-center">
      <div class="alert alert-danger text-center w-25 mt-2">Invalid Credential</div>
      </div>
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
  <!-- <link rel="stylesheet" href="./styles/index.css" /> -->

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
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username"
                  required>
                <label for="floatingInput" class="form-label">Username</label>
                <div class="invalid-feedback">
                  Please fill-up the Username.
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                  required>
                <label for="floatingPassword" class="form-label">Password</label>
                <div class="invalid-feedback">
                  Please fill-up the Password.
                </div>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Remember password
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Sign
                  in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>