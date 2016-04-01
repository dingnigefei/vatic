<?php
  session_start();

  $server = "localhost";
  $user_name = "root";
  $password = "";
 
  $conn = mysqli_connect($server, $user_name, $password) or die ('Failed to Connect '.mysqli_error($conn));
  mysqli_select_db($conn, "vatic") or die ('Failed to Access DB'.mysqli_error($conn));

  $query = "SELECT video_id FROM frame_label"; 
  $result = mysqli_query($conn, $query) or die ('Failed to query 1'. mysqli_error($conn));

  $video_id = mysqli_fetch_array($result)) # array of strings or NULL
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
              <td><a id='0' href='http://navi.stanford.edu/?id=2685&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='1' href='http://navi.stanford.edu/?id=2686&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='2' href='http://navi.stanford.edu/?id=2687&hitId=offline'>video  3</a></td>
	    <!-- -->
              <td><a id='3' href='http://navi.stanford.edu/?id=2688&hitId=offline'>video  4</a></td>
	    <!-- -->
              <td><a id='4' href='http://navi.stanford.edu/?id=2689&hitId=offline'>video  5</a></td>
	    <!-- -->
              <td><a id='5' href='http://navi.stanford.edu/?id=2690&hitId=offline'>video  6</a></td>
	    <!-- -->
              <td><a id='6' href='http://navi.stanford.edu/?id=2691&hitId=offline'>video  7</a></td>
	    <!-- -->
              <td><a id='7' href='http://navi.stanford.edu/?id=2692&hitId=offline'>video  8</a></td>
	    <!-- -->
              <td><a id='8' href='http://navi.stanford.edu/?id=2693&hitId=offline'>video  9</a></td>
	    </tr>
	<tr>
	    <th>Oct 18th:</th>
	    <!-- -->
              <td><a id='9' href='http://navi.stanford.edu/?id=2694&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='10' href='http://navi.stanford.edu/?id=2695&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='11' href='http://navi.stanford.edu/?id=2696&hitId=offline'>video  3</a></td>
	    </tr>
	<tr>
	    <th>Oct 19th:</th>
	    <!-- -->
              <td><a id='12' href='http://navi.stanford.edu/?id=2697&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='13' href='http://navi.stanford.edu/?id=2698&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='14' href='http://navi.stanford.edu/?id=2699&hitId=offline'>video  3</a></td>
	    <!-- -->
              <td><a id='15' href='http://navi.stanford.edu/?id=2700&hitId=offline'>video  4</a></td>
	    <!-- -->
              <td><a id='16' href='http://navi.stanford.edu/?id=2701&hitId=offline'>video  5</a></td>
	    <!-- -->
              <td><a id='17' href='http://navi.stanford.edu/?id=2702&hitId=offline'>video  6</a></td>
	    <!-- -->
              <td><a id='18' href='http://navi.stanford.edu/?id=2703&hitId=offline'>video  7</a></td>
	    <!-- -->
              <td><a id='19' href='http://navi.stanford.edu/?id=2704&hitId=offline'>video  8</a></td>
	    <!-- -->
              <td><a id='20' href='http://navi.stanford.edu/?id=2705&hitId=offline'>video  9</a></td>
	    <!-- -->
              <td><a id='21' href='http://navi.stanford.edu/?id=2706&hitId=offline'>video  10</a></td>
	    <!-- -->
              <td><a id='22' href='http://navi.stanford.edu/?id=2707&hitId=offline'>video  11</a></td>
	    <!-- -->
              <td><a id='23' href='http://navi.stanford.edu/?id=2708&hitId=offline'>video  12</a></td>
	    <!-- -->
              <td><a id='24' href='http://navi.stanford.edu/?id=2709&hitId=offline'>video  13</a></td>
	    <!-- -->
              <td><a id='25' href='http://navi.stanford.edu/?id=2710&hitId=offline'>video  14</a></td>
	    <!-- -->
              <td><a id='26' href='http://navi.stanford.edu/?id=2711&hitId=offline'>video  15</a></td>
	    <!-- -->
              <td><a id='27' href='http://navi.stanford.edu/?id=2712&hitId=offline'>video  16</a></td>
	    <!-- -->
              <td><a id='28' href='http://navi.stanford.edu/?id=2713&hitId=offline'>video  17</a></td>
	    <!-- -->
              <td><a id='29' href='http://navi.stanford.edu/?id=2714&hitId=offline'>video  18</a></td>
	    <!-- -->
              <td><a id='30' href='http://navi.stanford.edu/?id=2715&hitId=offline'>video  19</a></td>
	    <!-- -->
              <td><a id='31' href='http://navi.stanford.edu/?id=2716&hitId=offline'>video  20</a></td>
	    <!-- -->
              <td><a id='32' href='http://navi.stanford.edu/?id=2717&hitId=offline'>video  21</a></td>
	    <!-- -->
              <td><a id='33' href='http://navi.stanford.edu/?id=2718&hitId=offline'>video  22</a></td>
	    <!-- -->
              <td><a id='34' href='http://navi.stanford.edu/?id=2719&hitId=offline'>video  23</a></td>
	    <!-- -->
              <td><a id='35' href='http://navi.stanford.edu/?id=2720&hitId=offline'>video  24</a></td>
	    <!-- -->
              <td><a id='36' href='http://navi.stanford.edu/?id=2721&hitId=offline'>video  25</a></td>
	    <!-- -->
              <td><a id='37' href='http://navi.stanford.edu/?id=2722&hitId=offline'>video  26</a></td>
	    <!-- -->
              <td><a id='38' href='http://navi.stanford.edu/?id=2723&hitId=offline'>video  27</a></td>
	    <!-- -->
              <td><a id='39' href='http://navi.stanford.edu/?id=2724&hitId=offline'>video  28</a></td>
	    <!-- -->
              <td><a id='40' href='http://navi.stanford.edu/?id=2725&hitId=offline'>video  29</a></td>
	    <!-- -->
              <td><a id='41' href='http://navi.stanford.edu/?id=2726&hitId=offline'>video  30</a></td>
	    <!-- -->
              <td><a id='42' href='http://navi.stanford.edu/?id=2727&hitId=offline'>video  31</a></td>
	    <!-- -->
              <td><a id='43' href='http://navi.stanford.edu/?id=2728&hitId=offline'>video  32</a></td>
	    <!-- -->
              <td><a id='44' href='http://navi.stanford.edu/?id=2729&hitId=offline'>video  33</a></td>
	    <!-- -->
              <td><a id='45' href='http://navi.stanford.edu/?id=2730&hitId=offline'>video  34</a></td>
	    <!-- -->
              <td><a id='46' href='http://navi.stanford.edu/?id=2731&hitId=offline'>video  35</a></td>
	    <!-- -->
              <td><a id='47' href='http://navi.stanford.edu/?id=2732&hitId=offline'>video  36</a></td>
	    </tr>
	<tr>
	    <th>Oct 20th:</th>
	    <!-- -->
              <td><a id='48' href='http://navi.stanford.edu/?id=2733&hitId=offline'>video  1</a></td>
	    <!-- -->
              <td><a id='49' href='http://navi.stanford.edu/?id=2734&hitId=offline'>video  2</a></td>
	    <!-- -->
              <td><a id='50' href='http://navi.stanford.edu/?id=2735&hitId=offline'>video  3</a></td>
	    <!-- -->
              <td><a id='51' href='http://navi.stanford.edu/?id=2736&hitId=offline'>video  4</a></td>
	    <!-- -->
              <td><a id='52' href='http://navi.stanford.edu/?id=2737&hitId=offline'>video  5</a></td>
	    <!-- -->
              <td><a id='53' href='http://navi.stanford.edu/?id=2738&hitId=offline'>video  6</a></td>
	    <!-- -->
              <td><a id='54' href='http://navi.stanford.edu/?id=2739&hitId=offline'>video  7</a></td>
	    <!-- -->
              <td><a id='55' href='http://navi.stanford.edu/?id=2740&hitId=offline'>video  8</a></td>
	    <!-- -->
              <td><a id='56' href='http://navi.stanford.edu/?id=2741&hitId=offline'>video  9</a></td>
	    <!-- -->
              <td><a id='57' href='http://navi.stanford.edu/?id=2742&hitId=offline'>video  10</a></td>
	    <!-- -->
              <td><a id='58' href='http://navi.stanford.edu/?id=2743&hitId=offline'>video  11</a></td>
	    <!-- -->
              <td><a id='59' href='http://navi.stanford.edu/?id=2744&hitId=offline'>video  12</a></td>
	    <!-- -->
              <td><a id='60' href='http://navi.stanford.edu/?id=2745&hitId=offline'>video  13</a></td>
	    <!-- -->
              <td><a id='61' href='http://navi.stanford.edu/?id=2746&hitId=offline'>video  14</a></td>
	    <!-- -->
              <td><a id='62' href='http://navi.stanford.edu/?id=2747&hitId=offline'>video  15</a></td>
	    <!-- -->
              <td><a id='63' href='http://navi.stanford.edu/?id=2748&hitId=offline'>video  16</a></td>
	    <!-- -->
              <td><a id='64' href='http://navi.stanford.edu/?id=2749&hitId=offline'>video  17</a></td>
	    <!-- -->
              <td><a id='65' href='http://navi.stanford.edu/?id=2750&hitId=offline'>video  18</a></td>
	    <!-- -->
              <td><a id='66' href='http://navi.stanford.edu/?id=2751&hitId=offline'>video  19</a></td>
	    <!-- -->
              <td><a id='67' href='http://navi.stanford.edu/?id=2752&hitId=offline'>video  20</a></td>
	    </tr>
	</table>
    </div>
  </body>
</html>