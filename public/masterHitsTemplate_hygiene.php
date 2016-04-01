<?php
 	include('./login/session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hits</title>
	<link rel="stylesheet" type="text/css" href="/css/stylesheet.css">
</head>
<body>
	<div class='header'>
		<img src='bg.jpg'>
		<h1>Healthcare</h1>
	</div>
	<div class='main'>
		<h2>Available Hits</h2>
		{% for labelName in labelNames -%}
		<a href='http://navi.stanford.edu/wrapper/{{ labelName }}_wrapper.html'>{{ labelName }}</a><br>
		{% endfor -%}
	</div>
</body>
</html>
