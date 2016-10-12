# Test Silex Api #

## Introduction ##

This is a test of silex to build rest Api

This application is not for production.

## Installation ##

first install all ressources with composer (instalation of composer [here](https://getcomposer.org/download/))

    composer install

Then copy the config file

    cp app/config/parameters.php.dist app/config/parameters.php

Finaly Modifiy the app/config/parameters.php

You can auto-generate the database structure by calling the route "/admin/createBase"
