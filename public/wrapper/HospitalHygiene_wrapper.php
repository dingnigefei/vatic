<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";
 
  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  $query = "SELECT * FROM frame_label"; 
  $result = mysqli_query($conn, $query) or die ('Failed to query 1'. mysqli_error($conn));

  $video_id = array();
  while($row = mysqli_fetch_array($result)) {
    array_push($video_id, $row["video_id"]);
  }
  print_r($video_id);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hits</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
  </head>
  <body>
    <div class='header'>
      <img src='../bg.jpg'>
      <h1>Healthcare</h1>
    </div>
    <div class='main'>
      <table align='center'>
        <tr>
	    <th>Oct 17th:</th>
	    <!-- -->
              <td><a id='0' href='http://navi.stanford.edu/?id=3501&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='1' href='http://navi.stanford.edu/?id=3502&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='2' href='http://navi.stanford.edu/?id=3503&hitId=offline'>video  3</a></td>
	    <!-- -->
              <td><a id='3' href='http://navi.stanford.edu/?id=3504&hitId=offline'>video  4</a></td>
	    <!-- -->
              <td><a id='4' href='http://navi.stanford.edu/?id=3505&hitId=offline'>video  5</a></td>
	    <!-- -->
              <td><a id='5' href='http://navi.stanford.edu/?id=3506&hitId=offline'>video  6</a></td>
	    <!-- -->
              <td><a id='6' href='http://navi.stanford.edu/?id=3507&hitId=offline'>video  7</a></td>
	    <!-- -->
              <td><a id='7' href='http://navi.stanford.edu/?id=3508&hitId=offline'>video  8</a></td>
	    <!-- -->
              <td><a id='8' href='http://navi.stanford.edu/?id=3509&hitId=offline'>video  9</a></td>
	    </tr>
	<tr>
	    <th>Oct 18th:</th>
	    <!-- -->
              <td><a id='9' href='http://navi.stanford.edu/?id=3510&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='10' href='http://navi.stanford.edu/?id=3511&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='11' href='http://navi.stanford.edu/?id=3512&hitId=offline'>video  3</a></td>
	    </tr>
	<tr>
	    <th>Oct 19th:</th>
	    <!-- -->
              <td><a id='12' href='http://navi.stanford.edu/?id=3513&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='13' href='http://navi.stanford.edu/?id=3514&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='14' href='http://navi.stanford.edu/?id=3515&hitId=offline'>video  3</a></td>
	    <!-- -->
              <td><a id='15' href='http://navi.stanford.edu/?id=3516&hitId=offline'>video  4</a></td>
	    <!-- -->
              <td><a id='16' href='http://navi.stanford.edu/?id=3517&hitId=offline'>video  5</a></td>
	    <!-- -->
              <td><a id='17' href='http://navi.stanford.edu/?id=3518&hitId=offline'>video  6</a></td>
	    <!-- -->
              <td><a id='18' href='http://navi.stanford.edu/?id=3519&hitId=offline'>video  7</a></td>
	    <!-- -->
              <td><a id='19' href='http://navi.stanford.edu/?id=3520&hitId=offline'>video  8</a></td>
	    <!-- -->
              <td><a id='20' href='http://navi.stanford.edu/?id=3521&hitId=offline'>video  9</a></td>
	    <!-- -->
              <td><a id='21' href='http://navi.stanford.edu/?id=3522&hitId=offline'>video  10</a></td>
	    <!-- -->
              <td><a id='22' href='http://navi.stanford.edu/?id=3523&hitId=offline'>video  11</a></td>
	    <!-- -->
              <td><a id='23' href='http://navi.stanford.edu/?id=3524&hitId=offline'>video  12</a></td>
	    <!-- -->
              <td><a id='24' href='http://navi.stanford.edu/?id=3525&hitId=offline'>video  13</a></td>
	    <!-- -->
              <td><a id='25' href='http://navi.stanford.edu/?id=3526&hitId=offline'>video  14</a></td>
	    <!-- -->
              <td><a id='26' href='http://navi.stanford.edu/?id=3527&hitId=offline'>video  15</a></td>
	    <!-- -->
              <td><a id='27' href='http://navi.stanford.edu/?id=3528&hitId=offline'>video  16</a></td>
	    <!-- -->
              <td><a id='28' href='http://navi.stanford.edu/?id=3529&hitId=offline'>video  17</a></td>
	    <!-- -->
              <td><a id='29' href='http://navi.stanford.edu/?id=3530&hitId=offline'>video  18</a></td>
	    <!-- -->
              <td><a id='30' href='http://navi.stanford.edu/?id=3531&hitId=offline'>video  19</a></td>
	    <!-- -->
              <td><a id='31' href='http://navi.stanford.edu/?id=3532&hitId=offline'>video  20</a></td>
	    <!-- -->
              <td><a id='32' href='http://navi.stanford.edu/?id=3533&hitId=offline'>video  21</a></td>
	    <!-- -->
              <td><a id='33' href='http://navi.stanford.edu/?id=3534&hitId=offline'>video  22</a></td>
	    <!-- -->
              <td><a id='34' href='http://navi.stanford.edu/?id=3535&hitId=offline'>video  23</a></td>
	    <!-- -->
              <td><a id='35' href='http://navi.stanford.edu/?id=3536&hitId=offline'>video  24</a></td>
	    <!-- -->
              <td><a id='36' href='http://navi.stanford.edu/?id=3537&hitId=offline'>video  25</a></td>
	    <!-- -->
              <td><a id='37' href='http://navi.stanford.edu/?id=3538&hitId=offline'>video  26</a></td>
	    <!-- -->
              <td><a id='38' href='http://navi.stanford.edu/?id=3539&hitId=offline'>video  27</a></td>
	    <!-- -->
              <td><a id='39' href='http://navi.stanford.edu/?id=3540&hitId=offline'>video  28</a></td>
	    <!-- -->
              <td><a id='40' href='http://navi.stanford.edu/?id=3541&hitId=offline'>video  29</a></td>
	    <!-- -->
              <td><a id='41' href='http://navi.stanford.edu/?id=3542&hitId=offline'>video  30</a></td>
	    <!-- -->
              <td><a id='42' href='http://navi.stanford.edu/?id=3543&hitId=offline'>video  31</a></td>
	    <!-- -->
              <td><a id='43' href='http://navi.stanford.edu/?id=3544&hitId=offline'>video  32</a></td>
	    <!-- -->
              <td><a id='44' href='http://navi.stanford.edu/?id=3545&hitId=offline'>video  33</a></td>
	    <!-- -->
              <td><a id='45' href='http://navi.stanford.edu/?id=3546&hitId=offline'>video  34</a></td>
	    <!-- -->
              <td><a id='46' href='http://navi.stanford.edu/?id=3547&hitId=offline'>video  35</a></td>
	    <!-- -->
              <td><a id='47' href='http://navi.stanford.edu/?id=3548&hitId=offline'>video  36</a></td>
	    </tr>
	<tr>
	    <th>Oct 20th:</th>
	    <!-- -->
              <td><a id='48' href='http://navi.stanford.edu/?id=3549&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='49' href='http://navi.stanford.edu/?id=3550&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='50' href='http://navi.stanford.edu/?id=3551&hitId=offline'>video  3</a></td>
	    <!-- -->
              <td><a id='51' href='http://navi.stanford.edu/?id=3552&hitId=offline'>video  4</a></td>
	    <!-- -->
              <td><a id='52' href='http://navi.stanford.edu/?id=3553&hitId=offline'>video  5</a></td>
	    <!-- -->
              <td><a id='53' href='http://navi.stanford.edu/?id=3554&hitId=offline'>video  6</a></td>
	    <!-- -->
              <td><a id='54' href='http://navi.stanford.edu/?id=3555&hitId=offline'>video  7</a></td>
	    <!-- -->
              <td><a id='55' href='http://navi.stanford.edu/?id=3556&hitId=offline'>video  8</a></td>
	    <!-- -->
              <td><a id='56' href='http://navi.stanford.edu/?id=3557&hitId=offline'>video  9</a></td>
	    <!-- -->
              <td><a id='57' href='http://navi.stanford.edu/?id=3558&hitId=offline'>video  10</a></td>
	    <!-- -->
              <td><a id='58' href='http://navi.stanford.edu/?id=3559&hitId=offline'>video  11</a></td>
	    <!-- -->
              <td><a id='59' href='http://navi.stanford.edu/?id=3560&hitId=offline'>video  12</a></td>
	    <!-- -->
              <td><a id='60' href='http://navi.stanford.edu/?id=3561&hitId=offline'>video  13</a></td>
	    <!-- -->
              <td><a id='61' href='http://navi.stanford.edu/?id=3562&hitId=offline'>video  14</a></td>
	    <!-- -->
              <td><a id='62' href='http://navi.stanford.edu/?id=3563&hitId=offline'>video  15</a></td>
	    <!-- -->
              <td><a id='63' href='http://navi.stanford.edu/?id=3564&hitId=offline'>video  16</a></td>
	    <!-- -->
              <td><a id='64' href='http://navi.stanford.edu/?id=3565&hitId=offline'>video  17</a></td>
	    <!-- -->
              <td><a id='65' href='http://navi.stanford.edu/?id=3566&hitId=offline'>video  18</a></td>
	    <!-- -->
              <td><a id='66' href='http://navi.stanford.edu/?id=3567&hitId=offline'>video  19</a></td>
	    <!-- -->
              <td><a id='67' href='http://navi.stanford.edu/?id=3568&hitId=offline'>video  20</a></td>
	    </tr>
	</table>
    </div>
  </body>
</html>
