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
        {% for video in vidSets -%}
	  {% set date = video['date'] -%}
          {% set names = video['names'] -%}
          {% set ids = video['ids'] -%}
          {% set hits = video['hits'] -%}
	  <tr>
	    {% if date == 17 -%}
	      <th>Oct 17th:</th>
	    {% elif date == 18 -%}
	      <th>Oct 18th:</th>
	    {% elif date == 19 -%}
	      <th>Oct 19th:</th>
	    {% else -%}
	      <th>Oct 20th:</th>
	    {% endif -%}
            {% for name in names -%}
              {% set id = '%d' % ids[loop.index-1] -%}
	      <!-- {% set url = 'http://navi.stanford.edu/wrapper/' ~ name ~ '.php?page_id=' ~ id -%} -->
              {% set url = '%s' % hits[loop.index-1] -%}
	      <td><a id='{{ id }}' href='{{ url }}'>video {{ vidType }} {{ loop.index }}</a></td>
	    {% endfor -%}
      	  </tr>
	{% endfor -%}
      </table>
    </div>
  </body>
</html>
