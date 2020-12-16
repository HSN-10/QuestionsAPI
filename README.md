# QuestionsAPI

## Install

-   run on terminal

```
$ git clone https://github.com/HSN-10/SOD.git
$ composer install
```

-   Rename `.env.example` to `.env`
-   Edit file `.env`

```
APP_NAME="{Name Project}"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL={yourdomain}

DB_CONNECTION=mysql
DB_HOST={host}
DB_PORT=3306
DB_DATABASE={name_database}
DB_USERNAME={username}
DB_PASSWORD={password}
```

-   run on terminal

```
$ php artisan key:generate
$ php artisan migrate
```
