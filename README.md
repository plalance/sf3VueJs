# Le projet
 - Une partie Dashboard (localisation google map, affichage de graphiques, connexion / déconnexion) en VueJs, interractions via API Rest
 - Une partie présentation "classique", (MVC Entity / Controller / Templates Twig)
 - Une cartographie (google map) de mes voyages... (Entités location)

# Technologies
La gestion des utilisateurs est faite avec le bundle FOSUserBundle, adapté au projet.
Gestion de la sérialisation des entités / response avec JMSSerializer (https://jmsyst.com/bundles/JMSSerializerBundle)
ORM Doctrine, update de la base avec Doctrine Migration (doc ici : https://symfony.com/doc/master/bundles/DoctrineMigrationsBundle/index.html)

Scripts sh de génération de migration, d'update du schema de BDD, de création d'users dans le répertoire : app/sh

API communication (permet pour le moment d'envoyer des mails aux utilisateurs, dont le contenu est saisi directement dans l'interface dashboard VueJs au moyen d'un éditeur type tinymce). On se connecte à un User, on saisi le contenu du mail -> API -> Mail envoyé...
Fonctionne sous unix (si serveur mail configuré) sinon sous wamp -> Utilisation de comtpe google smtp pour envoi de mail (pool disponible)

La gestion des dépendances front est faite avec NPM (voir package.json)

###Les technologies et outils

| Technologie   |     Doc         |     Infos supplémentaires         |
| :------------ | :-------------: |:-------------: |
| VueJs2        |https://vuejs.org/v2/guide/| Framework Front-End|
| Chart.js      |http://www.chartjs.org/docs/latest/| Librairie de graphiques et diagrammes|
| Axios         |https://github.com/axios/axios|Pour les promesses de requettes HTTP PUT / GET / POST|
| Vue-Axios     |     |Wrapper Axios VueJs 2|
|Lodash         |https://lodash.com/|Librairie facilitant la manipulation / opérations sur les objets javascripts|
|Vue-X||Gestionnaire de State et Commit / Dispatcher d'objets JS dans tous les composants Vue|

###Compilation et gestion des sources

| Technologie   |     Doc         |     Infos supplémentaires         |
| :------------ | :-------------: |:-------------: |
|Brunch (similaire à Webpack)|http://brunch.io/docs/config|  |
| Vue-Loader    |   |Compilation SASS (.scss) / .js / .vue / Concaténation en css / destion des assets|
| Vue-Template-Compiler    | | Permet l'écriture / interprétation des composants Vue sous forme de template .vue |
| Copycat    | PLugin Brunch | Permet de gérer les assets à copier en dur (images / fonts / etc..) dans le répertoire public|

####Commandes Brunch

Pour builder les assets (compiler tous les .js et créer les require.register) + les déposer dans le répertoire public (voir configuration dans le fichier brunch-config.js)
        brunch build [ brunch b ]
<br>
Pour watcher (Recompilation dès qu'un .scss / .js / fichier image source est modifié + rechargement des navigateurs connectés)  

        brunch watch [ brunch w ]
<br>
Pour compiler les assets (.js + .scss -> .css -> .css) en version optimisé (minifiés)

        brunch build --production

###Bundles choisis

| Technologie   |     Doc         |     Infos supplémentaires         |
| :------------ | :-------------: |:-------------: |
| DoctrineMigrationsBundle|https://symfony.com/doc/master/bundles/DoctrineMigrationsBundle/index.html|POur ORM Doctrine, udpate de schema de BDD au regard des entités, hgestions des migrations, versioning de migrations...|
| FOSUserBundle|https://symfony.com/doc/current/bundles/FOSUserBundle/index.html|Gestion des utilisateurs|
| FOSRestBundle|https://symfony.com/doc/current/bundles/FOSRestBundle/index.html|Implémnetation REST|
| JMS Serializer|https://jmsyst.com/bundles/JMSSerializerBundle|Serializer pour réponses d'API Json, utilisation de context (différentes vue des entités selon le contexte choisi, la sérialisation est différente)|
| NelmioApiDocBundle|https://symfony.com/doc/master/bundles/NelmioApiDocBundle/index.html|Génération de Documentation des routes API par annotation|

## Environnement

Au vu de certaines dépendances assez récentes, notamment l'arrivée du MakerBundle depuis que la commande doctrine:generate:entities est dépréciée,
le projet necessite au moins PHP 7.1 sans quoi l'installation via composer ne passera pas.

Le projet fonctionne sur :
Ubuntu 14.04 LTS / Apache / PHP 7.2
Windows 10 / Wamp Server 3 (Apache)/ PHP 7.1.18

# Prérequis
- Avoir un serveur web (LAMP, WAMP, LEMP...)
- NodeJs / Npm (voir https://nodejs.org/en/download/ pour installatateur windows)
- Avoir mis à jour sa version npm (https://www.npmjs.com/package/latest-version)
		npm install --save latest-version
- Installation sass-brunch pour compilation des assets, JS, et Scss
		npm install -g brunch
- Avoir composer d'installé
- Avoir git et gitflow d'installé

# Les scripts sh
        build.sh -> Script à utiliser dès que l'on souhaite générer les tables de la BDD, à chaque modification des entités mappées, on utilise cette commande. Elle va faire le clear de la migration actuelle, générer les différences et exécuter la migration si on le souhaite. (build.sh appelle en cascade clear.sh et migrate.sh)
        createAdmin.sh -> A utiliser une fois au début pour créer un admin par défaut : paul / paul
# Installation
        Cloner le projet
		Configurer une bdd en accord avec le parameters.yml
		Initialisation Git Flow dans le projet
		Install des dépendances via composer
		Install des dépendances (node_modules) de NPM
		Install des assets (fosJsRouting) -> php bin/console assets:install web
		Brunch build
		Vider le cache
		Créer un utilisateur en base avec la commande .sh (voir scripts sh)
		Go
		
# Exemple de configuration de vhost sous wamp (windows)
Emplacement du fichier de configuration localhost sur wamp (windows):

        C:\wamp64\bin\apache\apache2.4.23\conf\extra\httpd-vhosts.conf
<br>

        <VirtualHost *:80>
            ServerName local.votredomaine.fr
            DocumentRoot c:/wamp64/www/votredomaine/web
                <Directory  "c:/wamp64/www/exxemple/web">
                    Options +Indexes +Includes +FollowSymLinks +MultiViews
                    		AllowOverride All
                            Order Allow,Deny
                            Allow from All
                            DirectoryIndex app.php
                </Directory>
        </VirtualHost>
ATTENTION : Pour que celà fonctionne sous windows pensez à éditer le fichier hosts pour prendre en compte le nom de domaine local.

        127.0.0.1 local.votredomaine.fr
#### Sous windows
        C:\Windows\System32\drivers\etc\hosts
#### Sous Unix (Ubuntu Server 14 / 16.04 LTS)
        /etc/hosts

# Erreurs possibles :
- The path "fos_user.from_email.address" cannot contain an empty value, but got null.
    - Changer les valeurs du parameters.yml -> email ne doit pas être null
- No route found (page) : 
    - Vider le cache : php bin/console cache:clear --env=dev OU php bin/console cache:clear --env=prod selon la situtation OU rm rf var/cache/* (méthode bourrin)
- Erreurs pendant la génération de la BDD avec build.sh :
    -> Soucis liés aux contraintes de clés, aux tables qui existent déjà en base, à l'ajout de contrainte d'intégrité impossible
    - Vérifier vos entités... sinon
    - Effacer le contenu du dossier app/DoctrineMigrations
    - Vider (DROP TABLE) la table des migration_versions
    - Relancer le build.sh
- Lors de la première installation via composer
    -> Erreur liée à la commande app/console (qui n'existe plus depuis SF3 et est devenu bin/console)
    - créer un dossier "var" à la racine du projet
    - C'est lié au fait que composer cherche en cache quelle version de SF est installée pour les appels de scripts post-install, or sans le dossier var contenant le cache il ne saura rien faire...
    - Relancer composer install
- En cas de 404 not found sur une page
    - Vérifier le routing
    - Vider le cache
    - tester en app_dev.php ET en app.php
    - Vérifier le Vhost :la propriété AllowOverride doit être à All pour permettre la réécriture des chemins