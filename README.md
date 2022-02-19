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
2. copy the `.env.example` to `.env`
3. run `docker-compose up -d`
4. run `docker-compose exec {sms_gateway_php_container_id} bash`
5. run `$ composer install`
6. set environment variables.
7. run `$ php artisan key:generate` in command line
8. run `$ php artisan migrate --seed` in terminal


# How to add new driver ?

See [Guide](./CONTRIBUTING.md)!

