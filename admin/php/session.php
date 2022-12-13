<?php
  session_start();

  if ($_SESSION['admin_status'] == 'invalid' && empty($_SESSION['admin_status'])) {
    
    $_SESSION['admin_status'] == 'invalid';
    
    unset($_SESSION['admin_username']);
  }