<?php
session_start();
require_once "../config.php";

print_r($_SESSION['current_user']);
if (isset($_SESSION['current_user'])) {
  $current_user = $_SESSION['current_user'];
  $user_id = $_SESSION['user_id'];

  $sqlQuery = "SELECT * FROM employees WHERE parent_id = $user_id";

  if ($result = mysqli_query($conn, $sqlQuery)) {
    $numOfRows = mysqli_num_rows($result);
    if ($numOfRows > 0) { ?>
      <ul class="list-group">
        <?php
        while ($row = mysqli_fetch_array($result)) { ?>
          <li class="list-group-item"><?= $row['name'] ?></li>
        <?php } ?>
      </ul>
<?php }
  }
}
