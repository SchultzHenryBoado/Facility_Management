<?php
  session_start();

   // path
  function path($destination) {
    echo "<script>window.location.href = '../$destination.php'</script>";
  }

  // default status
  $_SESSION['users_status'] = 'invalid';

  // unset the users
  unset($_SESSION['users_id']);

  // redirect to login
  path('index');