<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";

  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  if (isset($_POST["page_id"])) {
    $page_id = $_POST["page_id"];
    $query = "delete from user_access where page_id='" . $page_id . "'";
    $result = mysqli_query($conn, $query) or die ('Failed to query 1'. mysqli_error($conn));
    
    echo $page_id;
  } else {
    echo "Fail";
  } 
?>

