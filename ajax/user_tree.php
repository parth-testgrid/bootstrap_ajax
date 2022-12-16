<?php
session_start();


// print_r($_SESSION["current_user"]);


$data = returnUserData($_SESSION["user_id"]);
print_r($data);
function returnUserData($userID){
  require_once "../config.php";
  $selectAll = "SELECT * FROM employees where parent_id=".$userID;
  $allResult = mysqli_query($conn, $selectAll);
  $allResultArray = mysqli_fetch_all($allResult);

  if ($userID) {
    
  }

  return $allResultArray;
}