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

  // $video_id = array(3705, 3706, 3707, 3712, 3714, 3719, 3720); // Hard code for testing
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hits</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
    <script type="text/javascript">
      var video_ids_raw = <?php echo '["' . implode('", "', $video_id) . '"]' ?>;

      function updateVideoStatus() {
        // var info = document.getElementById('info');
        // var offset = info.innerHTML.split(' ').slice(-1)[0];
        var offset = 1;
        console.log(offset);
        var video_ids = video_ids_raw.map( function (value) {
          var newVal = parseInt(value) - parseInt(offset);
          return newVal.toString();
        })
        console.log(video_ids);

        var table = document.getElementById('table');
        for (var i = 0, row; row = table.rows[i]; i++) {
          for (var j = 0, col; col = row.cells[j]; j++) {
            var videoTag = col.childNodes[0];
            if (typeof(videoTag.innerHTML) == 'string') {
              var vid = (videoTag.innerHTML).split(' ')[1];
              // console.log(vid);
              if (contains(video_ids, vid)) {
                col.innerHTML += '<br>Finished';
              } else {
                console.log('Not Found!');
              }
            }
          }
        }
      }

      function contains(a, obj) {
        var i = a.length;
        while (i--) {
          if (a[i] === obj) {
            return true;
          }
        }
        return false;
      }
    </script>
  </head>
  <body onload=updateVideoStatus()>
    <div class='header'>
      <img src='../bg.jpg'>
      <h1>Healthcare</h1>
    </div>
    <div class='main'>
      <!-- <p id='info'>Completed Videos: <br> <?php foreach($video_id as $id) { echo "$id <br>"; } ?>Offset: 1</p> -->
      <table align='center' id='table'>

              <tr>
                  <th>Station 10.233.219.150:</th>
            <td><a id='0' href='http://10.234.26.35/?id=1&hitId=offline'>video 0 </a></td>
          <td><a id='1' href='http://10.234.26.35/?id=2&hitId=offline'>video 1 </a></td>
          <td><a id='2' href='http://10.234.26.35/?id=3&hitId=offline'>video 2 </a></td>
          <td><a id='3' href='http://10.234.26.35/?id=4&hitId=offline'>video 3 </a></td>
          <td><a id='4' href='http://10.234.26.35/?id=5&hitId=offline'>video 4 </a></td>
          <td><a id='5' href='http://10.234.26.35/?id=6&hitId=offline'>video 5 </a></td>
          <td><a id='6' href='http://10.234.26.35/?id=7&hitId=offline'>video 6 </a></td>
          <td><a id='7' href='http://10.234.26.35/?id=8&hitId=offline'>video 7 </a></td>
          <td><a id='8' href='http://10.234.26.35/?id=9&hitId=offline'>video 8 </a></td>
          <td><a id='9' href='http://10.234.26.35/?id=10&hitId=offline'>video 9 </a></td>

              <tr>
                  <th>Station 10.233.219.150:</th>
            <td><a id='10' href='http://10.234.26.35/?id=11&hitId=offline'>video 10 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='11' href='http://10.234.26.35/?id=12&hitId=offline'>video 11 </a></td>
          <td><a id='12' href='http://10.234.26.35/?id=13&hitId=offline'>video 12 </a></td>
          <td><a id='13' href='http://10.234.26.35/?id=14&hitId=offline'>video 13 </a></td>
          <td><a id='14' href='http://10.234.26.35/?id=15&hitId=offline'>video 14 </a></td>
          <td><a id='15' href='http://10.234.26.35/?id=16&hitId=offline'>video 15 </a></td>
          <td><a id='16' href='http://10.234.26.35/?id=17&hitId=offline'>video 16 </a></td>
          <td><a id='17' href='http://10.234.26.35/?id=18&hitId=offline'>video 17 </a></td>
          <td><a id='18' href='http://10.234.26.35/?id=19&hitId=offline'>video 18 </a></td>
          <td><a id='19' href='http://10.234.26.35/?id=20&hitId=offline'>video 19 </a></td>
          <td><a id='20' href='http://10.234.26.35/?id=21&hitId=offline'>video 20 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='21' href='http://10.234.26.35/?id=22&hitId=offline'>video 21 </a></td>
          <td><a id='22' href='http://10.234.26.35/?id=23&hitId=offline'>video 22 </a></td>
          <td><a id='23' href='http://10.234.26.35/?id=24&hitId=offline'>video 23 </a></td>
          <td><a id='24' href='http://10.234.26.35/?id=25&hitId=offline'>video 24 </a></td>
          <td><a id='25' href='http://10.234.26.35/?id=26&hitId=offline'>video 25 </a></td>
          <td><a id='26' href='http://10.234.26.35/?id=27&hitId=offline'>video 26 </a></td>
          <td><a id='27' href='http://10.234.26.35/?id=28&hitId=offline'>video 27 </a></td>
          <td><a id='28' href='http://10.234.26.35/?id=29&hitId=offline'>video 28 </a></td>
          <td><a id='29' href='http://10.234.26.35/?id=30&hitId=offline'>video 29 </a></td>
          <td><a id='30' href='http://10.234.26.35/?id=31&hitId=offline'>video 30 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='31' href='http://10.234.26.35/?id=32&hitId=offline'>video 31 </a></td>
          <td><a id='32' href='http://10.234.26.35/?id=33&hitId=offline'>video 32 </a></td>
          <td><a id='33' href='http://10.234.26.35/?id=34&hitId=offline'>video 33 </a></td>
          <td><a id='34' href='http://10.234.26.35/?id=35&hitId=offline'>video 34 </a></td>
          <td><a id='35' href='http://10.234.26.35/?id=36&hitId=offline'>video 35 </a></td>
          <td><a id='36' href='http://10.234.26.35/?id=37&hitId=offline'>video 36 </a></td>
          <td><a id='37' href='http://10.234.26.35/?id=38&hitId=offline'>video 37 </a></td>
          <td><a id='38' href='http://10.234.26.35/?id=39&hitId=offline'>video 38 </a></td>
          <td><a id='39' href='http://10.234.26.35/?id=40&hitId=offline'>video 39 </a></td>
          <td><a id='40' href='http://10.234.26.35/?id=41&hitId=offline'>video 40 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='41' href='http://10.234.26.35/?id=42&hitId=offline'>video 41 </a></td>
          <td><a id='42' href='http://10.234.26.35/?id=43&hitId=offline'>video 42 </a></td>

              <tr>
                  <th>Station 10.233.219.169:</th>
            <td><a id='43' href='http://10.234.26.35/?id=44&hitId=offline'>video 43 </a></td>
          <td><a id='44' href='http://10.234.26.35/?id=45&hitId=offline'>video 44 </a></td>
          <td><a id='45' href='http://10.234.26.35/?id=46&hitId=offline'>video 45 </a></td>
          <td><a id='46' href='http://10.234.26.35/?id=47&hitId=offline'>video 46 </a></td>
          <td><a id='47' href='http://10.234.26.35/?id=48&hitId=offline'>video 47 </a></td>
          <td><a id='48' href='http://10.234.26.35/?id=49&hitId=offline'>video 48 </a></td>
          <td><a id='49' href='http://10.234.26.35/?id=50&hitId=offline'>video 49 </a></td>
          <td><a id='50' href='http://10.234.26.35/?id=51&hitId=offline'>video 50 </a></td>
          <td><a id='51' href='http://10.234.26.35/?id=52&hitId=offline'>video 51 </a></td>

              <tr>
                  <th>Station 10.233.219.178:</th>
            <td><a id='52' href='http://10.234.26.35/?id=53&hitId=offline'>video 52 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='53' href='http://10.234.26.35/?id=54&hitId=offline'>video 53 </a></td>
          <td><a id='54' href='http://10.234.26.35/?id=55&hitId=offline'>video 54 </a></td>
          <td><a id='55' href='http://10.234.26.35/?id=56&hitId=offline'>video 55 </a></td>
          <td><a id='56' href='http://10.234.26.35/?id=57&hitId=offline'>video 56 </a></td>
          <td><a id='57' href='http://10.234.26.35/?id=58&hitId=offline'>video 57 </a></td>
          <td><a id='58' href='http://10.234.26.35/?id=59&hitId=offline'>video 58 </a></td>
          <td><a id='59' href='http://10.234.26.35/?id=60&hitId=offline'>video 59 </a></td>
          <td><a id='60' href='http://10.234.26.35/?id=61&hitId=offline'>video 60 </a></td>
          <td><a id='61' href='http://10.234.26.35/?id=62&hitId=offline'>video 61 </a></td>
          <td><a id='62' href='http://10.234.26.35/?id=63&hitId=offline'>video 62 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='63' href='http://10.234.26.35/?id=64&hitId=offline'>video 63 </a></td>
          <td><a id='64' href='http://10.234.26.35/?id=65&hitId=offline'>video 64 </a></td>
          <td><a id='65' href='http://10.234.26.35/?id=66&hitId=offline'>video 65 </a></td>
          <td><a id='66' href='http://10.234.26.35/?id=67&hitId=offline'>video 66 </a></td>
          <td><a id='67' href='http://10.234.26.35/?id=68&hitId=offline'>video 67 </a></td>
          <td><a id='68' href='http://10.234.26.35/?id=69&hitId=offline'>video 68 </a></td>
          <td><a id='69' href='http://10.234.26.35/?id=70&hitId=offline'>video 69 </a></td>
          <td><a id='70' href='http://10.234.26.35/?id=71&hitId=offline'>video 70 </a></td>
          <td><a id='71' href='http://10.234.26.35/?id=72&hitId=offline'>video 71 </a></td>
          <td><a id='72' href='http://10.234.26.35/?id=73&hitId=offline'>video 72 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='73' href='http://10.234.26.35/?id=74&hitId=offline'>video 73 </a></td>
          <td><a id='74' href='http://10.234.26.35/?id=75&hitId=offline'>video 74 </a></td>
          <td><a id='75' href='http://10.234.26.35/?id=76&hitId=offline'>video 75 </a></td>
          <td><a id='76' href='http://10.234.26.35/?id=77&hitId=offline'>video 76 </a></td>
          <td><a id='77' href='http://10.234.26.35/?id=78&hitId=offline'>video 77 </a></td>
          <td><a id='78' href='http://10.234.26.35/?id=79&hitId=offline'>video 78 </a></td>
          <td><a id='79' href='http://10.234.26.35/?id=80&hitId=offline'>video 79 </a></td>
          <td><a id='80' href='http://10.234.26.35/?id=81&hitId=offline'>video 80 </a></td>
          <td><a id='81' href='http://10.234.26.35/?id=82&hitId=offline'>video 81 </a></td>
          <td><a id='82' href='http://10.234.26.35/?id=83&hitId=offline'>video 82 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='83' href='http://10.234.26.35/?id=84&hitId=offline'>video 83 </a></td>

              <tr>
                  <th>Station 10.233.219.197:</th>
            <td><a id='84' href='http://10.234.26.35/?id=100&hitId=offline'>video 84 </a></td>
          <td><a id='85' href='http://10.234.26.35/?id=101&hitId=offline'>video 85 </a></td>
          <td><a id='86' href='http://10.234.26.35/?id=102&hitId=offline'>video 86 </a></td>
          <td><a id='87' href='http://10.234.26.35/?id=103&hitId=offline'>video 87 </a></td>
          <td><a id='88' href='http://10.234.26.35/?id=104&hitId=offline'>video 88 </a></td>
          <td><a id='89' href='http://10.234.26.35/?id=105&hitId=offline'>video 89 </a></td>
          <td><a id='90' href='http://10.234.26.35/?id=85&hitId=offline'>video 90 </a></td>
          <td><a id='91' href='http://10.234.26.35/?id=86&hitId=offline'>video 91 </a></td>
          <td><a id='92' href='http://10.234.26.35/?id=87&hitId=offline'>video 92 </a></td>
          <td><a id='93' href='http://10.234.26.35/?id=88&hitId=offline'>video 93 </a></td>

              <tr>
                  <th>Station 10.233.219.197:</th>
            <td><a id='94' href='http://10.234.26.35/?id=89&hitId=offline'>video 94 </a></td>
          <td><a id='95' href='http://10.234.26.35/?id=90&hitId=offline'>video 95 </a></td>
          <td><a id='96' href='http://10.234.26.35/?id=91&hitId=offline'>video 96 </a></td>
          <td><a id='97' href='http://10.234.26.35/?id=92&hitId=offline'>video 97 </a></td>
          <td><a id='98' href='http://10.234.26.35/?id=93&hitId=offline'>video 98 </a></td>
          <td><a id='99' href='http://10.234.26.35/?id=94&hitId=offline'>video 99 </a></td>
          <td><a id='100' href='http://10.234.26.35/?id=95&hitId=offline'>video 100 </a></td>
          <td><a id='101' href='http://10.234.26.35/?id=96&hitId=offline'>video 101 </a></td>
          <td><a id='102' href='http://10.234.26.35/?id=97&hitId=offline'>video 102 </a></td>
          <td><a id='103' href='http://10.234.26.35/?id=98&hitId=offline'>video 103 </a></td>

              <tr>
                  <th>Station 10.233.219.197:</th>
            <td><a id='104' href='http://10.234.26.35/?id=99&hitId=offline'>video 104 </a></td>
          </table>
    </div>
  </body>
</html>
