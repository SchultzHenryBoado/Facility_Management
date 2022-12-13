<?php
  session_start();

  $_SESSION['admin_status'] == 'invalid';

  unset($_SESSION['admin_username']);

  echo "<script>window.location.href = '/facility_management/admin/index.php' </script>";
?>