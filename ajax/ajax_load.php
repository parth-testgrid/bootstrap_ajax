<?php
require_once "../config.php";
include_once "../actions.php";

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'employee_list') {
    include "../employeeList.php";
  } elseif ($_POST['action'] == 'add_new') {
    include "../addEmployee.php";
  } elseif ($_POST['action'] == 'view_employee') {
    include "../viewEmployee.php";
  } elseif ($_POST['action'] == 'edit_employee') {
    include "../editEmployee.php";
  }
}
