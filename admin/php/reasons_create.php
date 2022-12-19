<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  // USERS
  $queryUsers = "SELECT * FROM users_accounts";
  $sqlUsers = mysqli_query($con, $queryUsers);  
  $result = mysqli_fetch_assoc($sqlUsers);
  
  if (isset($_POST['reject'])) {
    $reject = $_POST['reject_id'];

    $appQueryUpdate = "UPDATE reservations SET statuses = 'REJECT' WHERE id = '$accept' ";
    $appSqlUpdate = mysqli_query($con, $appQueryUpdate);
    $appQueryInsert = "INSERT INTO reservations (id, statuses) VALUES ('$accept', 'REJECT')";

    pathTo('cancellation');
  }