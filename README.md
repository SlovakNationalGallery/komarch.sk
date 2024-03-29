# Slovenská Komora Architektúry (komarch.sk)

This is the web for komarch.sk. It is written in PHP and builds upon the Laravel
framework. It uses MySQL as a database, Elasticsearch for text search
functionality, and Redis as a transient storage for the job queue.

This readme assumes you will be using containerized services. You can use native
installs as well as long as you configure them equivalently (see
`docker-compose.yml` for more).

## Prerequisites

- docker
- docker-compose
- php 8.2
- composer 2
- node 14 (or higher)

## First time setup

1. Enable these extensions in your php installation
    - exif
    - ftp
    - pdo_mysql
1. Clone the repository
1. Create `.env` and `.env.testing` files (as copies of `.env.example`)
1. Configure env variables `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
    - in `.env` based on `mysql-development` in `docker-compose.yml`
    - in `.env.testing` based on `mysql-testing` in `docker-compose.yml`
1. Run `docker-compose up`
1. Run `composer install`
1. Run `npm install`
1. Run `php artisan storage:link`
1. Generate app keys:
    - Run `php artisan key:generate`
    - Run `php artisan key:generate --env testing`
1. Run `php artisan migrate`
1. Run `php artisan elastic:migrate`
1. Run `php artisan scout:import <model>`
1. Run `npm run dev`

## Development

For Backpack Pro to work, don't forget to

- Create auth.json with credentials to `backpack/pro` repository. See auth.json.example

Additionaly

- Run `docker-compose up` to start network services
- Run `npm run dev` to build frontend assets
- Run `php artisan serve` to start php development server
- Run `php artisan test --env testing` to run tests against testing database

### Accessing the 'urad/intranet' database
In order to connect to the 'urad' DB, you'll need to set up a ssh tunnel like this:
```
ssh -N -L 3336:localhost:3336 webumenia.sk
```

Now the database will be reachable at `127.0.0.1:3336` like so:
```
URAD_DATABASE_URL="mysql://user:password@127.0.0.1:3336/intranet_komarch"
``` 
