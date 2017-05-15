## Requirements
- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- DOM extension (xml)
- GD extension
- Pgsql extension
- Zip extension

# Installation

Copy .env.example file to .env by running

```php
cp .env.example .env
```

We now need to install packages using composer by running


```php
composer install
```

After the new file has been created you need to generate a hash key by running

```php
php artisan key:generate
```

After you have generated the key next step is to set database credential in the `.env` file change

```php
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=6773
DB_DATABASE=greenshoe_challange
DB_USERNAME=chebon
DB_PASSWORD=password78$567*
```
This Should match your database credentials and port if you are trying on mysql server change `DB_CONNECTION`  to `DB_CONNECTION=mysql`

Next is to publish our configuration by running

```php
php artisan config:cache
```


We are now ready to generate out tables on the database by running

```php
php artisan migrate
```

If the tables already exists in the database they will be ignored and the ones used for authentication will be created


Next step is to generate Dummy data by running

```php
php artisan db:seed
```

This will populate the database with dummy data using files in `database/seeds` i.e `DebtorDetailsTableSeeder.php` and  `DebtorTableSeeder.php`

We can now initialize the application by running

```php
php artisan greenshoe:install
```

This will Populate the roles in the database i.e  Role 1 and Role 2

