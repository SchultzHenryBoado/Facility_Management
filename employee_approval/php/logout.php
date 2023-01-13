<?php
session_start();

// path
function path($destination)
{
  echo "<script>window.location.href = '../../employee/$destination.php'</script>";
}

// default status
$_SESSION['users_approval_status'] = 'invalid';

// unset the users
unset($_SESSION['users_approval_id']);

// redirect to login
path('index');