#symfony-webpack
===============

A Symfony project with webpack for web assets
Security is handled with doctrine user provider
available users :
* User :  user@example.com / secure
* Admin :  admin@example.com / secure

This app is using
* composer - php dependencies
* npm - front dependencies
* webpack 2 - build front dependencies
* doctrine - orm

##Installation

Install php dependencies
> composer install

Install front dependencies
> npm install

## Initialise the database

Check the config in parameters.yml

> php bin/console doctrine:schema:create

Seed the database
> php bin/console doctrine:fixtures:load

##DEV
Start server
> php bin/console server:run
or
> npm start

Compile assets on the fly
> npm run assets:watch

or to build only once
> npm run assets:build



