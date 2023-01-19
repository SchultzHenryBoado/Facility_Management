<?php
// DATABASE 
require_once '../../database/connection.php';
// SESSION
require './session.php';

// PATH
function pathTo($destination)
{
  echo "<script>window.location.href = '../$destination.php'</script>";
}

if (isset($_POST['submit'])) {

  $users_id = $_SESSION['users_id'];
  $rsvnNo = filter_input(INPUT_POST, 'rsvn_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $createdBy = filter_input(INPUT_POST, 'created_by', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $roomType = filter_input(INPUT_POST, 'room_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $roomNum = filter_input(INPUT_POST, 'room_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $dateFrom = filter_input(INPUT_POST, 'date_from', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $dateTo = filter_input(INPUT_POST, 'date_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $timeFrom = filter_input(INPUT_POST, 'time_from', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $timeTo = filter_input(INPUT_POST, 'time_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $status = filter_input(INPUT_POST, 'pending_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
