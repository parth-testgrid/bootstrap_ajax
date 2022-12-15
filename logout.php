<?php
require_once "config.php";
if (session_status() == 1) {
  session_start();
}

if (session_destroy()) {
  // header("Location: login.php");
  echo "1";
}
