<?php
  session_start();
  
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  $_SESSION['admin_status'] = 'invalid';

  unset($_SESSION['admin_username']);

  pathTo('index');
?>