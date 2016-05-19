<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    header("Location: http://10.234.26.35/login/login.html");
    exit;
  }
?>
