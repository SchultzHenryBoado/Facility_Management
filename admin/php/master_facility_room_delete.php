<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

   // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete_id'];

    $queryDelete = "DELETE FROM facility_room_masters WHERE id = '$deleteId' ";
    $sqlDelete = mysqli_query($con, $queryDelete);

    pathTo('facility_room_master');
  }