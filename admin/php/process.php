<?php 
  $errors = [];
  $data = [];

  if (empty($_POST['last_name'])) {
      $errors['last_name'] = 'Lastname is required.';
  }

  if (empty($_POST['first_name'])) {
      $errors['first_name'] = 'Firstname is required.';
  }

  if (empty($_POST['email'])) {
      $errors['email'] = 'Email is required.';
  }

  if (empty($_POST['password'])) {
      $errors['password'] = 'Password alias is required.';
  }

  if(!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
  } else {
    $data['success'] = true;
    $data['message'] = 'Added successfully';
  }

  echo json_encode($data);