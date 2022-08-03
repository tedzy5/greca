<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About this basic project

Using the base of Laravel framework, I am building a quick small web application that has clients table and products table where the booking tables has information regarding which client(s) order for what product(s):

This web application can be upgraded easily with much more advanced features where Laravel and it's co-plugin features can be used easily.

## Building the database

I used the mySQL installed type of database where I cn change that to PostgreSQL, SQLite or anything else as well.

Please, create the database and update the .env file what whatever's necessary before you run the "php artisan migrate" to build the tables at first then you can run "php artisan db:seed" to fill clients and products table randomly.

## Clients Controller & Model

Basic Clients controller has the main 5 functions (index, show, store, update, delete)
You can simply test the links via API via POSTMAN to:
show all /api/clients (GET)
show specific client /api/clients/{id} (GET)
create a new client /api/clients (POST)
update a client /api/clients/{id} (PUT)
/* DELETING a Client also deletes all bookings taken by the client */
delete a client /api/clients/{id} (DELETE)

show all /api/products (GET)
show specific product /api/products/{id} (GET)
create a new product /api/products (POST)
update a product /api/products/{id} (PUT)
delete a product /api/products/{id} (DELETE)

show all /api/bookings (GET)
show all available bookings /api/available/bookings (GET)
show all unavailable bookings /api/unavailable/bookings (GET)
show bookings for a specific client /api/bookings/{client_id} (GET)
create a new booking /api/bookings (POST)
update a booking /api/bookings/{client_id}/{id} (PUT) 
delete a product /api/products/{client_id}/{id} (DELETE)

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

## Bookings

Booking a product for a client first makes sure that the product exists, then it makes sure that the client exists; if both exist then it makes sure that there is still capacity available to book.
