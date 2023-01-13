<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FACILITY MANAGEMENT SYSTEM</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="./carousel.js" defer></script>
</head>

<body>
  <div class="container-fluid">
    <div class="container">
      <section class="vh-100 ">
        <div
          class="row d-flex align-items-center justify-content-center h-100 shadow p-3 mb-5 bg-body-tertiary rounded">
          <div class="col-md-9 col-lg-7 col-xl-6">
            <!-- CAROUSEL -->
            <div id="carouselFacility" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselFacility" data-bs-slide-to="0" class="active"
                  aria-current="true"></button>
                <button type="button" data-bs-target="#carouselFacility" data-bs-slide-to="1"
                  aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselFacility" data-bs-slide-to="2"
                  aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselFacility" data-bs-slide-to="3"
                  aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselFacility" data-bs-slide-to="4"
                  aria-label="Slide 5"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="./img/plc_logo.jpg" class="d-block w-100" alt="..." style="height: 394px; width: 620px;">
                </div>
                <div class="carousel-item">
                  <img src="./img/meeting_room.jpg" class="d-block w-100" alt="..."
                    style="height: 394px; width: 620px;">
                </div>
                <div class="carousel-item">
                  <img src="./img/board_room.jpg" class="d-block w-100" alt="..." style="height: 394px; width: 620px;">
                </div>
                <div class="carousel-item">
                  <img src="./img/basketball_court.jpg" class="d-block w-100" alt="..."
                    style="height: 394px; width: 620px;">
                </div>
                <div class="carousel-item">
                  <img src="./img/volleyball_court.jpg" class="d-block w-100" alt="..."
                    style="height: 394px; width: 620px;">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselFacility"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselFacility"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="col-md-9 col-lg-7 col-xl-5 ">
            <!-- TITLE -->
            <div class="mb-5">
              <p class="h2 text-center">Facility Management System</p>
            </div>

            <!-- Email input -->
            <div class="mb-4">
              <a type="submit" class="btn btn-primary lh-lg" style="height: 50px; width: 500px;"
                href="./admin/">Admin</a>
            </div>

            <!-- Password input -->
            <div class="mb-4">
              <a type="submit" class="btn btn-primary lh-lg" style="height: 50px; width: 500px;"
                href="./employee/">Employee</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>