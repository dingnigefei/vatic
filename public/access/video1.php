<?php
  include('access.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Video</title>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
    <script type="text/javascript">
      $(window).unload( function(){
        $.ajax({
          type: 'POST',
          url: 'access_server.php',
          async: false,
          data: {page_id:'hits_video1'} // IMPORTANT: page_id must match the id specified in hits.html
        });
      });
      
      function leave() {
        $.ajax({
          type: 'POST',
          url: 'access_server.php',
          async: false,
          data: {page_id:'hits_video1'},
          success: function(response){alert(response);}
        });
      }
    </script>
  </head>

  <body>
    <h1>Welcome to this video!</h1>
    <a href="http://navi.stanford.edu/hits.html">Go back to previous page</a>
  </body>
</html>
