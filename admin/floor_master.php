<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FLOOR MASTER</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/company.css" />


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
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="dashboard_admin.php">Facility Management
        System</a>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
          <li class="nav-item text-center">
            <a href="dashboard_admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Inquire</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Cancellation</a>
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
              <li><a class="dropdown-item" href="#">Facility Room</a></li>
            </ul>
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

  <!-- FLOOR MASTER -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/create_users.php" method="post" class="needs-validation">
        <p class="h1 mb-3">Floor Master</p>

        <div class="row">

          <!-- CODE -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="code" class="form-label">Code:</label>
              <input type="text" name="floor_master_code" id="code" class="form-control" />
              <!-- <div class="invalid-feedback">
                Please fill-up the Lastname
              </div> -->
            </div>
          </div>
          <!-- DESCRIPTION -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="description" class="form-label">Description:</label>
              <textarea class="form-control" placeholder="Description" id="description"
                style="height: 100px"></textarea>
              <!-- <div class="invalid-feedback">
                Please fill-up the Firstname
              </div> -->
            </div>
          </div>
          <!-- BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="register" value="OK" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- COMPANY LIST -->
  <div class="container-fluid">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">Code:</th>
              <th scope="col">Description:</th>
              <th col="2">Actions:</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Sample Code</td>
              <td>Sample Description</td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>