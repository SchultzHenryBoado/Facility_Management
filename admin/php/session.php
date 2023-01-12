<?php 
  session_start();

  function pathTo($destination) {
    echo "<script>window.location.href = '../$destination.php'</script>";
  }

  if ($_SESSION['admin_status'] == 'invalid' || empty($_SESSION['admin_status'])) {
    /* Set status to invalid */
    $_SESSION['admin_status'] = 'invalid';

    /* Unset user data */
    unset($_SESSION['admin_username']);

    /* Redirect to login page */
    pathTo('index');
    
  }
?>