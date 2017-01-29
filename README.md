# Projet Silex Fete #

## Introduction ##

Ceci est un projet universitaire dont le but est d'utiliser le framework silex pour créer une API REST dédiée a la création d'un site de loccation de materiel d'organisation de soirée.

Cette application n'est pas dédiée a la production

## Installation (linux) ##

### Installation des dépendances php ###

Installation des dépendances php (instalation de composer [ici](https://getcomposer.org/download/)) :

    composer install

Copie du fichier de variables de base de donnée :

    cp app/config/parameters.php.dist app/config/parameters.php

Modifiez le fichier :

    vi app/config/parameters.php

Créez la base de donnée a l'aide de doctrine :
     php vendor/bin/doctrine orm:schema-tool:create

### Installation des dépendances javascript (si vous developpez seulement ) ###

Installation des dépendances npm de préproduction des fronts (instalation de nodejs et npm [ici](https://docs.npmjs.com/getting-started/installing-node)) :

    npm install

Installation des dépendances bower des fronts (instalation de bower  [ici](https://bower.io/)) :

    cd backoffice ; bower install ; cd ../frontoffice ; bower install ; cd ..

## Téchnologies ##
