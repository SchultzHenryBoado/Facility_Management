<?php 
  // DATABASE
  include_once '../database/connection.php';
  include_once './php/session.php';

  function path($destination) {
    echo "<script>window.location.href = './$destination.php'</script>";
  }
  
  // USERS
  $sqlUsers = "SELECT * FROM users_accounts";
  $stmtUsers = $con->prepare($sqlUsers);
  $stmtUsers->execute();

  // COMPANY
  $sqlCompany = "SELECT company_name FROM companies";
  $stmtCompany = $con->prepare($sqlCompany);
  $stmtCompany->execute();

  // UPDATE USERS
  if (isset($_POST['update_users'])) {
    $updateId = $_POST['update_id'];
    $updateLastname = filter_input(INPUT_POST, 'update_last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateFirstname = filter_input(INPUT_POST, 'update_first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateCompany = filter_input(INPUT_POST, 'update_company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $updateEmail = filter_input(INPUT_POST, 'update_email', FILTER_SANITIZE_EMAIL);
    $updatePassword = md5(filter_input(INPUT_POST, 'update_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $updateStatus = filter_input(INPUT_POST, 'update_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlUpdateUsers = "UPDATE users_accounts SET last_names=?, first_names=?, company=?, emails=?, passwords=?, statuses=? WHERE id=?";
    $stmtUpdates = $con->prepare($sqlUpdateUsers);
    $stmtUpdates->execute([$updateLastname, $updateFirstname, $updateCompany, $updateEmail, $updatePassword, $updateStatus, $updateId]);

    path('register');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>REGISTER A USER</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <link rel="stylesheet" href="./styles/register.css" />

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <!-- <script src="./js/forms.js" defer></script> -->
  <script src="./js/validation.js" defer></script>


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
            <a href="dashboard_admin.php" class="nav-link text-light">Dashboard</a>
          </li>
          <li class="nav-item text-center">
            <a href="pending_reservation" class="nav-link text-light">Reservation</a>
          </li>
          <li class="nav-item text-center">
            <a href="approved.php" class="nav-link text-light">Approved</a>
          </li>
          <li class="nav-item text-center">
            <a href="cancellation.php" class="nav-link text-light">Cancellation</a>
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
              <li><a class="dropdown-item" href="facility_room_master.php">Facility Room Master</a></li>
            </ul>
          </li>
          <!-- USERS MENU -->
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <i class="fa-sharp fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li class="nav-item text-center">
                <a class="dropdown-item" href="./change_password.php">Change Password</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li class="nav-item text-center">
                <a class="dropdown-item" href="./php/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form for registering the users -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/users_create.php" method="post" class="needs-validation" novalidate>
        <p class="h1 mb-3">Register a Users</p>

        <div class="row">

          <!-- LAST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3" class="form-group">
              <label for="lastName" class="form-label ">Last name:</label>
              <input type="text" name="last_name" id="lastName" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the lastname.
              </div>
            </div>
          </div>
          <!-- FIRST NAME -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="mb-3" class="form-group">
              <label for="firstName" class="form-label">First name:</label>
              <input type="text" name="first_name" id="firstName" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the firstname.
              </div>
            </div>
          </div>
          <!-- COMPANY -->
          <div class="col-12">
            <div class="mb-3" class="form-group">
              <label for="company" class="form-label">Company:</label>
              <select name="company" id="company" class="form-select" required>
                <option disabled selected value>-- Select Company --</option>
                <?php while($rowCompanyName = $stmtCompany->fetch()) { ?>
                <option value="<?php echo $rowCompanyName->company_name ?>">
                  <?php echo $rowCompanyName->company_name ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">
                Please choose a company.
              </div>
            </div>
          </div>
          <!-- EMAIL -->
          <div class="col-12">
            <div class="mb-3" class="form-group">
              <label for="email" class="form-label">Company Email:</label>
              <input type="email" name="email" id="email" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the email.
              </div>
            </div>
          </div>
          <!-- PASSWORD -->
          <div class="col-12">
            <div class="mb-3" id="passwordGroup" class="form-group">
              <label for="password" class="form-label">Password:</label>
              <input type="password" name="password" id="password" class="form-control" value="abc123" required />
              <div class="invalid-feedback">
                Please fill-up the password.
              </div>
            </div>
          </div>
          <!-- STATUS -->
          <div class="col-12">
            <div class="mb-3">
              <label for="status" class="form-label">Status:</label>
              <select name="status" id="status" class="form-select" required>
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
              </select>
              <div class="invalid-feedback">
                Please choose a status.
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="register" value="REGISTER" class="btn btn-success fw-bold float-end" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- USERS LIST -->
  <div class="container-fluid">
    <div class="container shadow p-3 mb-5 bg-body-rounded">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">Lastname:</th>
              <th scope="col">Firstname:</th>
              <th scope="col">Company:</th>
              <th scope="col">Company Email:</th>
              <th scope="col">Password:</th>
              <th scope="col">Status:</th>
              <th scope="col">Actions:</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php while($rowUsers = $stmtUsers->fetch()) { ?>
            <tr>
              <td><?php echo $rowUsers->last_names ?></td>
              <td><?php echo $rowUsers->first_names ?></td>
              <td><?php echo $rowUsers->company ?></td>
              <td><?php echo $rowUsers->emails ?></td>
              <td><?php echo $rowUsers->passwords ?></td>
              <td><?php echo $rowUsers->statuses ?></td>
              <td>
                <!-- UPDATE -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                  data-bs-target="#updateModal-<?php echo $rowUsers->id ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <form action="register.php" method="post" class="needs-validation" novalidate>
                  <?php 
                    // COMPANY
                    $sqlCompany = "SELECT company_name FROM companies";
                    $stmtCompany = $con->prepare($sqlCompany);
                    $stmtCompany->execute();
                  ?>
                  <!-- Modal -->
                  <div class="modal fade" id="updateModal-<?php echo $rowUsers->id ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5">Modal title</h1>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <input type="hidden" name="update_id" value="<?php echo $rowUsers->id ?>">
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="lastName" class="form-label">Lastname</label>
                                <input type="text" name="update_last_name" id="lastName" class="form-control"
                                  value="<?php echo $rowUsers->last_names ?>" required>
                                <div class="invalid-feedback">
                                  Please fill-up your lastname.
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="firstName" class="form-label">Firstname</label>
                                <input type="text" name="update_first_name" id="firstName" class="form-control"
                                  value="<?php echo $rowUsers->first_names ?>" required>
                                <div class="invalid-feedback">
                                  Please fill-up your firstname.
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <select name="update_company" id="company" class="form-select" required>
                                  <option disabled selected value>-- Select Company --</option>
                                  <?php while($rowCompanyName = $stmtCompany->fetch()) { ?>
                                  <option value="<?php echo $rowCompanyName->company_name ?>">
                                    <?php echo $rowCompanyName->company_name ?></option>
                                  <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                  Please choose a company.
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="email" class="form-label">Company Email</label>
                                <input type="email" name="update_email" id="email" class="form-control"
                                  value="<?php echo $rowUsers->emails ?>" required>
                                <div class="invalid-feedback">
                                  Please fill-up the email.
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="update_password" id="password" class="form-control"
                                  value="<?php echo $rowUsers->password ?>" required>
                                <div class="invalid-feedback">
                                  Please fill-up the password.
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="update_status" id="status" class="form-select" required>
                                  <option value="ACTIVE">ACTIVE</option>
                                  <option value="INACTIVE">INACTIVE</option>
                                </select>
                                <div class="invalid-feedback">
                                  Please choose a status.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="update_users" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>