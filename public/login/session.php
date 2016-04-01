<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    header("Location: http://navi.stanford.edu/login/login.html");
    exit;
  }
?>
