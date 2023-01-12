<?php 
   include_once "../../database/connection.php";

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  if (isset($_POST['create_company'])) {

    $companyCode = strtoupper(filter_input(INPUT_POST, 'company_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $companyName = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sqlCompany = "INSERT INTO companies (company_code, company_name) VALUES (?,?)";
    $stmt = $con->prepare($sqlCompany);
    $stmt->execute([$companyCode, $companyName]);

    pathTo('company');
  }
  