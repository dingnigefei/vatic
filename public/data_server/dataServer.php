<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";

  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  if (isset($_POST["video_data"])) {
    $data = $_POST["video_data"];

    $video_id = $data['id'];
    $flag = $data['flag'];
    $label_name = implode(',', json_decode(stripslashes($data['name'])));
    // $label_name = json_decode(stripslashes($data['name']));

    if ($flag == 0) {
      $labels = implode(',', json_decode(stripslashes($data['label'])));
      // $labels = json_decode(stripslashes($data['label']));
      // for ($i = 0; $i < count($label_name); $i++) {
      //   $query = "INSERT INTO frame_label (video_id, label_name, labels) VALUES " .
      //            "('" . $video_id . "','" . $label_name[$i] . "','" . $labels[$i] . "') " .
      //            "ON DUPLICATE KEY UPDATE label_name=VALUES(label_name), labels=VALUES(labels)";
      // }
      $query = "INSERT INTO frame_label (video_id, label_name, labels) VALUES " .
               "('" . $video_id . "','" . $label_name . "','" . $labels . "') " .
               "ON DUPLICATE KEY UPDATE label_name=VALUES(label_name), labels=VALUES(labels)";
    } elseif ($flag == 1) {
      $labels = $data['label'];
      $query = "INSERT INTO object_label (video_id, label_name, labels) VALUES " .
               "('" . $video_id . "','" . $label_name . "','" . $labels . "') " .
               "ON DUPLICATE KEY UPDATE label_name=VALUES(label_name), labels=VALUES(labels)";
    }
    $result = mysqli_query($conn, $query) or die ('Failed to query 1'. mysqli_error($conn));
    exit;
  }

  if (isset($_POST["video_load"])) {
    $data = $_POST["video_load"];

    $video_id = $data["id"];
    $flag = $data["flag"];

    if ($flag == 0) {
      $query = "SELECT * FROM frame_label WHERE video_id=" . $video_id;
    } elseif ($flag == 1) {
      $query = "SELECT * FROM object_label WHERE video_id=" . $video_id;
    }
    $result = mysqli_query($conn, $query) or die ('Failed to query 2'. mysqli_error($conn));

    if ($row = mysqli_fetch_array($result)) {
      $json = array('label_name' => $row['label_name'], 'labels' => $row['labels']);
      echo json_encode($json);
    }
    exit;
  }

  echo "Fail";
?>
