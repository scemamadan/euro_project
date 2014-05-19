<?php
if(isset($_GET['focus'])){

	switch ($_GET['focus']) {
		case 'ump':
			require_once('TwitterAPIExchange.php');
			$settings = array(
			    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
			    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
			    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
			    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
			);

			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = '?q=%23UMPEurope2014&lang=fr';
			$requestMethod = 'GET';

			$twitter = new TwitterAPIExchange($settings);
			echo $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			break;
		case 'ps':
			require_once('TwitterAPIExchange.php');
			$settings = array(
			    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
			    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
			    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
			    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
			);

			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = '?q=%23NotreEurope&lang=fr';
			$requestMethod = 'GET';

			$twitter = new TwitterAPIExchange($settings);
			echo $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			break;
		case 'fn':
			require_once('TwitterAPIExchange.php');
			$settings = array(
			    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
			    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
			    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
			    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
			);

			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = '?q=%23fn&lang=fr';
			$requestMethod = 'GET';

			$twitter = new TwitterAPIExchange($settings);
			echo $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			break;
		case 'udi-modem':
			require_once('TwitterAPIExchange.php');
			$settings = array(
			    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
			    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
			    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
			    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
			);

			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = '?q=%23Leseuropeens&lang=fr';
			$requestMethod = 'GET';

			$twitter = new TwitterAPIExchange($settings);
			echo $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			break;
		case 'fdg':
			require_once('TwitterAPIExchange.php');
			$settings = array(
			    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
			    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
			    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
			    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
			);

			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = '?q=%23reseauFDG&lang=fr';
			$requestMethod = 'GET';

			$twitter = new TwitterAPIExchange($settings);
			echo $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			break;
		case 'eelv':
			require_once('TwitterAPIExchange.php');
			$settings = array(
			    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
			    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
			    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
			    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
			);

			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = '?q=%23EE2014&lang=fr';
			$requestMethod = 'GET';

			$twitter = new TwitterAPIExchange($settings);
			echo $twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest();
			break;	
		default:
			header("Location: /");
			break;
	}
}

?>
<html>
	<head>
		<title>Projet BDD ISEP 2014</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1>Choisissez le parti politique de votre choix</h1>
		<div id="content-wrapper">
			<a href="?focus=ump">
				<div id="ump" class="political_party"><img src="img/ump.jpg"/></div>
			</a>
			<a href="?focus=ps">
				<div id="ps" class="political_party"><img src="img/ps.jpg"/></div>
			</a>
			<a href="?focus=fn">
				<div id="fn" class="political_party"><img src="img/fn.jpg"/></div>
			</a>
			<a href="?focus=udi-modem">
				<div id="udi-modem" class="political_party"><img src="img/udi-modem.jpg"/></div>
			</a>
			<a href="?focus=fdg">
				<div id="fdg" class="political_party"><img src="img/fdg.jpg"/></div>
			</a>
			<a href="?focus=eelv">
				<div id="eelv" class="political_party"><img src="img/eelv.jpg"/></div>
			</a>
		</div>
	</body>
</html>
