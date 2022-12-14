<?php 
  session_start();

  if ($_SESSION['admin_status'] == 'invalid' || empty($_SESSION['admin_status'])) {
    /* Set status to invalid */
    $_SESSION['admin_status'] = 'invalid';

    /* Unset user data */
    unset($_SESSION['admin_username']);

    /* Redirect to login page */
    header("Location: ../admin/index.php");
  }
?>