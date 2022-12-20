# Beer Catalog

#### Author: Oscar Valdés

## Description

This is the repository of a beer catalog **web application**. This application allows the user to:
1. Add, edit, delete and view beers.
2. View and edit a detailed description of each beer (including flavor, ph, alcohol content, color, ...).
3. View and edit the beer's image.
4. Add reviews to each beer.
5. Edit the list of ingredients of each beer.

... and more!

## Instructions

#### Requirements

It is recommended to install XAMPP, since it contains all the required software to run the app. You can download it [here](https://www.apachefriends.org).
Otherwise, you will need to install the following software (it can also be done with Homebrew):

- [PHP 8.2](https://www.php.net/downloads.php)
- [Apache web server](https://httpd.apache.org/download.cgi)
- [MySQL 8.0](https://www.mysql.com/downloads/)

Additionally, the web app was made using *phpMyAdmin* to manage the database (already included in XAMPP). If you want to use it, you can download it [here](https://www.phpmyadmin.net/downloads/).

#### Installation

The repository contains the database file `beerdb.sql` and the web app files. To install the web app, follow these steps:

1. Clone the repository.
2. Start the Apache web server and MySQL.
3. Create a database named `cervezas`.
4. Import the file `beerdb.sql` into the database.
5. Create a file named `src/config.php` and define the constants `$Host`, `$User`, `$Password`, `$Database` and `$Port` to match your database configuration (or assign the values directly in `src/dbConnection.php`).

## Preview

#### Product page
![Product page](/readme/productos.png)

#### Details page
![Details page](/readme/detalles.png)

#### Edit options page
![Options page](/readme/opciones.png)

#### Review page
![Review page](/readme/resenias.png)

#### Video demonstration
![Video demonstration](/readme/recording.mov)

## Made with

[![My Skills](https://skillicons.dev/icons?i=php,mysql,bootstrap,html,css,vscode)](https://skillicons.dev)