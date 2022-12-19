<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['register_facility'])) {
    $facilityCode = mysqli_real_escape_string($con, $_POST['facility_code']);
    $facilityCodeUppercase = strtoupper($facilityCode);
    $facilityName = mysqli_real_escape_string($con, $_POST['facility_name']);

    $queryCreate = "INSERT INTO facilities VALUES (null ,'$facilityCodeUppercase','$facilityName')";
    $sqlCreate = mysqli_query($con, $queryCreate);

    pathTo('facility_type');
  }