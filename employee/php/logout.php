<?php
session_start();

// default status
$_SESSION['users_status'] = 'invalid';

// unset the users
unset($_SESSION['users_id']);

// redirect to login
header("Location: ../../index.php");