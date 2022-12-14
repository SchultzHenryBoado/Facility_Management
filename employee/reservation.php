<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RESERVATION</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/reservation.css" />

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
      <a class="navbar-brand fw-bold text-white __navbar-brand" href="#">Facility Management System</a>

      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
          <li class="nav-item text-center">
            <a href="dashboard.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="reservation.php" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Inquire</a>
          </li>
          <li class="nav-item text-center">
            <a href="#" class="nav-link text-light">Cancellation</a>
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

  <!-- RESERVATION FORM -->
  <div class="container-fluid mt-5">
    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
      <form action="#" method="post">
        <div class="row justify-content-center">
          <!-- CREATED DATE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdDate">Created Date:</label>
              <input type="date" id="createdDate" name="created-date" class="form-control" value=""
                aria-label="Disabled input example" disabled readonly />
            </div>
          </div>

          <!-- RSVN NO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="rsvn-no">RSVN No.</label>
              <input type="text" name="rsvn-no" id="rsvn-no" class="form-control" />
            </div>
          </div>

          <!-- CREATED BY -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="createdBy">Created By:</label>
              <input type="text" id="createdBy" name="created-by" class="form-control" value="Rico P. Ybanez"
                aria-label="Disabled input example" disabled readonly />
            </div>
          </div>

          <!-- ROOM TYPE -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="roomType">Room Type:</label>
              <select name="room-type" id="roomType" class="form-select">
                <option disabled selected value>-- Room Type --</option>
              </select>
            </div>
          </div>

          <!-- DATE FROM-->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateFrom">Date From:</label>
              <input type="date" name="date-from" id="dateFrom" class="form-control" />
            </div>
          </div>

          <!-- DATE TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="dateTo">Date To:</label>
              <input type="date" name="date-to" id="dateTo" class="form-control" />
            </div>
          </div>

          <!-- TIME FROM -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeFrom">Time From:</label>
              <input type="time" name="time-from" id="timeFrom" class="form-control" />
            </div>
          </div>

          <!-- TIME TO -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3">
              <label for="timeTo">Time To:</label>
              <input type="time" name="time-to" id="timeTo" class="form-control" />
            </div>
          </div>

          <!-- SUBMIT BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" value="PROCEED" name="proceed"
                class="form-control btn btn-success text-light fw-bold" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>