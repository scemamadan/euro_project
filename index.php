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
				<br /><img id="loader-gif" style="width:50px;display:none;" src='http://erlen.co.uk/wp-content/uploads/2013/04/Erlens-Animated-Twitter-Birl.gif'/>
				<hr />
			</form>
		</div>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script>
			function showLoader(){
				if($('#search-bar').val() !== ''){ // si l'input n'est pas vide

					$('#tweet-form').one('submit', function() { // on empeche de valider 2 fois pendant le traitement
					    $(this).find('input[type="submit"]').attr('disabled','disabled');
					});
					$("#loader-gif").show(); // on montre le loader
					loop();
				}
			
			}
			function loop() { // on repete le mouvement horizontal
			    $('#loader-gif').animate({'left': '150'}, {
			        duration: 3000, 
			        complete: function() {
			            $('#loader-gif').animate({left: -150}, {
			                duration: 3000, 
			                complete: loop});
			        }});
			}



		</script>
	</body>
</html>
