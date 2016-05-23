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
        var offset = 211;
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
      <!-- <p id='info'>Completed Videos: <br> <?php foreach($video_id as $id) { echo "$id <br>"; } ?>Offset: 211</p> -->
      <table align='center' id='table'>

              <tr>
                  <th>Station 10.233.219.150:</th>
            <td><a id='0' href='http://10.234.26.35/?id=211&hitId=offline'>video 0 </a></td>
          <td><a id='1' href='http://10.234.26.35/?id=212&hitId=offline'>video 1 </a></td>
          <td><a id='2' href='http://10.234.26.35/?id=213&hitId=offline'>video 2 </a></td>
          <td><a id='3' href='http://10.234.26.35/?id=214&hitId=offline'>video 3 </a></td>
          <td><a id='4' href='http://10.234.26.35/?id=215&hitId=offline'>video 4 </a></td>
          <td><a id='5' href='http://10.234.26.35/?id=216&hitId=offline'>video 5 </a></td>
          <td><a id='6' href='http://10.234.26.35/?id=217&hitId=offline'>video 6 </a></td>
          <td><a id='7' href='http://10.234.26.35/?id=218&hitId=offline'>video 7 </a></td>
          <td><a id='8' href='http://10.234.26.35/?id=219&hitId=offline'>video 8 </a></td>
          <td><a id='9' href='http://10.234.26.35/?id=220&hitId=offline'>video 9 </a></td>

              <tr>
                  <th>Station 10.233.219.150:</th>
            <td><a id='10' href='http://10.234.26.35/?id=221&hitId=offline'>video 10 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='11' href='http://10.234.26.35/?id=222&hitId=offline'>video 11 </a></td>
          <td><a id='12' href='http://10.234.26.35/?id=223&hitId=offline'>video 12 </a></td>
          <td><a id='13' href='http://10.234.26.35/?id=224&hitId=offline'>video 13 </a></td>
          <td><a id='14' href='http://10.234.26.35/?id=225&hitId=offline'>video 14 </a></td>
          <td><a id='15' href='http://10.234.26.35/?id=226&hitId=offline'>video 15 </a></td>
          <td><a id='16' href='http://10.234.26.35/?id=227&hitId=offline'>video 16 </a></td>
          <td><a id='17' href='http://10.234.26.35/?id=228&hitId=offline'>video 17 </a></td>
          <td><a id='18' href='http://10.234.26.35/?id=229&hitId=offline'>video 18 </a></td>
          <td><a id='19' href='http://10.234.26.35/?id=230&hitId=offline'>video 19 </a></td>
          <td><a id='20' href='http://10.234.26.35/?id=231&hitId=offline'>video 20 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='21' href='http://10.234.26.35/?id=232&hitId=offline'>video 21 </a></td>
          <td><a id='22' href='http://10.234.26.35/?id=233&hitId=offline'>video 22 </a></td>
          <td><a id='23' href='http://10.234.26.35/?id=234&hitId=offline'>video 23 </a></td>
          <td><a id='24' href='http://10.234.26.35/?id=235&hitId=offline'>video 24 </a></td>
          <td><a id='25' href='http://10.234.26.35/?id=236&hitId=offline'>video 25 </a></td>
          <td><a id='26' href='http://10.234.26.35/?id=237&hitId=offline'>video 26 </a></td>
          <td><a id='27' href='http://10.234.26.35/?id=238&hitId=offline'>video 27 </a></td>
          <td><a id='28' href='http://10.234.26.35/?id=239&hitId=offline'>video 28 </a></td>
          <td><a id='29' href='http://10.234.26.35/?id=240&hitId=offline'>video 29 </a></td>
          <td><a id='30' href='http://10.234.26.35/?id=241&hitId=offline'>video 30 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='31' href='http://10.234.26.35/?id=242&hitId=offline'>video 31 </a></td>
          <td><a id='32' href='http://10.234.26.35/?id=243&hitId=offline'>video 32 </a></td>
          <td><a id='33' href='http://10.234.26.35/?id=244&hitId=offline'>video 33 </a></td>
          <td><a id='34' href='http://10.234.26.35/?id=245&hitId=offline'>video 34 </a></td>
          <td><a id='35' href='http://10.234.26.35/?id=246&hitId=offline'>video 35 </a></td>
          <td><a id='36' href='http://10.234.26.35/?id=247&hitId=offline'>video 36 </a></td>
          <td><a id='37' href='http://10.234.26.35/?id=248&hitId=offline'>video 37 </a></td>
          <td><a id='38' href='http://10.234.26.35/?id=249&hitId=offline'>video 38 </a></td>
          <td><a id='39' href='http://10.234.26.35/?id=250&hitId=offline'>video 39 </a></td>
          <td><a id='40' href='http://10.234.26.35/?id=251&hitId=offline'>video 40 </a></td>

              <tr>
                  <th>Station 10.233.219.167:</th>
            <td><a id='41' href='http://10.234.26.35/?id=252&hitId=offline'>video 41 </a></td>
          <td><a id='42' href='http://10.234.26.35/?id=253&hitId=offline'>video 42 </a></td>

              <tr>
                  <th>Station 10.233.219.169:</th>
            <td><a id='43' href='http://10.234.26.35/?id=254&hitId=offline'>video 43 </a></td>
          <td><a id='44' href='http://10.234.26.35/?id=255&hitId=offline'>video 44 </a></td>
          <td><a id='45' href='http://10.234.26.35/?id=256&hitId=offline'>video 45 </a></td>
          <td><a id='46' href='http://10.234.26.35/?id=257&hitId=offline'>video 46 </a></td>
          <td><a id='47' href='http://10.234.26.35/?id=258&hitId=offline'>video 47 </a></td>
          <td><a id='48' href='http://10.234.26.35/?id=259&hitId=offline'>video 48 </a></td>
          <td><a id='49' href='http://10.234.26.35/?id=260&hitId=offline'>video 49 </a></td>
          <td><a id='50' href='http://10.234.26.35/?id=261&hitId=offline'>video 50 </a></td>
          <td><a id='51' href='http://10.234.26.35/?id=262&hitId=offline'>video 51 </a></td>

              <tr>
                  <th>Station 10.233.219.178:</th>
            <td><a id='52' href='http://10.234.26.35/?id=263&hitId=offline'>video 52 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='53' href='http://10.234.26.35/?id=264&hitId=offline'>video 53 </a></td>
          <td><a id='54' href='http://10.234.26.35/?id=265&hitId=offline'>video 54 </a></td>
          <td><a id='55' href='http://10.234.26.35/?id=266&hitId=offline'>video 55 </a></td>
          <td><a id='56' href='http://10.234.26.35/?id=267&hitId=offline'>video 56 </a></td>
          <td><a id='57' href='http://10.234.26.35/?id=268&hitId=offline'>video 57 </a></td>
          <td><a id='58' href='http://10.234.26.35/?id=269&hitId=offline'>video 58 </a></td>
          <td><a id='59' href='http://10.234.26.35/?id=270&hitId=offline'>video 59 </a></td>
          <td><a id='60' href='http://10.234.26.35/?id=271&hitId=offline'>video 60 </a></td>
          <td><a id='61' href='http://10.234.26.35/?id=272&hitId=offline'>video 61 </a></td>
          <td><a id='62' href='http://10.234.26.35/?id=273&hitId=offline'>video 62 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='63' href='http://10.234.26.35/?id=274&hitId=offline'>video 63 </a></td>
          <td><a id='64' href='http://10.234.26.35/?id=275&hitId=offline'>video 64 </a></td>
          <td><a id='65' href='http://10.234.26.35/?id=276&hitId=offline'>video 65 </a></td>
          <td><a id='66' href='http://10.234.26.35/?id=277&hitId=offline'>video 66 </a></td>
          <td><a id='67' href='http://10.234.26.35/?id=278&hitId=offline'>video 67 </a></td>
          <td><a id='68' href='http://10.234.26.35/?id=279&hitId=offline'>video 68 </a></td>
          <td><a id='69' href='http://10.234.26.35/?id=280&hitId=offline'>video 69 </a></td>
          <td><a id='70' href='http://10.234.26.35/?id=281&hitId=offline'>video 70 </a></td>
          <td><a id='71' href='http://10.234.26.35/?id=282&hitId=offline'>video 71 </a></td>
          <td><a id='72' href='http://10.234.26.35/?id=283&hitId=offline'>video 72 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='73' href='http://10.234.26.35/?id=284&hitId=offline'>video 73 </a></td>
          <td><a id='74' href='http://10.234.26.35/?id=285&hitId=offline'>video 74 </a></td>
          <td><a id='75' href='http://10.234.26.35/?id=286&hitId=offline'>video 75 </a></td>
          <td><a id='76' href='http://10.234.26.35/?id=287&hitId=offline'>video 76 </a></td>
          <td><a id='77' href='http://10.234.26.35/?id=288&hitId=offline'>video 77 </a></td>
          <td><a id='78' href='http://10.234.26.35/?id=289&hitId=offline'>video 78 </a></td>
          <td><a id='79' href='http://10.234.26.35/?id=290&hitId=offline'>video 79 </a></td>
          <td><a id='80' href='http://10.234.26.35/?id=291&hitId=offline'>video 80 </a></td>
          <td><a id='81' href='http://10.234.26.35/?id=292&hitId=offline'>video 81 </a></td>
          <td><a id='82' href='http://10.234.26.35/?id=293&hitId=offline'>video 82 </a></td>

              <tr>
                  <th>Station 10.233.219.194:</th>
            <td><a id='83' href='http://10.234.26.35/?id=294&hitId=offline'>video 83 </a></td>

              <tr>
                  <th>Station 10.233.219.197:</th>
            <td><a id='84' href='http://10.234.26.35/?id=295&hitId=offline'>video 84 </a></td>
          <td><a id='85' href='http://10.234.26.35/?id=296&hitId=offline'>video 85 </a></td>
          <td><a id='86' href='http://10.234.26.35/?id=297&hitId=offline'>video 86 </a></td>
          <td><a id='87' href='http://10.234.26.35/?id=298&hitId=offline'>video 87 </a></td>
          <td><a id='88' href='http://10.234.26.35/?id=299&hitId=offline'>video 88 </a></td>
          <td><a id='89' href='http://10.234.26.35/?id=300&hitId=offline'>video 89 </a></td>
          <td><a id='90' href='http://10.234.26.35/?id=301&hitId=offline'>video 90 </a></td>
          <td><a id='91' href='http://10.234.26.35/?id=302&hitId=offline'>video 91 </a></td>
          <td><a id='92' href='http://10.234.26.35/?id=303&hitId=offline'>video 92 </a></td>
          <td><a id='93' href='http://10.234.26.35/?id=304&hitId=offline'>video 93 </a></td>

              <tr>
                  <th>Station 10.233.219.197:</th>
            <td><a id='94' href='http://10.234.26.35/?id=305&hitId=offline'>video 94 </a></td>
          <td><a id='95' href='http://10.234.26.35/?id=306&hitId=offline'>video 95 </a></td>
          <td><a id='96' href='http://10.234.26.35/?id=307&hitId=offline'>video 96 </a></td>
          <td><a id='97' href='http://10.234.26.35/?id=308&hitId=offline'>video 97 </a></td>
          <td><a id='98' href='http://10.234.26.35/?id=309&hitId=offline'>video 98 </a></td>
          <td><a id='99' href='http://10.234.26.35/?id=310&hitId=offline'>video 99 </a></td>
          <td><a id='100' href='http://10.234.26.35/?id=311&hitId=offline'>video 100 </a></td>
          <td><a id='101' href='http://10.234.26.35/?id=312&hitId=offline'>video 101 </a></td>
          <td><a id='102' href='http://10.234.26.35/?id=313&hitId=offline'>video 102 </a></td>
          <td><a id='103' href='http://10.234.26.35/?id=314&hitId=offline'>video 103 </a></td>

              <tr>
                  <th>Station 10.233.219.197:</th>
            <td><a id='104' href='http://10.234.26.35/?id=315&hitId=offline'>video 104 </a></td>
          </table>
    </div>
  </body>
</html>
