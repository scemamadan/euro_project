<?php
require_once('TwitterAPIExchange.php');
$settings = array(
    'oauth_access_token' => "21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9",
    'oauth_access_token_secret' => "F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P",
    'consumer_key' => "n1fWH3pnnmmsNwgpWHvVYGW2x",
    'consumer_secret' => "viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23ump';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
?>
<html>
<p>TEST</p>
</html>
