<?php
if (isset($_POST['id']) && !empty($_POST["id"])) {
  require_once '../config.php';
  include_once '../actions.php';

  $id = $_POST['id'];
  $deleteQuery = "DELETE FROM employees WHERE id=$id";

  if (mysqli_query($conn, $deleteQuery)) {
    echo "1";
    exit();
  } else {
    echo "Something went wrong";
  }
  mysqli_close($conn);
}
