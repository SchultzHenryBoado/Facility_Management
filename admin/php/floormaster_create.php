<?php 
  // DATABASE
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['floor_master'])) {
    $floorCode = mysqli_real_escape_string($con, $_POST['floor_code']);
    $upperCaseFloorCode = strtoupper($floorCode);
    $floorNumber = mysqli_real_escape_string($con, $_POST['floor_number']);

    $queryFloorCreate = "INSERT INTO floors VALUES (null, '$upperCaseFloorCode', '$floorNumber')";
    $sqlFloorCreate = mysqli_query($con, $queryFloorCreate);

    pathTo('floor_master');
  }