<?php
  include('../access/access.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Video</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
    <script type="text/javascript">
      $(window).unload( function(){
        $.ajax({
          type: 'POST',
          url: '../access/access_server.php',
          async: false,
          data: {page_id:'11'} // IMPORTANT: page_id must match the id specified in hits.html
        });
      });
    </script>
  </head>
  <body>
  <div class='main'>
    <h2>IMPORTANT:</h2>
    <p>Please do not close this page until you finish annotating the video!</p><br>
    <a href='http://navi.stanford.edu/?id=2900&hitId=offline' target='_blank'>Go to video</a>
  </div>
  </body>
</html>