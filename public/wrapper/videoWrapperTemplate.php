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
        var offset = 4536;
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
      <!-- <p id='info'>Completed Videos: <br> <?php foreach($video_id as $id) { echo "$id <br>"; } ?>Offset: {{ offset }}</p> -->
      <table align='center' id='table'>
        {% for video in vidSets -%}
          {% set station = video['station'] -%}
          {% set ids = video['ids'] -%}
          {% set hits = video['hits'] -%}
          {% set threshold = 10 -%}
          {% for id in ids -%}
            {% if (loop.index-1) % 10 == 0 %}
              <tr>
                  <th>Station {{ station }}:</th>
            {% endif -%}
            {% set url = '%s' % hits[loop.index-1] -%}
            <td><a id='{{ id }}' href='{{ url }}'>video {{ id }} </a></td>
          {% endfor -%}
        {% endfor -%}
      </table>
    </div>
  </body>
</html>
