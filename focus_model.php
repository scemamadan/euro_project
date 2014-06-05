<?php

function get_top_hashtags(){
	$m = new MongoClient();
	$db = $m->selectDB("mydb");
	$collections = $db->listCollections();
	$top_array = array();
	foreach ($collections as $collection) {
			$nb_asked_object = $collection->find(array ('nb_asked' => array ('$exists' => true,),));
			foreach ($nb_asked_object as $value) {
				$var = array($value['nb_asked'],$collection->getName());
				array_push($top_array, $var);
			}
		}
	rsort($top_array); // on retourne le tableau avec trié par ordre decroissant
	return $top_array;

}
function count_all_tweets($hashtag){
	$m = new MongoClient();
	$db = $m->selectDB("mydb");
	$collection = $db->$hashtag; // on met le hashtag comme nom de collection
	return $collection->count() -1; // on ne compte pas le document qui nest pas un tweet
}
function tweet_exist($id_tweet){
	//afin deviter les doublons
	$m = new MongoClient(); // connect
	$db = $m->selectDB("mydb");	
	$collection = new MongoCollection($db, $_GET['hashtag_name']); // on met le hashtag comme nom de collection

	$cursor = $collection->find(array('id' => $id_tweet));

	if($cursor->count() > 0){
		return true;
	}
	else{
		return false;
	}
}
function increment_request($hashtag){
	// incrémente la valeur dans le bdd + retourne le nombre de fois que le le hashtag a été asked
	$m = new MongoClient(); // connect
	$db = $m->selectDB("mydb");
	$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection

	// on incremente le nombre de fois que ce hashtag a été saisi
	$nb_asked_object = $collection->find(array ('nb_asked' => array ('$exists' => true,),));

	if($nb_asked_object->count() == 0){
		$new_object = array('nb_asked' => 1);
		$collection->insert($new_object);
	return 0;
	}else{
		foreach ($nb_asked_object as $value) {
			$nb_asked_hashtag = $value['nb_asked'];
			$collection->update(
			    array('_id' => $value['_id']),
			    array('$set' => array('nb_asked' => $nb_asked_hashtag+1))
			);
		}
	return $nb_asked_hashtag;	
	}
}
function isTweet($tweet){
	if(isset($tweet['id'])){
		return true;
	}
	else{
		return false;
	}
}
function geoEnabled($tweet){
	if($tweet['geo'] !== null){
		return true;
	}
	else{
		return false;
	}
}
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
				'date' => $top_tweet['created_at'],
				'pp_image' => $top_tweet['user']['profile_image_url'],
			);
			array_push($tops, $elem);
	}
	return $tops;
}

function getCountryStat($hashtag){
	$m = new MongoClient(); // connect
	$db = $m->selectDB("mydb");
	$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection
	$geoQuery = array('geo' => array('$ne' => null));
	$data = array();	

	$cursor = $collection->find($geoQuery);
	foreach ($cursor as $doc) {
	   	$data[] = $doc['place']['country'];
	}
	
	$country = array();
	$total =0;
	for ($i=0; $i < count($data); $i++) { 
		$theCountry = $data[$i];
			if($theCountry != null){
				if(!isset($country[$theCountry])){
					$country[$theCountry] = 1;
					$total+=1;
				}else{
					$country[$theCountry] += 1;
					$total+=1;
				}
			}
	}
	$country['total']=$total;	
	return $country;
}

function getDataFlow($hashtag){
	$m = new MongoClient(); // connect
	$db = $m->selectDB("mydb");
	$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection
	$tab = array();	
	
	$cursor = $collection->find();
foreach ($cursor as $doc) {
	if(!isset($doc['created_at'])){
		
	}else{
	$formattedDate = date('Y-m-d H:i:s', strtotime($doc['created_at']));
	$formattedDate = new DateTime( $formattedDate);
	$formattedDate->sub(new DateInterval('PT2H'));
	$formattedDate =  $formattedDate->format('Y-m-d H');
			if(!isset($tab[$formattedDate])){
				$tab[$formattedDate] = 1;
			}else{
				$tab[$formattedDate] += 1;
			}
		}
	}
	return $tab;			
}

function get_best_favo($hashtag){
	$m = new MongoClient(); // connect
	$db = $m->selectDB("mydb");
	$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection
	$cursor = $collection->find()->sort(array('favorite_count' => -1))->limit(3);
	$tops = array();
	foreach ($cursor as $top_tweet) {
		$elem = array(
			'name' => $top_tweet['user']['screen_name'],
			'nb_fav'  => $top_tweet['favorite_count'],
			'text' => $top_tweet['text'],
			'date' => $top_tweet['created_at'],
			'pp_image' => $top_tweet['user']['profile_image_url'],
		);
		array_push($tops, $elem);
	}
	return $tops;
}

?>