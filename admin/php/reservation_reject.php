<?php
  // DATABASE
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['reject_reservation'])) {
    $reject = $_POST['reject_id'];
    $rejectReasons = mysqli_real_escape_string($con, $_POST['reject_reasons']);

    $appQueryUpdate = "UPDATE reservations SET statuses = 'REJECT', cancel_reasons = '$rejectReasons' WHERE id = '$reject'";
    $appSqlUpdate = mysqli_query($con, $appQueryUpdate);

    pathTo('cancellation');
  }
  