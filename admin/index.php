<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php'; 

  session_start();

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php' </script>";
  }

  if ($_SESSION['admin_status'] == 'invalid' || empty($_SESSION['admin_status'])) {
    // set default status
    $_SESSION['admin_status'] = 'invalid';
  }

  if ($_SESSION['admin_status'] == 'valid') {
    pathTo('dashboard_admin');
  }

  if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "SELECT * FROM admin_accounts WHERE admin_username=? AND admin_password=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$username, $password]);
    $rows = $stmt->fetch();

    if ($count = $stmt->rowCount() > 0) {
      $_SESSION['admin_status'] = 'valid';
      $_SESSION['admin_username'] = $rows->admin_username;
      pathTo('dashboard_admin');

    } else {
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
  <script src="./js/show_password.js" defer></script>
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
                <label for="floatingInput" class="form-label">Enter your Username</label>
                <div class="invalid-feedback">
                  Please fill-up the Username.
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
              <div class=" mb-3">
                <input type="checkbox" name="check" id="checkbox" class="form-check-input" value="">
                <label for="checkbox" class="form-check-label">Show Password</label>
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