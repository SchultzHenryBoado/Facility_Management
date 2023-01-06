<?php
  // DATABASE
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['reject_reservation'])) {
    $reject = $_POST['reject_id'];
    $rejectReasons = filter_input(INPUT_POST, 'reject_reasons', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlRejectReservation = "UPDATE reservations SET statuses = 'REJECT', cancel_reasons=? WHERE id=?";
    $stmt = $con->prepare($sqlRejectReservation);
    $stmt->execute([$rejectReasons, $reject]);

    pathTo('cancellation');
  }
  