<?php
session_start();

function pathTo($destination)
{
  echo "<script>window.location.href = '../../$destination.php'</script>";
}

$_SESSION['admin_status'] = 'invalid';

unset($_SESSION['admin_id']);

pathTo('index');