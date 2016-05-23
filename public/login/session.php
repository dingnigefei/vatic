<?php
  session_start();

  $str = file_get_contents('../../misc/config.json');
  $json = json_decode($str, true);
  $server = $json['server'];

  if (!isset($_SESSION["username"])) {
    header("Location: http://" . $server . "/login/login.html");
    exit;
  }
?>
