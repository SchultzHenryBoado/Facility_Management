<?php 
  // DATABASE 
  require_once $_SERVER['DOCUMENT_ROOT'] . './facility_management/database/connection.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/employee/$destination.php'</script>";
  }

  if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    // $queryDeleteId = "DELETE FROM reservations WHERE id = '$delete_id' ";
    // $sqlDeleteId = mysqli_query($con, $queryDeleteId);
    $sqlDeleteId = "DELETE FROM reservations WHERE id=?";
    $stmtDelete = $con->prepare($sqlDeleteId);
    $stmtDelete->execute([$delete_id]);

    pathTo('reservation');
  }