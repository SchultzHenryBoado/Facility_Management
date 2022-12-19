<?php
  // DATABASE
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['reject_reservation'])) {
    $reject = $_POST['reject_id'];

    $appQueryUpdate = "UPDATE reservations SET statuses = 'REJECT' WHERE id = '$reject' ";
    $appSqlUpdate = mysqli_query($con, $appQueryUpdate);
    $appQueryInsert = "INSERT INTO reservations (id, statuses) VALUES ('$reject', 'REJECT')";

    pathTo('pending_reservation');
  }
  