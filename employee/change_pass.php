<?php
require_once "../database/connection.php";
require './php/session.php';

function pathTo($destination)
{
  echo "<script>window.location.href = './$destination.php'</script>";
}

$users_id = $_SESSION['users_id'];

if (isset($_POST['change_password'])) {

  $oldPassword = filter_input(INPUT_POST, 'old_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $sqlOldPassword = "SELECT * FROM users_accounts WHERE id=?";
  $stmt = $con->prepare($sqlOldPassword);
  $stmt->execute([$users_id]);
  $rowPass = $stmt->fetch();

  if ($oldPassword == $rowPass->passwords) {
    $newPassword = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($newPassword == $confirmPassword) {

      $sqlUpdatePassword = "UPDATE users_accounts SET passwords=? WHERE id=?";
      $stmt = $con->prepare($sqlUpdatePassword);
      $stmt->execute([$confirmPassword, $users_id]);

      $_SESSION['users_status'] = 'invalid';
      pathTo('index');
    } else {
      echo '
        <div class="container mt-5 d-flex justify-content-center">
          <div class="alert alert-danger text-center w-25 mt-2">Your confirm password is not same with the new password</div>
        </div
        ';
    }
  } else {
    echo '
       <div class="container mt-5 d-flex justify-content-center">
          <div class="alert alert-danger text-center w-25 mt-2">Wrong old password</div>
        </div
      ';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHANGE PASSWORD</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="./js/validation.js" defer></script>

  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/8cbc2e0f0e.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-normal fs-2">Facility Management System</h5>

            <form action="change_pass.php" method="post" class="needs-validation" novalidate>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" placeholder="Old Password"
                  name="old_password" required>
                <label for="floatingInput" class="form-label">Old Password</label>
                <div class="invalid-feedback">
                  Please fill-up the Old Password.
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                  name="new_password" required>
                <label for="floatingPassword" class="form-label">New Password</label>
                <div class="invalid-feedback">
                  Please fill-up the New Password.
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                  name="confirm_password" required>
                <label for="floatingPassword" class="form-label">Confirm Password</label>
                <div class="invalid-feedback">
                  Please fill-up the Confirm Password.
                </div>
              </div>
              <div class=" mt-5 d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold mt-1" type="submit"
                  name="change_password">Sign
                  in</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>