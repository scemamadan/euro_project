ISEP DATABASE PROJECT - Fill a NoSQL database with tweets
============

Technologie : PHP
API Twitter REST 1.1

index.php
============
page d'accueil permettant de saisir le hashtag à étudier
Cette page affiche aussi le top 5 des hashtags

focus.php
============

Rôle du controlleur, cette page recupere le hashtag et recupère les tweets grace à l'API twitter
A chaque tweet récuperer on l'insere dans la BDD NoSQL (Mongodb)

focus_view.php
============
Rôle de la vue, permet d'afficher les tweets géolocalisés sur une carte Google Maps, ou encore d'affichercher quelques diagramme et un classement des tweets les plus celebres.

focus_model.php
============
Regroupement de toutes les methodes PHP utiles pour le projet.

