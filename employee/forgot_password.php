<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FORGOT PASSWORD</title>

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
                <input type="email" class="form-control" id="floatingInput" placeholder="Enter your Email" name="email"
                  required>
                <label for="floatingInput" class="form-label">Enter your Email</label>
                <div class="invalid-feedback">
                  Please fill-up the Email.
                </div>
              </div>

              <div class=" mt-5 d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold mt-1" type="submit" name="login">SEND
                  EMAIL</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>