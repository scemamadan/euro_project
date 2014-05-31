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
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
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
					</table>
				</section>
			</div>
		</div>
		
		<div class="">
			<section class="rank_section">
			<div id="donut-example" style="height: 250px;"></div>
			<?php $country = getCountryStat($hashtag);?> 
			</section>
		</div>

<script>
	var data1 =<?php echo json_encode($country);?>;
    var dataTograph = [];
  
  for (var key in data1){
  	var x = ((data1[key]/data1["total"])*100).toFixed(2);
  	if(key != "total"){
  	dataTograph.push({label:key, value: x});  	
  	}
}
	Morris.Donut({
	  element: 'donut-example',
	  data: dataTograph
	
	});
</script>
	
	<div>
		<section class="rank_section">
		<div id="myfirstchart" style="height: 250px;"></div>
		<?php $dataFlow = getDataFlow($hashtag);?> 	
		</section>
	</div>


<script>
	var data1 =<?php echo json_encode($dataFlow);?>;
  var anElement = {}; 
  var dataTograph = [];
  
  for (var key in data1){
  	dataTograph.push({period:key,value:data1[key]});  	
}
	
	// sort by date min to max correctly
	dataTograph.sort(function(a,b){
	var c = new Date(a.period);
	var d = new Date(b.period);
	return c-d;
	});
	

new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',

  data: dataTograph,


  // The name of the data record attribute that contains x-values.
  xkey: 'period',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value'], 
  barColors: function (row, series, type) {
    if (type === 'bar') {
      var red = Math.ceil(255 * row.y / this.ymax);
      return 'rgb(' + red + ',0,0)';
    }
    else {
      return '#000';
    }
  }
});
</script>
	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNybVSoDz8pPpfhvZmb-ZUYk6sxy2FwjM&sensor=FALSE"></script>
	<script src="gmaps_script.js" type="text/javascript"></script>
	</body>
</html>
