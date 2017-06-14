#symfony-webpack
===============

A Symfony project with webpack for web assets

This app is using :
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

Compile assets
> npm run watch:assets

or to build only once
> npm run build:assets

