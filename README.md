# Sistema Integral de Transporte - Mexicali

## Tech

SIT-MXLI uses a number of open source projects to work properly:

- [PHP] - A popular general-purpose scripting language that is especially suited to web development.
- [Composer] - A tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

## Installation

SIT-MXLI requires [PHP] v7.3+ and [Composer] v2.0 to run.

Install the dependencies and start the server.

```sh
cd sit-mxli
composer install
cp .env.example .env
php artisan key:generate
```

In order to connect the application with the database, you must configure your connection parameters by modifying the following variables within the .env file.

```
DB_DATABASE=  # The name of your database previously created
DB_USERNAME=  # Your database user
DB_PASSWORD=  # Your database password.
```

After you have configured the connection parameters, you must run the following commands to create the tables within the database and run the project.

```sh
php artisan migrate --seed
php artisan serve
```

## Testing
* Create Access Token
```sh
curl --request POST \
  --url http://127.0.0.1:8000/api/token \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
        "email": "lorem.ipsum@testing.org",
        "password": "PWD4li!"
  }'
```

* Calculate budget
```sh
curl --request GET \
  --url http://127.0.0.1:8000/api/budget \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Paste token got in step number 1>' \
  --header 'Content-Type: application/json' \
  --data '{
        "travel_type": "Round Trip",
        "departure_time": "17-09-2021",
        "return_time": "27-09-2021",
        "one_way_route": "Mexicali-Tecate",
        "return_route":"Tecate-Mexicali",
        "transport_unit": "Car",
        "total_people": "90"
  }'
```

[PHP]: <http://php.net>
[Composer]: <https://getcomposer.org/>
