#symfony-webpack
===============

A Symfony project with webpack for web assets
Security is handled with in_memory provider
available users :
* User :  myuser / secure
* Admin : myadmin / secure

This app is using
* composer - php dependencies
* npm - front dependencies
* webpack 2 - build front dependencies

##Installation

Install php dependencies
> composer install

Install front dependencies
> npm install

##DEV
Start server
> php bin/console server:run

Compile assets on the fly
> npm run assets:watch

or to build only once
> npm run assets:build


