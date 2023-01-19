<?php
include_once "../../database/connection.php";


// path
function pathTo($destination)
{
  echo "<script>window.location.href = '../$destination.php'</script>";
}

if (isset($_POST['register_facility'])) {
  $facilityType = filter_input(INPUT_POST, 'facility_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $facilityNumber = strtoupper(filter_input(INPUT_POST, 'facility_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $floorLocation = filter_input(INPUT_POST, 'floor_location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $maxCapacity = filter_input(INPUT_POST, 'max_capacity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $sqlFacilityRoomMaster = "INSERT INTO facility_room_masters (facility_type_id, facility_number, descriptions, floor_location, max_capacity, statuses) VALUES (?,?,?,?,?,?)";
  $stmtFacilityRoomMaster = $con->prepare($sqlFacilityRoomMaster);
  $stmtFacilityRoomMaster->execute([$facilityType, $facilityNumber, $description, $floorLocation, $maxCapacity, $status]);

  pathTo('facility_room_master');
}
