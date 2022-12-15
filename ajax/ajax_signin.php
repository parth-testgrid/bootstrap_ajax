<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once "../config.php";
  $email = trim($_POST['email']);
  $password = md5(trim($_POST['password']));

  $selectQuery = "SELECT * FROM employees WHERE email = '$email' and password = '$password'";

  $result = mysqli_query($conn, $selectQuery);

  $count = mysqli_num_rows($result);

  if ($count == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $id = $row['id'];
    $name = $row['name'];

    $_SESSION['current_user'] = $name;
    $_SESSION['user_id'] = $id;

    echo '1';
  } else {
    echo '0';
  }
}
