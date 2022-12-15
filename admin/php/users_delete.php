<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  if (isset($_POST['delete'])) {
    $deleteId = $_POST['deleteId'];

    $deleteQuery = "DELETE FROM users_accounts WHERE id = '$deleteId' ";
    $deleteSql = mysqli_query($con, $deleteQuery);

    header("Location: ../register.php");
  }