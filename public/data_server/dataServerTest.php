<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";

  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  $video_id = 4522;
  $query = "SELECT * FROM frame_label WHERE video_id=" . $video_id;
  $result = mysqli_query($conn, $query) or die ('Failed to query 2'. mysqli_error($conn));

  $json = array();
  while ($row = mysqli_fetch_array($result)) {
    $json[] = array('label_name' => $row['label_name'], 'labels' => $row['labels']);
  }
  echo json_encode($json);
?>
