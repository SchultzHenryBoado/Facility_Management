<?php
  // DATABASE
  include_once '../database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['accept_reservation'])) {
    $accept = $_POST['accept_id'];

    $sqlAcceptReservation = "UPDATE reservations SET statuses = 'APPROVED' WHERE id=?";
    $stmt = $con->prepare($sqlAcceptReservation);
    $stmt->execute([$accept]);

    pathTo('approved');

  }
  