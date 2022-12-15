<?php
require_once '../config.php';
include_once '../actions.php';

$parent_id = $_SESSION['user_id'];

$error = false;

if (isset($_POST['name'])) {
  $name = trim($_POST['name']);
  if (empty($name)) {
    $error = true;
  } else {
    $error = false;
  }

  $email = trim($_POST['email']);
  if (empty($email)) {
    $error = true;
  } else {
    $error = false;
  }

  $birthday = trim($_POST['birthday']);

  $password = trim($_POST['password']);
  if (empty($password)) {
    $error = true;
  } else {
    $error = false;
  }

  if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];
  }

  if (isset($_POST['marital_status'])) {
    $marital_status = $_POST['marital_status'];
  }

  $hobby = trim($_POST['hobby']);

  $description = trim($_POST['description']);

  if (!$error) {
    $insertQuery = "INSERT INTO `employees` (`name`, `email`, `birthday`, `password`, `gender`, `marital_status`, `hobby`, `description`, `parent_id`) VALUES ('$name', '$email', '$birthday', MD5('$password'), '$gender', '$marital_status', '$hobby', '$description', '$parent_id')";

    if (mysqli_query($conn, $insertQuery)) {
      echo "1";
    } else {
      echo "0";
    }

    mysqli_close($conn);
  } else {
    echo "There was an error";
  }
}
