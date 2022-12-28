<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

   // path
    function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

   if (isset($_POST['register'])) {
      $lastName = mysqli_real_escape_string($con, $_POST['last_name']);
      $firstName = mysqli_real_escape_string($con, $_POST['first_name']);
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $company = mysqli_real_escape_string($con, $_POST['company']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $encryptPassword = md5($password);
      $status = mysqli_real_escape_string($con, $_POST['status']);

      $queryValidate = "SELECT * FROM users_accounts WHERE emails = '$email' ";
      $sqlValidate = mysqli_query($con, $queryValidate);
         
      if (mysqli_num_rows($sqlValidate) == 1 ) {
         echo '<script>window.alert("The email is existed")</script>';
                   
         pathTo('register');
      } else {
         $queryCreate = "INSERT INTO users_accounts VALUES (null ,'$lastName', '$firstName', '$username', '$company',  '$email', '$encryptPassword', '$status')";
         $sqlCreate = mysqli_query($con, $queryCreate);
         pathTo('register');
      }
  
   }