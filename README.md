# MyTournament - Web
MyTournament Web est une Application Symfony de version 5 qui permet de gérer et d'organiser des tournois sportifs.

## L'application et les fonctionnalités
L'application Web fera office de back-office dans lequel un organisateur pourra créer son tournois et organiser ses matchs.

Actuellement, l'application offre:
- CRUD pour les utilisateurs (pour un administrateur, en attente de l'ajout d'une fonctionnalité d'authentification et d'enregistrement de compte);
- CRUD pour les lieux (permet de renseigner un gymnase ou tout espace qui pourrait occuper un tournois);
- Ajout de terrains pour un lieu;
- Création de tournois;
- Création d'équipes;
- Création de matchs;
- Une interface qui permettra de gérer un match.

## Prototype 3
L'objectif du prototype 3 est de rendre cette application en tant qu'API (avec l'utilisation de API Platform).
Ainsi, l'application Android devra pouvoir récupérer des informations, dans un premier temps la durée du match, qu'elle devra envoyer à l'Arduino qui affichera le timer sur le 7 Segments.

## Prochainement
Voici les différentes fonctionnalités que nous ajouterons une fois le Prototype 3 sera fonctionnel:
- Ajouter des rôles (admin, organisateur, joueur...) pour déterminer les différents droits (créer un tournois, participer à un tournois...);
- Soigner l'API pour envoyer davantage d'information et permettre à l'application Android d'enregistrer des données (propre au match);
- Ajouter un système d'authentification et d'enregistrement de compte.