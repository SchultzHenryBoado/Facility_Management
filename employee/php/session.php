<?php
session_start();

if ($_SESSION['users_status'] == 'invalid' || empty($_SESSION['users_status'])) {

  $_SESSION['users_status'] = 'invalid';

  unset($_SESSION['users_id']);

  header("Location: ../../index.php");
}
