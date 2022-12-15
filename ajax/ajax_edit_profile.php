<?php
require_once '../config.php';
include_once '../actions.php';

$error = false;

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'edit_employee') {
    $id = $_POST['id'];

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
    if (empty($birthday)) {
      $error = true;
    } else {
      $error = false;
    }

    if (isset($_POST['gender'])) {
      $gender = $_POST['gender'];
      if (empty($gender)) {
        $error = true;
      } else {
        $error = false;
      }
    }

    if (isset($_POST['marital_status'])) {
      $marital_status = $_POST['marital_status'];
      if (empty($marital_status)) {
        $error = true;
      } else {
        $error = false;
      }
    }

    $hobby = trim($_POST['hobby']);
    if (empty($hobby)) {
      $error = true;
    } else {
      $error = false;
    }

    $description = trim($_POST['description']);
    if (empty($description)) {
      $error = true;
    } else {
      $error = false;
    }

    if (!$error) {
      $updateQuery = "UPDATE employees SET name='$name', email='$email', birthday='$birthday', gender='$gender', marital_status='$marital_status', hobby='$hobby', description='$description' WHERE id=$id";

      if (mysqli_query($conn, $updateQuery)) {
        echo "1";
      } else {
        echo "0";
      }

      mysqli_close($conn);
    } else {
      echo "There was an error";
    }
  }
}
