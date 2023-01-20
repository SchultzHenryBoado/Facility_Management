<?php
// DATABASE 
require_once '../../database/connection.php';

// PATH
function pathTo($destination)
{
  echo "<script>window.location.href = '../$destination.php'</script>";
}

if (isset($_POST['delete'])) {
  $delete_id = $_POST['delete_id'];

  $sqlDeleteId = "DELETE FROM reservations WHERE id=?";
  $stmtDelete = $con->prepare($sqlDeleteId);
  $stmtDelete->execute([$delete_id]);

  pathTo('reservation');
}
