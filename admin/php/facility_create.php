<?php 
   include_once "../../database/connection.php";

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '../$destination.php'</script>";
  }

  if (isset($_POST['register_facility'])) {
    $facilityCode = strtoupper(filter_input(INPUT_POST, 'facility_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $facilityName = filter_input(INPUT_POST, 'facility_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlCreate = "INSERT INTO facilities (facility_code, facility_name) VALUES (?,?)";
    $stmtCreateFacility = $con->prepare($sqlCreate);
    $stmtCreateFacility->execute([$facilityCode, $facilityName]);

    pathTo('facility_type');
  }