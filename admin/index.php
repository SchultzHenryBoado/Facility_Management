<?php 
 require_once $_SERVER['DOCUMENT_ROOT'] = '/facility_management/database/connection.php'; 
// var_dump($_SERVER);

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/index.css" />
</head>

<body>
    <div class="container">
        <div class="row m-5 no-gutters shadow-lg">
            <div class="col-md-6 d-none d-md-block">
                <img src="./img/Facility hotel.jpg" class="img-fluid"
                    style="max-height: 8.5em; margin: 20px 0px 0px 0px" ; alt="Responsive Image" />
                <img src="./img/pool.jpg" class="img-fluid" style="max-height: 8.5em; margin: 20px 0px 0px 0px"
                    alt="Responsive Image" />

                <p>PREMUIMLANDS CORPORATION</p>
                <h1>Facility Management System</h1>
                <img src="./img/rooms.jpg" class="img-fluid" style="max-height: 8.5em; margin: 0px 0px -130px 0px"
                    alt="Responsive Image" />
                <img src="./img/bedroom.jpg" class="img-fluid" style="max-height: 8.5em; margin: 0px 0px -130px 0px"
                    alt="Responsive Image" />
            </div>
            <div class="col-md-6 bg-white p-5">
                <h1 class="pb-3">Admin Login</h1>
                <div class="form-style">
                    <form>
                        <div class="form-group pb-3">
                            <input type="username" placeholder="Username" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                        </div>
                        <div class="form-group pb-3">
                            <input type="password" placeholder="Password" class="form-control"
                                id="exampleInputPassword1" />
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input name="" type="checkbox" value="" />
                                <span class="pl-2 font-weight-bold">Remember Me</span>
                            </div>
                            <div><a href="#">Forget Password?</a></div>
                        </div>
                        <div class="pb-2">
                            <button type="submit" class="btn btn-info w-100 font-weight-bold mt-2">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>