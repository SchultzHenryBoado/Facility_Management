<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  if (isset($_POST['submit_reasons'])) {
    $reserveId = $_POST['reasons_id'];

    $reasons = mysqli_real_escape_string($con, $_POST['reasons']);



    $queryUpdate = "UPDATE reservations SET cancel_reasons = '$reasons' WHERE id = '$reserveId'";
    $sqlUpdate = mysqli_query($con, $queryUpdate);
    $queryReasons = "INSERT INTO reservations (id, cancel_reasons) VALUES (null, '$reasons')";

    pathTo('cancellation');
  }