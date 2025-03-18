# tool4cars
J'ai modifié 2 valeurs de "year" dans cars.json pour avoir une voiture qui date de plus de 10 ans et une autre de moins de deux ans pour le client A.


Réponse à étape 6 : Sécuriser les données

Problèmes potentiels :
Cookies non sécurisés : Les informations sur le client stockées dans les cookies peuvent être modifiées ou lues par d'autres personnes.
Exposition des données sensibles : Les données de voitures et de garages sont envoyées en texte clair. On peut potentiellement intercepter ces données.
Injection SQL ou XSS : Si des données externes sont utilisées sans validation, cela peut exposer l'application à des injections SQL ou à des attaques XSS.
Authentification faible : Si l'authentification n'est pas correctement gérée, il est possible que des utilisateurs non autorisés accèdent à des informations sensibles.

Solutions proposées :

Cookies sécurisés : 
Utiliser le flag HttpOnly pour empêcher les scripts côté client d'accéder aux cookies. 
Utiliser le flag Secure pour s'assurer que les cookies ne sont envoyés qu'en connexion HTTPS.
Ajouter une expiration raisonnable pour les cookies pour éviter qu'ils ne restent valides trop longtemps.
exemple : setcookie('client_id', $clientId, time() + 3600, "/", "", true, true);

Chiffrement des données sensibles :
Utiliser des algorithmes de chiffrement pour chiffrer les données sensibles avant de les stocker ou de les envoyer à travers le réseau.
Le chiffrement des communications doit être assuré via HTTPS pour garantir la confidentialité des données.

Validation des entrées :
Toujours valider les données venant de l'utilisateur pour éviter les injections SQL ou XSS.
Utiliser des requêtes préparées et des paramètres liés pour éviter les injections SQL.

Gestion de l'authentification :
Implémenter une authentification sécurisée avec un mot de passe fort et un mécanisme de hachage.
Utiliser des sessions sécurisées pour garder la trace des utilisateurs authentifiés et protéger les pages sensibles.
Ajouter un contrôle d'accès basé sur le rôle de l'utilisateur pour restreindre l'accès à certaines ressources.

