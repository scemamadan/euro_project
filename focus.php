<?php

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
if(isset($_GET['hashtag_name']) ){
				$hashtag = $_GET['hashtag_name'];
				$focus_id = time();				

				require_once 'twitteroauth.php';
				 
				define('CONSUMER_KEY', 'n1fWH3pnnmmsNwgpWHvVYGW2x');
				define('CONSUMER_SECRET', 'viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6');
				define('ACCESS_TOKEN', '21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9');
				define('ACCESS_TOKEN_SECRET', 'F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P');
				
				$m = new MongoClient(); // connect
				$db = $m->selectDB("mydb");
				$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection

				// on incremente le nombre de fois que ce hashtag a été saisi
				increment_request($hashtag);								

				$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

				global $last_id;

				$query = array(
				  "q" => $hashtag,
				  "count" => "100",
				  "max_id" => "0"
				);

				// requete API Twitter + insertion 

				$compteur = 0;

				while($compteur < 15){ // 15 requetes avec 100 tweet à chaque fois

					$results = $toa->get('search/tweets', $query);

					foreach ($results->statuses as $result) {
						// on vérifie que le tweet qu'on vient de récupérer n'est pas déja présent dans la collection

						if(tweet_exist($result->id)==false){
							
							$collection->insert($result); // on stocke dans la collection tous les tweets

						}

						$last_id = $result->id;
					}

					$query['max_id'] = $last_id;
					
					$results = $toa->get('search/tweets', $query);

					$compteur++;
				}
				
	// affichage des tweets de la base

	$tweets = $collection->find();
 
	include('focus_view.php');
}
else{
	header("location: index.php");
}
?>