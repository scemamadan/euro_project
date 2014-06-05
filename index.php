<?php 
include('focus_model.php'); // inclusion du modele comprenant les methodes php
?>
<html>
	<head>
		<title>Projet BDD ISEP 2014</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1>Demox</h1>
		<div id="content-wrapper">
			<form id="tweet-form" action="focus.php" method="GET">

				<input class="btn" id="search-bar" type="text" placeholder="Saisissez le hashtag" name="hashtag_name" required />
				<input id="submit-btn" class="btn submit" type="submit" onclick='showLoader();' />
				<br /><img id="loader-gif" src='img/loader.gif'/>
				<p id="loading-text" style="display:none;">Loading...</p>
				<hr />
			</form>
				<table class="best-hashtags">
					<thead>
					  <tr>
					     <th>LE TOP 5 DES HASHTAGS</th>
					  </tr>
					 </thead>
					<?php
					$top_hashtags = get_top_hashtags();
					for($i = 0 ; $i <5 ; $i++){					
					?>
					<tr>
						<td>
						<span class="best-line">
							<span><span class="hashtag-name">#<?php echo $top_hashtags[$i][1];?></span> : <?php echo $top_hashtags[$i][0]; ?> fois</span>
						</span>
					<?php } ?>
						</td>
					</tr>
				</table>
		</div>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="jQueryRotateCompressed.js"></script>
		<script>
			function showLoader(){
				if($('#search-bar').val() !== ''){ // si l'input n'est pas vide

					$('#tweet-form').one('submit', function() { // on empeche de valider 2 fois pendant le traitement
					    $(this).find('input[type="submit"]').attr('disabled','disabled');
					});
					$("#loader-gif").show(); // on montre le loader
					$("#loading-text").show();
					loop();
				}
			
			}
			function loop() { // on repete le mouvement horizontal
				$("#loading-text").fadeOut(3500);
			    $('#loader-gif').animate({'left': '150'}, {
			        duration: 3000, 
			        complete: function() {
			        	$("#loader-gif").rotate({
				            duration:200,
				            angle: 0, 
				            animateTo:45,
				            callback: function(){
				            	$("#loading-text").fadeIn(0);
				            	$("#loader-gif").rotate({
				            	duration:400,
				            	angle: 0, 
				            	animateTo:0
				            });
				           	}
         				 });
			            $('#loader-gif').animate({left: -150}, {
			                duration: 3000, 
			                complete: loop});
			        }});
			}
		</script>
	</body>
</html>
