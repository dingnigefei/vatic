<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";
  $var = '';

  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  if (isset($_GET["page_id"])) {
    $page_id = $_GET["page_id"];
    $query = "select page_id from user_access where page_id=" . $page_id;
    $result = mysqli_query($conn, $query) or die ('Failed to query 1'. mysqli_error($conn));

    if ($row = mysqli_fetch_array($result)) {
      echo "<!DOCTYPE html>";
      echo "<html><head>";
      echo "<title>Error</title>";
      echo "<link rel='stylesheet' type='text/css' href='../css/stylesheet.css'>";
      echo "</head>";
      echo "<body><div class='main'>";
      echo "<h2>Error:</h2>";
      echo "<p>Another user is annotating this video right now!</p><br>";
      echo "<a href='http://10.234.26.35/wrapper/HospitalHygiene_wrapper.php'>Go back to previous page</a>";
      echo "</div></body></html>";
      exit;
    } else {
      $query2 = "insert into user_access (page_id, page_count) values " .
                "(" . $page_id . ",1)";
      $result = mysqli_query($conn, $query2) or die ('Failed to query '. mysqli_error($conn));
    }
  }
?>
