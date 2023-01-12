<?php 
   include_once "../database/connection.php";


   // path
    function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }

   if (isset($_POST['register'])) {
      $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $sqlRegisterValidate = "SELECT * FROM users_accounts WHERE emails=?";
      $stmtRegisterValidate = $con->prepare($sqlRegisterValidate);
      $stmtRegisterValidate->execute([$email]);

      if ($stmtRegisterValidate->rowCount() == 1) {
         echo '<script>window.alert("The email is existed")</script>';
                   
         pathTo('register');
      } else {
         $sqlCreate = "INSERT INTO users_accounts (last_names, first_names, company, emails, passwords, statuses) VALUES (?,?,?,?,?,?)";
         $stmtCreate = $con->prepare($sqlCreate);
         $stmtCreate->execute([$lastName, $firstName, $company, $email, $password, $status]);
         
         pathTo('register');
      }
   }  