# Conduite de Projet

[![Build Status](https://travis-ci.org/hardwork2015/cdp.svg?branch=dev)](https://travis-ci.org/hardwork2015/cdp)
[![Code Climate](https://codeclimate.com/github/hardwork2015/cdp/badges/gpa.svg)](https://codeclimate.com/github/hardwork2015/cdp)
[![Dependency Status](https://www.versioneye.com/user/projects/5625452636d0ab0019000bd4/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5625452636d0ab0019000bd4)

Cet outil permet la gestion d'une équipe grace à la méthode SCRUM.

##Configuration du serveur

Afin que ce projet puisse fonctionner sur votre serveur, vous aurez besoin de  :

- PHP >= 5.5.9
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension

##Installation

Après téléchargement du projet, se rendre dans le dossier grâce à votre terminal, puis lancer la commande suivante à fin de mettre à jour le projet via Composer :

    composer update

Suite à cela, il ne vous reste plus qu'a configurer votre base de donnée.
Pour se faire commencez par modifier le fichier .env, en y précisant les informations relatives à votre base de données.

Vous pouvez également vous rendre sur le fichier config/database.php.

Après avoir configuré votre base de données, il ne vous reste plus qu'a l'initialiser en lançant la commande suivante :

    php artisan migrate

Félicitation votre projet est désormais pleinement fonctionnel.


### License

This tool is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)