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

Gestion des dépendances front-end faite avec NPM (voir package.json)
 - Jquery
 - Axios (Pour les promesses de requettes HTTP PUT / GET / POST -> https://github.com/axios/axios)
 - Framework front-end VueJs 2 ( ma confiugration permet l'écriture de code sous forme de template .vue compilés directement par Brunch )
 
 Compilation JS / SCSS / Fichiers
  - Brunch (voir http://brunch.io/docs/config pour comprendre ma configuration)

# Prérequis
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
		
# Exemple de configuration wamp (windows)
Emplacement du fichier de configuration localhost sur wamp (windows):
- C:\wamp64\bin\apache\apache2.4.23\conf\extra\httpd-vhosts.conf

        <VirtualHost *:80>
            ServerName local.exemple.fr
            DocumentRoot c:/wamp64/www/exemple/web
                <Directory  "c:/wamp64/www/exxemple/web">
                    Options +Indexes +Includes +FollowSymLinks +MultiViews
                    AllowOverride All
                    Require local
                </Directory>
        </VirtualHost>
ATTENTION : Pour que celà fonctionne sous windows pensez à éditer le fichier hosts pour prendre en compte le nom de domaine local.
## Sous windows
C:\Windows\System32\drivers\etc\hosts
## Sous Unix (Ubuntu Server 14 / 16.04 LTS)
/etc/hosts
 
Enjoy :)

# Erreurs possibles :
- The path "fos_user.from_email.address" cannot contain an empty value, but got null.
    - Changer les valeurs du parameters.yml -> email ne doit pas être null
# No route found (page) : 
- Vider le cache : php bin/console cache:clear --env=dev OU php bin/console cache:clear --env=prod selon la situtation OU rm rf var/cache/* (méthode bourrin)
