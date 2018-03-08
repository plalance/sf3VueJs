# Prérequis
- NodeJs / Npm (voir https://nodejs.org/en/download/ pour installatateur windows)
- Avoir mis à jour sa version npm (https://www.npmjs.com/package/latest-version)
		npm install --save latest-version
- Installation sass-brunch pour compilation des assets, JS, et Scss
		npm install -g brunch
- Avoir composer d'installé
- Avoir git et gitflow d'installé

# Installation
        Cloner le projet
		Configurer une bdd en accord avec le parameters.yml
		Initialisation Git Flow dans le projet
		Install des dépendances via composer
		Install des dépendances (node_modules) de NPM
		Install des assets (fosJsRouting) -> php bin/console assets:install web
		Brunch build
		Vider le cache
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
 
Enjoy :)

# Erreurs possibles :
- The path "fos_user.from_email.address" cannot contain an empty value, but got null.
    - Changer les valeurs du parameters.yml -> email ne doit pas être null