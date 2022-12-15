<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $errors = [];
  $name = trim($_POST['name']);
  if (empty($name)) {
    $errors['name_error'] = 'please enter first name';
  }

  $email = trim($_POST['email']);
  if (empty($email)) {
    $errors['email_error'] = 'please enter email';
  }

  $password = trim($_POST['password']);
  if (empty($password)) {
    $errors['password_error'] = 'please enter password';
  }

  $password_again = trim($_POST['password_again']);
  if (empty($password_again)) {
    $errors['password_again_error'] = 'please enter password again';
  }

  $selectQuery = "SELECT * FROM users WHERE email='$email'";

  $result = mysqli_query($conn, $selectQuery);
  $num = mysqli_num_rows($result);

  if ($num == 0) {
    if ($password != $password_again) {
      $errors['password_not_match'] = 'passwords do not match!';
    }

    if (count($errors) === 0) {
      $insertQuery = "INSERT INTO `employees` (`name`, `email`, `password`) VALUES ('$name', '$email', MD5('$password'))";
      $result = mysqli_query($conn, $insertQuery);

      if ($result) {
        echo "1";
      }
    } else {
      echo "Something went wrong";
    }
  }

  if ($num > 0) {
    $errors['user_already_exist'] = 'User with this email already exist!';
    echo "2";
  }
}
