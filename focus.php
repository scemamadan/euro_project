<?php
include('focus_model.php');
if(isset($_GET['hashtag_name']) ){
				$hashtag = strtoupper($_GET['hashtag_name']); // on met le hashtag en uppercase pour eviter les doublons dans les collections de la base

				require_once 'twitteroauth.php';
				 
				define('CONSUMER_KEY', 'n1fWH3pnnmmsNwgpWHvVYGW2x');
				define('CONSUMER_SECRET', 'viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6');
				define('ACCESS_TOKEN', '21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9');
				define('ACCESS_TOKEN_SECRET', 'F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P');
				
				$m = new MongoClient(); // on instancie l'objet mongoClient
				$db = $m->selectDB("mydb"); // on select la bdd "mydb"
				$collection = new MongoCollection($db, $hashtag); // on met le hashtag comme nom de collection

				// on incremente le nombre de fois que ce hashtag a été saisi
				increment_request($hashtag);								

				$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

				global $last_id;
				// on ajoute %23 pour préciser que l'on souhaite que les tweets avec les hashtags
				$query = array(
				  "q" => "%23".$hashtag,
				  "count" => "100",
				  "max_id" => "0"
				);

				// requete API Twitter + insertion 

				$compteur = 0;
				$how_many_new_tweets = 0;
				while($compteur < 15){ // 15 requetes avec 100 tweet à chaque fois

					$results = $toa->get('search/tweets', $query);

					foreach ($results->statuses as $result) {
						// on vérifie que le tweet qu'on vient de récupérer n'est pas déja présent dans la collection

						if(tweet_exist($result->id)==false){ // si le tweet n'est pas déja present dans la collection
							
							$collection->insert($result); // on stocke dans la collection le tweet
							$how_many_new_tweets++;

						}

						$last_id = $result->id;
					}

					$query['max_id'] = $last_id;
					

					$compteur++;
				}

	$tweets = $collection->find(); // on recupere tous les tweets de la collection dans la variable $tweets
 
	include('focus_view.php'); // insertion de la vue
}
else{
	header("location: index.php"); // S'il n'y a pas de hashtag dans le get on renvoie à la page d'accueil
}
?>