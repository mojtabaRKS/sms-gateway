# SMS Gateway

yet another driver based service for sending sms 

## Table of Contents

- [Prerequisites](#prerequesties)
- [Install](#install)
- [How to add new driver?](#contributing)

## Prerequisites

- docker
- docker-compose

## Install

1. clone project.
2. run `docker-compose up -d`
3. run `docker-compose exec sms-gateway bash`
4. run `$ composer install`
5. copy the `.env.example` to `.env`
6. copy the `.env.testing.example` to `.env.testing`
7. set environment variables.
8. run `$ php artisan key:generate` in command line
9. run `$ php artisan migrate --seed` in terminal
10. run `$ npm i`
11. run `$ npm run dev`
12. run `$ php artisan horizon:install`


# How to add new driver ?

See [Guide](./CONTRIBUTING.md)!

