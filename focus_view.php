<?php
$markers = array();
foreach ($tweets as $tweet) {
	if(isTweet($tweet)){
		if(geoEnabled($tweet)){
			$tweet_lat = $tweet['geo']['coordinates']['0'];
			$tweet_long = $tweet['geo']['coordinates']['1'];
			$marker = array(
				'lat' =>$tweet_lat,
				'long' => $tweet_long,
				'text' => $tweet['text'],
				'user' => $tweet['user']['screen_name'],
				'date' => $tweet['created_at'],
			);
			array_push($markers, $marker);
		}
	}
}
	include('javascript.php');

?>
<html>
	<head>
		<title>Projet BDD ISEP 2014 - résultats</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>


		<h1>#<?php echo $hashtag;?></h1>

		<div id="content-wrapper">
			<div id="map-canvas">
			</div>
			<div id="best-tweets">
				<section class="rank_section">
					<h3>Les plus Retweetés</h3>
					<table class="rank_tweet">
					<?php
					$best_rt = get_best_rt($hashtag);
					
					foreach($best_rt as $elem){
					?>
					<tr>
						<td>

						<span class="best-line">
								<span class="best-tweet-nb"><?php echo $elem['nb_rt'];?></span> by <a href="http://twitter.com/<?php echo $elem['name'];?>" class="best-tweet-name"><?php echo $elem['name'];?></a>
									<br />
									<span class="best-tweet-date"><?php echo $elem['date'];?></span>
								<p class="best-tweet-text"> <img class="best-tweet-pp" src="<?php echo $elem['pp_image'];?>"/> <?php echo $elem['text'];?></p>
						</span>

					<?php } ?>
						</td>
					</tr>
					</table>
				</section>
				<section class="rank_section">
					<h3>Les plus favoris</h3>
					<table class="rank_tweet">

					<?php
					$best_rt = get_best_favo($hashtag);
					foreach($best_rt as $elem){
					?>
					<tr>
						<td>
							<span class="best-line">
									<span class="best-tweet-nb"><?php echo $elem['nb_fav'];?></span> by <a href="http://twitter.com/<?php echo $elem['name'];?>" class="best-tweet-name"><?php echo $elem['name'];?></a>
									<br />
									<span class="best-tweet-date"><?php echo $elem['date'];?></span>
									<p class="best-tweet-text"> <img class="best-tweet-pp" src="<?php echo $elem['pp_image'];?>"/> <?php echo $elem['text'];?></p>
							</span>
					<?php } ?>
						</td>
					</tr>
				</section>
			</div>
		</div>
	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNybVSoDz8pPpfhvZmb-ZUYk6sxy2FwjM&sensor=FALSE"></script>
	<script src="gmaps_script.js" type="text/javascript"></script>
	</body>
</html>
