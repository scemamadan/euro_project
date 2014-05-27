<html>
	<head>
		<title>Projet BDD ISEP 2014 - résultats</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>


		<h1>Etude sur <?php echo $hashtag." - ".$focus_id; ?></h1>

		<div id="content-wrapper">
			<div id="map-canvas">

			</div>
		</div>
	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNybVSoDz8pPpfhvZmb-ZUYk6sxy2FwjM&sensor=FALSE"></script>
	<script src="gmaps_script.js" type="text/javascript"></script>
	</body>
</html>
<hr/>
<?php
	foreach ($tweets as $tweet) {

	if(isTweet($tweet)){
		echo $tweet['id']."-".$tweet['created_at']."]". $tweet['text']."<br /><br />";
	}
}
?>