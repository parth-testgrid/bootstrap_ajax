<?php
// if (!isset($_SESSION['current_user']) && isset($POST['id'])) {
//   header("location: login.php");
// }
// if (isset($_SESSION['current_user']) && !isset($_POST['id'])) {
//   header("location: index.php");
// }
// if (!isset($_SESSION['current_user']) && !isset($_POST['id'])) {
//   header("location: login.php");
// }

if (isset($_POST['id']) && !empty(trim($_POST["id"])) && isset($_POST['action'])) {
  require_once 'config.php';

  $id = $_POST['id'];

  $selectQuery = "SELECT * FROM employees WHERE id = $id";
  $result = mysqli_query($conn, $selectQuery);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $emp_id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $birthday = $row['birthday'];
    $password = $row['password'];
    $gender = $row['gender'];
    $marital_status = $row['marital_status'];
    $hobby = $row['hobby'];
    $description = $row['description'];
    $parent_id = $row['parent_id'];

    mysqli_close($conn);
  }
} else {
  echo "Something went wrong!";
}
?>

<ul class="list-group">
  <li class="list-group-item">
    <label for="form-label">ID</label>:
    <?= $id ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Name</label>:
    <?= $name ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Email</label>:
    <?= $email ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Birthday</label>:
    <?= $birthday ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Gender</label>:
    <?= $gender ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Marital Status</label>:
    <?= $marital_status ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Hobby</label>:
    <?= $hobby ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Description</label>:
    <?= $description ?>
  </li>
  <li class="list-group-item">
    <label for="form-label">Parent ID</label>:
    <?= $parent_id ?>
  </li>
</ul>