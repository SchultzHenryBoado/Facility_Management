<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  if (isset($_POST['register_facility'])) {
    $facilityType = mysqli_real_escape_string($con, $_POST['facility_type']);
    $facilityNumber = mysqli_real_escape_string($con, $_POST['facility_number']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $floorLocation = mysqli_real_escape_string($con, $_POST['floor_location']);
    $maxCapacity = mysqli_real_escape_string($con, $_POST['max_capacity']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $queryFacilityRoomMaster = "INSERT INTO facility_room_masters VALUES (null, '$facilityType', '$facilityNumber', '$description', '$floorLocation', '$maxCapacity', '$status' ) ";
    $sqlFacilityRoomMaster = mysqli_query($con, $queryFacilityRoomMaster);

    pathTo('facility_room_master');
  }