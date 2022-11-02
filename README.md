Projet salle de sport Body Top

Description

Dépôt du projet Body Top.

Les documents annexes sont disponibles dans le dossier ANNEXES :

Manuel d'utilisation

Voici l'adresse de mon site déployer: https://php-body-top.herokuapp.com/

j'ai déposé le mauvais PDF dans mon évaluation je vous ai joint le bon 



git clone https://github.com/Mazouni-Mehdi/Body-Top.git
Installation
# Déplacement dans le dossier
cd bodyTop

# Installation des dépendances
composer install

# Création de la base de données
php bin/console doctrine:database:create

# Création des tables (migrations)
php bin/console doctrine:migrations:migrate

# Insertions des jeux de données (fixtures)
php bin/console doctrine:fixtures:load --no-interaction
Utilisation
Deux options pour lancer le serveur de développement PHP :

Si vous avez installé Symfony :
symfony server:start
Si vous utilisez Composer, il faut installer le Web Server Bundle :
composer require symfony/web-server-bundle --dev
php bin/console server:start