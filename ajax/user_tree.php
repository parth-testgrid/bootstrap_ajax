<?php
session_start();
require_once "../config.php";

$data = returnUserData(42);
print_r($data);
function returnUserData($userID)
{
  $selectAll = "SELECT * FROM employees where parent_id=" . $userID;
  $allResult = mysqli_query($GLOBALS['conn'], $selectAll);

  $allResultArray = [];

  if (mysqli_num_rows($allResult) > 0) {
    while ($row = mysqli_fetch_array($allResult)) {
      $allResultArray[$row['id']] = returnUserData($row['id']);
      echo "<br>";
      print_r($row['id']);
      echo "<br>";
    }
  }

  return $allResultArray;
}

// check current node while inserting 