<?php 
   require_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

   if (isset($_POST['register'])) {
      $lastName = mysqli_real_escape_string($con, $_POST['last_name']);
      $firstName = mysqli_real_escape_string($con, $_POST['first_name']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $encryptPassword = md5($password);

      $queryUsers = "INSERT INTO users_accounts VALUES (null, '$lastName', '$firstName', '$email', '$encryptPassword')";
      $sqlUsers = mysqli_query($con, $queryUsers);
      
      header("Location: ../register.php");
   }