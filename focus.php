<?php
header('Content-Type: text/html; charset=utf-8');

if(isset($_POST['hashtag_name']) ){
				require_once 'twitteroauth.php';
				 
				define('CONSUMER_KEY', 'n1fWH3pnnmmsNwgpWHvVYGW2x');
				define('CONSUMER_SECRET', 'viXJ1QoE5dUrw8UWC1S2M7KQzsLhQGp65FBetSvjk6l9OpzlK6');
				define('ACCESS_TOKEN', '21075947-6PAANtgOTJxgdseJS8RefuPwANLELYwMtNFmKxst9');
				define('ACCESS_TOKEN_SECRET', 'F1MNz0LnwtWUrqt1u0JUdB316XxsUzJHV9M7G3Xnm334P');
				
				$m = new MongoClient(); // connect
				$db = $m->selectDB("mydb");
				$collection = new MongoCollection($db, time()); // on met le time UNIX comme nom de collection

				$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

				global $last_id;

				$query = array(
				  "q" => $_POST['hashtag_name'],
				  "count" => "100",
				  "max_id" => "0"
				);

				// requete + insertion 

				$compteur = 0;

				while($compteur < 15){

					$results = $toa->get('search/tweets', $query);

					foreach ($results->statuses as $result) {

						 $collection->insert($result); // on stocke dans la collection tous les tweets
						 $last_id = $result->id;
					}

					$query['max_id'] = $last_id;
					
					$results = $toa->get('search/tweets', $query);

					$compteur++;
				}
				
				// affichage des tweets de la base

				$tweets = $collection->find();
				$i=0;
				foreach ($tweets as $tweet){
					echo "[".$i."-".$tweet['id']."-".$tweet['created_at']."]". $tweet['text'] . " <br /><br />";
					$i++;

				}
}
else{
	header("location: index.php");
}
?>