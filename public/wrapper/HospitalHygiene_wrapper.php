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
      <!-- <p id='info'>Completed Videos: <br> <?php foreach($video_id as $id) { echo "$id <br>"; } ?>Offset: 4536</p> -->
      <table align='center' id='table'>
        
              <tr>
                  <th>Station 02:</th>
            <td><a id='0' href='http://navi.stanford.edu/?id=4536&hitId=offline'>video 0 </a></td>
          <td><a id='1' href='http://navi.stanford.edu/?id=4537&hitId=offline'>video 1 </a></td>
          <td><a id='2' href='http://navi.stanford.edu/?id=4538&hitId=offline'>video 2 </a></td>
          <td><a id='3' href='http://navi.stanford.edu/?id=4539&hitId=offline'>video 3 </a></td>
          <td><a id='4' href='http://navi.stanford.edu/?id=4540&hitId=offline'>video 4 </a></td>
          <td><a id='5' href='http://navi.stanford.edu/?id=4541&hitId=offline'>video 5 </a></td>
          <td><a id='6' href='http://navi.stanford.edu/?id=4542&hitId=offline'>video 6 </a></td>
          <td><a id='7' href='http://navi.stanford.edu/?id=4543&hitId=offline'>video 7 </a></td>
          <td><a id='8' href='http://navi.stanford.edu/?id=4544&hitId=offline'>video 8 </a></td>
          <td><a id='9' href='http://navi.stanford.edu/?id=4545&hitId=offline'>video 9 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='10' href='http://navi.stanford.edu/?id=4546&hitId=offline'>video 10 </a></td>
          <td><a id='11' href='http://navi.stanford.edu/?id=4547&hitId=offline'>video 11 </a></td>
          <td><a id='12' href='http://navi.stanford.edu/?id=4548&hitId=offline'>video 12 </a></td>
          <td><a id='13' href='http://navi.stanford.edu/?id=4549&hitId=offline'>video 13 </a></td>
          <td><a id='14' href='http://navi.stanford.edu/?id=4550&hitId=offline'>video 14 </a></td>
          <td><a id='15' href='http://navi.stanford.edu/?id=4551&hitId=offline'>video 15 </a></td>
          <td><a id='16' href='http://navi.stanford.edu/?id=4552&hitId=offline'>video 16 </a></td>
          <td><a id='17' href='http://navi.stanford.edu/?id=4553&hitId=offline'>video 17 </a></td>
          <td><a id='18' href='http://navi.stanford.edu/?id=4554&hitId=offline'>video 18 </a></td>
          <td><a id='19' href='http://navi.stanford.edu/?id=4555&hitId=offline'>video 19 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='20' href='http://navi.stanford.edu/?id=4556&hitId=offline'>video 20 </a></td>
          <td><a id='21' href='http://navi.stanford.edu/?id=4557&hitId=offline'>video 21 </a></td>
          <td><a id='22' href='http://navi.stanford.edu/?id=4558&hitId=offline'>video 22 </a></td>
          <td><a id='23' href='http://navi.stanford.edu/?id=4559&hitId=offline'>video 23 </a></td>
          <td><a id='24' href='http://navi.stanford.edu/?id=4560&hitId=offline'>video 24 </a></td>
          <td><a id='25' href='http://navi.stanford.edu/?id=4561&hitId=offline'>video 25 </a></td>
          <td><a id='26' href='http://navi.stanford.edu/?id=4562&hitId=offline'>video 26 </a></td>
          <td><a id='27' href='http://navi.stanford.edu/?id=4563&hitId=offline'>video 27 </a></td>
          <td><a id='28' href='http://navi.stanford.edu/?id=4564&hitId=offline'>video 28 </a></td>
          <td><a id='29' href='http://navi.stanford.edu/?id=4565&hitId=offline'>video 29 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='30' href='http://navi.stanford.edu/?id=4566&hitId=offline'>video 30 </a></td>
          <td><a id='31' href='http://navi.stanford.edu/?id=4567&hitId=offline'>video 31 </a></td>
          <td><a id='32' href='http://navi.stanford.edu/?id=4568&hitId=offline'>video 32 </a></td>
          <td><a id='33' href='http://navi.stanford.edu/?id=4569&hitId=offline'>video 33 </a></td>
          <td><a id='34' href='http://navi.stanford.edu/?id=4570&hitId=offline'>video 34 </a></td>
          <td><a id='35' href='http://navi.stanford.edu/?id=4571&hitId=offline'>video 35 </a></td>
          <td><a id='36' href='http://navi.stanford.edu/?id=4572&hitId=offline'>video 36 </a></td>
          <td><a id='37' href='http://navi.stanford.edu/?id=4573&hitId=offline'>video 37 </a></td>
          <td><a id='38' href='http://navi.stanford.edu/?id=4574&hitId=offline'>video 38 </a></td>
          <td><a id='39' href='http://navi.stanford.edu/?id=4575&hitId=offline'>video 39 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='40' href='http://navi.stanford.edu/?id=4576&hitId=offline'>video 40 </a></td>
          <td><a id='41' href='http://navi.stanford.edu/?id=4577&hitId=offline'>video 41 </a></td>
          <td><a id='42' href='http://navi.stanford.edu/?id=4578&hitId=offline'>video 42 </a></td>
          <td><a id='43' href='http://navi.stanford.edu/?id=4579&hitId=offline'>video 43 </a></td>
          <td><a id='44' href='http://navi.stanford.edu/?id=4580&hitId=offline'>video 44 </a></td>
          <td><a id='45' href='http://navi.stanford.edu/?id=4581&hitId=offline'>video 45 </a></td>
          <td><a id='46' href='http://navi.stanford.edu/?id=4582&hitId=offline'>video 46 </a></td>
          <td><a id='47' href='http://navi.stanford.edu/?id=4583&hitId=offline'>video 47 </a></td>
          <td><a id='48' href='http://navi.stanford.edu/?id=4584&hitId=offline'>video 48 </a></td>
          <td><a id='49' href='http://navi.stanford.edu/?id=4585&hitId=offline'>video 49 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='50' href='http://navi.stanford.edu/?id=4586&hitId=offline'>video 50 </a></td>
          <td><a id='51' href='http://navi.stanford.edu/?id=4587&hitId=offline'>video 51 </a></td>
          <td><a id='52' href='http://navi.stanford.edu/?id=4588&hitId=offline'>video 52 </a></td>
          <td><a id='53' href='http://navi.stanford.edu/?id=4589&hitId=offline'>video 53 </a></td>
          <td><a id='54' href='http://navi.stanford.edu/?id=4590&hitId=offline'>video 54 </a></td>
          <td><a id='55' href='http://navi.stanford.edu/?id=4591&hitId=offline'>video 55 </a></td>
          <td><a id='56' href='http://navi.stanford.edu/?id=4592&hitId=offline'>video 56 </a></td>
          <td><a id='57' href='http://navi.stanford.edu/?id=4593&hitId=offline'>video 57 </a></td>
          <td><a id='58' href='http://navi.stanford.edu/?id=4594&hitId=offline'>video 58 </a></td>
          <td><a id='59' href='http://navi.stanford.edu/?id=4595&hitId=offline'>video 59 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='60' href='http://navi.stanford.edu/?id=4596&hitId=offline'>video 60 </a></td>
          <td><a id='61' href='http://navi.stanford.edu/?id=4597&hitId=offline'>video 61 </a></td>
          <td><a id='62' href='http://navi.stanford.edu/?id=4598&hitId=offline'>video 62 </a></td>
          <td><a id='63' href='http://navi.stanford.edu/?id=4599&hitId=offline'>video 63 </a></td>
          <td><a id='64' href='http://navi.stanford.edu/?id=4600&hitId=offline'>video 64 </a></td>
          <td><a id='65' href='http://navi.stanford.edu/?id=4601&hitId=offline'>video 65 </a></td>
          <td><a id='66' href='http://navi.stanford.edu/?id=4602&hitId=offline'>video 66 </a></td>
          <td><a id='67' href='http://navi.stanford.edu/?id=4603&hitId=offline'>video 67 </a></td>
          <td><a id='68' href='http://navi.stanford.edu/?id=4604&hitId=offline'>video 68 </a></td>
          <td><a id='69' href='http://navi.stanford.edu/?id=4605&hitId=offline'>video 69 </a></td>
          
              <tr>
                  <th>Station 02:</th>
            <td><a id='70' href='http://navi.stanford.edu/?id=4606&hitId=offline'>video 70 </a></td>
          <td><a id='71' href='http://navi.stanford.edu/?id=4607&hitId=offline'>video 71 </a></td>
          <td><a id='72' href='http://navi.stanford.edu/?id=4608&hitId=offline'>video 72 </a></td>
          <td><a id='73' href='http://navi.stanford.edu/?id=4609&hitId=offline'>video 73 </a></td>
          <td><a id='74' href='http://navi.stanford.edu/?id=4610&hitId=offline'>video 74 </a></td>
          <td><a id='75' href='http://navi.stanford.edu/?id=4611&hitId=offline'>video 75 </a></td>
          <td><a id='76' href='http://navi.stanford.edu/?id=4612&hitId=offline'>video 76 </a></td>
          <td><a id='77' href='http://navi.stanford.edu/?id=4613&hitId=offline'>video 77 </a></td>
          <td><a id='78' href='http://navi.stanford.edu/?id=4614&hitId=offline'>video 78 </a></td>
          <td><a id='79' href='http://navi.stanford.edu/?id=4615&hitId=offline'>video 79 </a></td>
          </table>
    </div>
  </body>
</html>