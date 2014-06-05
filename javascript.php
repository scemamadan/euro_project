<script>
function initialize() {
		  var mapOptions = {
		    zoom: 2,
		    scrollwheel: false,
		    center: new google.maps.LatLng(48.76632797237075, 2.3291015625)
		  };

		    var map = new google.maps.Map(document.getElementById('map-canvas'),
		      mapOptions);
	<?php 
	// pour chaque marker on l'ajoute sur la carte avec du javascript
	$i = 0;
	foreach ($markers as $marker) {
	?>

			var latitude = <?php echo $marker['lat']; ?>;
			var longitude = <?php echo $marker['long']; ?>;
			var user_name = <?php echo json_encode($marker['user']);?>;
			var text_tweet = <?php echo json_encode($marker['text']);?>;
			var tweet_date = <?php echo json_encode($marker['date']); ?>

			var contentString = '<div class="tweet-content"><h1>'+user_name+'</h1><br /><i>'+tweet_date+'</i><p>'+text_tweet+'</p></div>';

			var infowindow<?php echo $i;?> = new google.maps.InfoWindow({
			      content: contentString,
			  });

			marker<?php echo $i;?> = new google.maps.Marker({
			    position: new google.maps.LatLng(latitude, longitude),
			    map: map,
			    title: user_name,
			 });
			 google.maps.event.addListener(marker<?php echo $i;?>, 'click', function() {
			    infowindow<?php echo $i;?>.open(map,marker<?php echo $i;?>);
			 });

	<?php
	$i++;
	} ?>
}
</script>