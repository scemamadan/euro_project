<?php
function get_best_rt($hashtag){
	$m = new MongoClient(); // connect
	$db = $m->selectDB("mydb");
	$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection
	$cursor = $collection->find()->sort(array('retweet_count' => -1))->limit(3);
	$tops = array();
	foreach ($cursor as $top_tweet) {
		$elem = array(
			'name' => $top_tweet['user']['screen_name'],
			'nb_rt'  => $top_tweet['retweet_count'],
			'text' => $top_tweet['text'],
		);
		array_push($tops, $elem);
	}
	return $tops;
}
foreach(get_best_rt('monfils') as $elem){
	var_dump($elem);
}
?>