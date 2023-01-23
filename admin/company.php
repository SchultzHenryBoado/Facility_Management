<?php
include_once '../database/connection.php';
include_once './php/session.php';

$sqlCompany = "SELECT * FROM companies";
$stmt = $con->prepare($sqlCompany);
$stmt->execute();

function path($destination)
{
  echo "<script>window.location.href = './$destination.php'</script>";
}

// UPDATE
if (isset($_POST['update_company'])) {
  $updateId = $_POST['update_id'];
  $updateCode = strtoupper(filter_input(INPUT_POST, 'update_company_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $updateCompany = filter_input(INPUT_POST, 'update_company_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $sqlUpdateCompany = "UPDATE companies SET company_code=?, company_name=? WHERE id=?";
  $stmt = $con->prepare($sqlUpdateCompany);
  $stmt->execute([$updateCode, $updateCompany, $updateId]);

  path('company');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COMPANY</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./styles/company.css" />

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <script src="./js/validation.js" defer></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
  <script src="./js/dataTable.js" defer></script>

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
            <a href="pending_reservation.php" class="nav-link text-light">Reservation</a>
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

  <!-- COMPANY -->
  <div class="container-fluid mt-5">
    <div class="container w-50 shadow p-3 mb-5 bg-body rounded">
      <form action="./php/company_create.php" method="post" class="needs-validation formData" novalidate>
        <p class="h1 mb-3">Company </p>

        <div class="row">

          <!-- CODE -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="companyCode" class="form-label">Code:</label>
              <input type="text" name="company_code" id="companyCode" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the company code.
              </div>
            </div>
          </div>
          <!-- COMPANY NAME -->
          <div class="col-12 ">
            <div class="mb-3" class="form-group">
              <label for="companyName" class="form-label">Company name:</label>
              <input type="text" name="company_name" id="companyName" class="form-control" required />
              <div class="invalid-feedback">
                Please fill-up the company name.
              </div>
            </div>
          </div>
          <!-- BUTTON -->
          <div class="col-12">
            <div class="mb-3">
              <input type="submit" name="create_company" value="OK" class="btn btn-success fw-bold float-end" id="btnCreate" />
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
        <table class="table table-hover table-striped" id="myTable">
          <thead>
            <tr>
              <th>Code:</th>
              <th>Company Name:</th>
              <th>Actions:</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($results = $stmt->fetch()) { ?>
              <tr>
                <td><?php echo $results->company_code ?></td>
                <td><?php echo $results->company_name ?></td>
                <td>

                  <div class="d-inline-block">
                    <!-- UPDATE COMPANY -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $results->id ?>">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <form action="company.php" method="post" class="needs-validation" novalidate>
                      <div class="modal fade" id="editModal-<?php echo $results->id ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <p class="fs-5 modal-title fw-bold">Update Company</p>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="update_id" value="<?php echo $results->id ?>">
                              <!-- COMPANY CODE -->
                              <div class="col-12 ">
                                <div class="mb-3" class="form-group">
                                  <label for="code" class="form-label">Code:</label>
                                  <input type="text" name="update_company_code" id="code" class="form-control" value="<?php echo $results->company_code ?>" required />
                                  <div class="invalid-feedback">
                                    Please fill-up the company code.
                                  </div>
                                </div>
                              </div>
                              <!-- COMPANY NAME -->
                              <div class="col-12 ">
                                <div class="mb-3" class="form-group">
                                  <label for="companyName" class="form-label">Company name:</label>
                                  <input type="text" name="update_company_name" id="companyName" class="form-control" value="<?php echo $results->company_name ?>" required />
                                  <div class="invalid-feedback">
                                    Please fill-up the company name.
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="mb-3">
                                <button type="submit" name="update_company" class="btn btn-success fw-bold">Update</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="d-inline-block">
                    <!-- DELETE BUTTON -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete-<?php echo $results->id ?>">
                      <i class="fa-solid fa-trash"></i>
                    </button>

                    <form action="./php/company_delete.php" method="post">
                      <input type="hidden" name="delete_id" value="<?php echo $results->id ?>">
                      <div class="modal fade" id="modalDelete-<?php echo $results->id ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5">Are you sure you want to Delete?</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
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