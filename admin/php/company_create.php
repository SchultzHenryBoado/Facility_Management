<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/facility_management/database/connection.php';

  // path
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/admin/$destination.php'</script>";
  }
  
  if (isset($_POST['create_company'])) {
    $companyCode = mysqli_real_escape_string($con, $_POST['company_code']);
    $upperCaseCode = strtoupper($companyCode);
    $companyName = mysqli_real_escape_string($con, $_POST['company_name']);

    $queryCompany = "INSERT INTO companies VALUES (null, '$upperCaseCode', '$companyName') ";
    $sqlCompany = mysqli_query($con, $queryCompany);

    pathTo('company');
  }
  