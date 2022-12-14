<?php 
  require ('./php/session.php');

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DASHBOARD ADMIN</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="./styles/dashboard-admin.css" />

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>

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
            <form action="./php/logout.php" method="post">
              <input type="submit" value="Logout" class="btn btn-primary" />
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- SCHEDULES -->
  <div class="container-fluid mt-5">
    <div class="container">
      <!-- INFORMATION -->
      <div class="row gap-3 justify-content-center">
        <div class="col-12 col-md-3 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">
            Total Reservation
          </p>
          <p class="fs-1 text-warning fw-bold text-center">500</p>
        </div>
        <div class="col-12 col-md-3 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">
            For Confirmation
          </p>
          <p class="fs-1 text-warning fw-bold text-center">500</p>
        </div>
        <div class="col-12 col-md-3 bg-primary">
          <p class="h3 fw-bold text-light text-center mt-3">Cancelled</p>
          <p class="fs-1 text-warning fw-bold text-center">500</p>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="container-fluid mt-5">
    <div class="container bg-primary shadow p-3 mb-5 bg-body rounded">
      <a href="#" class="btn btn-success float-end fw-bold" role="button">Inquire</a>
      <p class="h1 text-center mb-3">Schedules Today</p>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Room No.</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Reserved By</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Sample Room No.</td>
            <td>Sample From</td>
            <td>Sample To</td>
            <td>Sample Reserved By</td>
          </tr>
          <tr>
            <td>Sample Room No.</td>
            <td>Sample From</td>
            <td>Sample To</td>
            <td>Sample Reserved By</td>
          </tr>
          <tr>
            <td>Sample Room No.</td>
            <td>Sample From</td>
            <td>Sample To</td>
            <td>Sample Reserved By</td>
          </tr>
          <tr>
            <td>Sample Room No.</td>
            <td>Sample From</td>
            <td>Sample To</td>
            <td>Sample Reserved By</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>