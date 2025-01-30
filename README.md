# Installation

```shell
git clone https://github.com/ainxgans/simple-web-store
cd simple-web-store
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
composer run dev
```

go to [http://127.0.0.1:8000/](http://127.0.0.1:8000/)

## Accounts

### Admin

```shell
admin@mail.com
password
```

### CS 1

```shell
cs1@mail.com
password
```

### CS 2

```shell
cs2@mail.com
password
```

### User

```shell
user@mail.com
password
```
