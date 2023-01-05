<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

  if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete_id'];

    $sqlDelete = "DELETE FROM floors WHERE id=? ";
    $stmt = $con->prepare($sqlDelete);
    $stmt->execute([$deleteId]);

    pathTo('floor_master'); 
  }