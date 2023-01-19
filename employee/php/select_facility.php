<?php
include "../../database/connection.php";

if (!empty($_POST['facility_type_id'])) {

  $stmtFacilityNum = $con->prepare("SELECT * FROM facility_room_masters WHERE facility_type_id=?");
  $stmtFacilityNum->execute([$_POST['facility_type_id']]);

  if ($stmtFacilityNum->rowCount() > 0) {
    echo '<option value="">Select Facility Number</option>';
    while ($rowFaciNum = $stmtFacilityNum->fetch()) {
      echo '<option value="' . $rowFaciNum->id . '">' . $rowFaciNum->facility_number . '</option>';
    }
  } else {
    echo '<option value="">Facility Number not available</option>';
  }
}
