# RR Test Case Project


## Requirements

* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* MySQL 5.6

## Instalation

### 1. Download the project source code

#### Using [Git](https://git-scm.com/)

Run the following command in your servers root web directiory:
```sh
git clone https://github.com/brunomayerc/rrtestcase.git
```
#### Manual Download

Manually download the [Zip folder](https://github.com/brunomayerc/rrtestcase/archive/master.zip) with the latest version from this repository and place it in your servers root web folder.

### 2. Composer

In order to deploy this project, you must install [Composer](https://git-scm.com/). Composer is a Dependency Manager for PHP and its used to install all dependencies for this project.

Once you have installed Composer. Go to the root directory of this project and run the following command:
```sh
php composer.phar update 
```

This will download and configure any dependency for the project.

### 2. Configure the project

A few configurations must be made in order to deplow the projects database as well as local environment configuration


#### Database

Edit file in the root of the project `.env`.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=reorg
DB_USERNAME=root
DB_PASSWORD=root
```

#### App Url

Edit file in the root of the project `.env`. Please **do not** include the last forward slash `/`

```sh
APP_URL=http://localhost
```

### 3. Database Migrations

This project uses [Migrations](https://laravel.com/docs/5.2/migrations) to set up the MySQL Database Structure. Simply run the following command and the database scripts for the application will be deployed:

```sh
php artisan migrate 
```

If Migrations fails for any reason, here is the script that can be used to set up the table manually

```sql
CREATE TABLE `openpaymentsdata_recipient` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openpaymentsdata_reference_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('PROVIDER','HOSPITAL') COLLATE utf8_unicode_ci NOT NULL,
  `total_number_of_transactions` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```


### 4. You're all set

Now, just open your browser and go to the URL you set up in the `.env` file and you should see the project's home page.
