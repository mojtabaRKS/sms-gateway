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
3. `docker-compose up -d`
4. `docker-compose exec -it {sms_gateway_php_container_id} bash`
5. `$ composer install`
6. set environment variables like below :

```
NGINX_EXPOSED_PORT=8080
MYSQL_EXPOSED_PORT=33060
REDIS_EXPOSED_PORT=6379
...
DB_DATABASE=app
DB_PASSWORD=password
...
DB_HOST=mysql
REDIS_HOST=redis
```

7. `$ php artisan key:generate`
8. `$ php artisan migrate --seed`


# How to add new driver ?

See [Guide](./CONTRIBUTING.md)!

