<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";

  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  $query = "select * from vatic_users";
  $result = mysqli_query($conn, $query) or die ('Failed to query '. mysqli_error($conn));

  $str = file_get_contents('../../misc/config.json');
  $json = json_decode($str, true);
  $server = $json['server'];

  while ($row = mysqli_fetch_array($result)) {
    if ($_POST["loginName"] == $row["user_name"] && $_POST["loginPassword"] == $row["user_password"]) {
      $_SESSION["username"] = $_POST["loginName"];
      header("Location: http://" . $server . "/hits_hygiene.php");
      exit;
    }
  }

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="../css_login/style2.css">
  </head>
  <body>
    <p>Invalid Username or Password!</p><br>
    <?php
      echo '<a href="http://' . $server . '/login/login.html">Go back to Login Page</a>';
    ?>
  </body>
</html>
