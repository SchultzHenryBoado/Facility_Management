<?php 
  // DATABASE
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['floor_master'])) {
    // $floorCode = mysqli_real_escape_string($con, $_POST['floor_code']);
    // $upperCaseFloorCode = strtoupper($floorCode);
    // $floorNumber = mysqli_real_escape_string($con, $_POST['floor_number']);

    $floorCode = strtoupper(filter_input(INPUT_POST, 'floor_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $floorNumber = filter_input(INPUT_POST, 'floor_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlFloorCreate = "INSERT INTO floors (floor_code, floor_number) VALUES (?, ?)";
    $stmt = $con->prepare($sqlFloorCreate);
    $stmt->execute([$floorCode, $floorNumber]);

    pathTo('floor_master');
  }