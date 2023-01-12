<?php
  include_once "../../database/connection.php";
  
  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '../$destination.php'</script>";
  }

  if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete_id'];

    $sqlDelete = "DELETE FROM companies WHERE id=? ";
    $stmt = $con->prepare($sqlDelete);
    $stmt->execute([$deleteId]);

    pathTo('company');
  }