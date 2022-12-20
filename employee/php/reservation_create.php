<?php 
  // DATABASE 
  require_once $_SERVER['DOCUMENT_ROOT'] . './facility_management/database/connection.php';
  // SESSION
  require './session.php';

  // PATH
  function pathTo($destination) {
    echo "<script>window.location.href = '/facility_management/employee/$destination.php'</script>";
  }

  if (isset($_POST['submit'])) {
    $users_id = $_SESSION['users_id'];
    $rsvnNo = mysqli_real_escape_string($con, $_POST['rsvn_no']);
    $createdBy = mysqli_real_escape_string($con, $_POST['created_by']);
    $roomType = mysqli_real_escape_string($con, $_POST['room_type']);
    $dateFrom = mysqli_real_escape_string($con, $_POST['date_from']);
    $dateTo = mysqli_real_escape_string($con, $_POST['date_to']);
    $timeFrom = mysqli_real_escape_string($con, $_POST['time_from']);
    $timeTo = mysqli_real_escape_string($con, $_POST['time_to']);
    $status = mysqli_real_escape_string($con, $_POST['pending_status']);

    $queryReservationCreate = "INSERT INTO reservations (id, users_id, created_date, rsvn_no, created_by, room_type, date_from, date_to, time_from, time_to, statuses) 
    VALUES (null, '$users_id', curdate(), '$rsvnNo', '$createdBy', '$roomType', '$dateFrom', '$dateTo', '$timeFrom' , '$timeTo', '$status') ";
    $sqlReservationCreate = mysqli_query($con, $queryReservationCreate);

    pathTo('reservation');
    
  }