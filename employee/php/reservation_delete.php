<?php
// DATABASE 
include '../../database/connection.php';

if (isset($_POST['delete'])) {
  $delete_id = $_POST['delete_id'];

  $sqlDeleteId = "DELETE FROM reservations WHERE id=?";
  $stmtDelete = $con->prepare($sqlDeleteId);
  $stmtDelete->execute([$delete_id]);

  header("Location: ../reservation.php");
}
