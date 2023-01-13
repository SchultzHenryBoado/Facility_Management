<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FACILITY MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
  <style>
  body {
    background: #c9ccd1;
  }

  .container {
    padding-top: 200px;
  }

  .box {
    padding-top: 100px;
  }

  .responsive {
    width: 100%;
    height: auto;
  }

  h1 {
    text-align: center;
  }

  p {
    text-align: center;
    margin-bottom: 10px;
    margin-top: 15px;
  }

  .form-style input {
    border: 0;
    height: 50px;
    border-radius: 0;
    border-bottom: 1px solid #ebebeb;
  }

  .form-style input:focus {
    border-bottom: 1px solid #007bff;
    box-shadow: none;
    outline: 0;
    background-color: #ebebeb;
  }

  .sideline {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #ccc;
  }

  button {
    height: 50px;
  }

  .sideline:before,
  .sideline:after {
    content: "";
    border-top: 1px solid #ebebeb;
    margin: 0 20px 0 0;
    flex: 1 0 20px;
  }

  .sideline:after {
    margin: 0 0 0 20px;
  }
  </style>
</head>

<body>
  <style>
  img {
    width: 49%;
  }

  @media all and (max-width: 480px) {
    img {
      width: 100%;
    }
  }
  </style>
  <div class="container-fluid">
    <div class="container">
      <div class="row m-5 no-gutters shadow-lg">
        <div class="col-md-6 bg-white d-none d-md-block">
          <img src="./employee/img/board_room.jpg" class="img-fluid" style="max-height: 8.5em; margin:20px 0px 0px 0px;"
            class="
          responsive" />
          <img src="./employee/img/meeting_room.jpg" class="img-fluid"
            style="max-height: 8.5em; margin:20px 0px 0px 0px;" class="responsive" />
          <p>PREMIUMLANDS CORPORATION</p>
          <h1>Facility Management </h1>
          <img src="./employee/img/basketball_court.jpg" class="img-fluid"
            style="max-height: 8.5em; margin:  0px 0px -120px 0px;" class="
          responsive" />
          <img src="./employee/img/volleyball_court.jpg" class="img-fluid"
            style="max-height: 8.5em; margin: 0px 0px -120px 0px;" class="
          responsive " />
        </div>
        <div class=" col-md-6 bg-white p-5 d-flex flex-column align-items-center">
          <img src="./employee/img/plc_logo.jpg" class="img-fluid mb-3 w-50 " style="height: 100px">
          <h4 class="pb-3 ms-auto">Facility Management </h4>
          <div class="form-style">
            <form class="box p-0">
              <div class="form-group">
                <a type="submit" class="btn btn-info font-weight-bold mt-2" style="width: 300px;"
                  href="./admin/index.php">Admin</a>
              </div>
              <div class="form-group pb-3">
                <a type="submit" class="btn btn-info font-weight-bold mt-2" href="./employee/index.php"
                  style="width: 300px;">Employee
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>