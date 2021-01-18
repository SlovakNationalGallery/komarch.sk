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
- php 7.4
- composer (tested with `Composer version 1.10.16 2020-10-24 09:55`)

## First time setup

- Enable these extensions in your php installation
  - exif
  - ftp
  - pdo_mysql
- Clone the repository
- Create `.env` and `.env.testing` files based on `.env.example`
  1) Create `.env` and `.env.testing` files as copies of `.env.example`
  2) Run `php artisan key:generate`
  3) Run `php artisan key:generate --env testing`
  4) Configure `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in `.env` based on
  `mysql-development` in `docker-compose.yml`
  5) Configure `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in `.env.testing` based on
  `mysql-testing` in `docker-compose.yml`
- Run `composer install`
- Run `npm install`
- Run `php artisan migrate`
- Run `php artisan elastic:migrate`
- Run `php artisan scout:import <model>`

## Development

- Run `docker-compose up` to start network services
- Run `npm run dev` to build frontend assets
- Run `php artisan serve` to start php development server
- Run `php artisan test --env testing` to run tests against testing database
