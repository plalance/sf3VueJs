#!/bin/sh

echo "Création du premier admin"
php bin/console fos:user:create paul lalance.paul@gmail.com paul

echo "Utilisateur : Paul à été créé"
php bin/console fos:user:activate paul
php bin/console fos:user:promote paul ROLE_ADMIN

echo "Vous pouvez vous connecter avec l'utilisatuer : paul, mdp : paul"