<?php
session_start();

// path
function path($destination)
{
  echo "<script>window.location.href = '../$destination.php'</script>";
}

if ($_SESSION['users_approval_status'] == 'invalid' || empty($_SESSION['users_approval_status'])) {

  $_SESSION['users_approval_status'] = 'invalid';

  unset($_SESSION['users_approval_id']);

  path('index');
}