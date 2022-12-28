<?php
  // DATABASE
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['accept_reservation'])) {
    $accept = $_POST['accept_id'];

    $appQueryUpdate = "UPDATE reservations SET statuses = 'APPROVED' WHERE id = '$accept' ";
    $appSqlUpdate = mysqli_query($con, $appQueryUpdate);

    pathTo('approved');

  }
  