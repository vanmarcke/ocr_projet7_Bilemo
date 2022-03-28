# Project 7 OpenClassrooms - Bilemo

## Application Developer Formation - PHP / Symfony

Create a web service exposing an API

## App

![php](https://img.shields.io/badge/php-8.1.1-blue)
![symfony](https://img.shields.io/badge/symfony-6.0.6-succes)
![nelmio/api-doc](https://img.shields.io/badge/nelmio%2Fapi--doc-%5E4.8-green)

## Serveur Web

![php-unit](https://img.shields.io/badge/serveur-MariaDB-green)
![Apache](<https://img.shields.io/badge/Apache-2.4.51%20(Win64)%20OpenSSL%2F1.1.1l%20PHP%2F8.1.1-green>)
![phpMyAdmin](https://img.shields.io/badge/phpMyAdmin-5.1.1-green)
![Postman](https://img.shields.io/badge/Postman-9.15.2-orange)

## Code Quality

![php-cs-fixer](https://img.shields.io/badge/php--cs--fixer-%5E3.7-succes)

**SymfonyInsight:**

[![SymfonyInsight](https://insight.symfony.com/projects/717fb484-8b04-4659-86ed-deab03bec17a/big.svg)](https://insight.symfony.com/projects/717fb484-8b04-4659-86ed-deab03bec17a)

## Context

BileMo is a company offering a whole selection of high-end mobile phones.

You are in charge of the development of the BileMo company's mobile phone showcase. BileMo's business model is not to sell its products directly on the website, but to provide all the platforms that want access to the catalog via an API (Application Programming Interface). It is therefore a sale exclusively in B2B (business to business).

You will need to expose a number of APIs for applications on other web platforms to perform operations.

## Customer need

The first customer has finally signed a partnership contract with BileMo! It is the all-out battle to meet the needs of this first customer that will make it possible to set up all the APIs and test them immediately.

  After a dense meeting with the client, a certain amount of information was identified. It must be possible to:

- consult the list of BileMo products;
- consult the details of a BileMo product;
- consult the list of registered users linked to a client on the website;
- consult the details of a registered user linked to a client;
- add a new user linked to a customer;
- delete a user added by a customer.

Only referenced clients can access the APIs. API clients must be authenticated via OAuth or JWT.

## Libraries added whit composer require

Project initiated with symfony new Bilemo

- friendsofphp/php-cs-fixer
- symfony/maker-bundle --dev
- orm
- symfony/security-bundle
- debug --dev
- orm-fixtures –dev
- fakerphp/faker
- lexik/jwt-authentication-bundle
- nelmio/api-doc-bundle
- symfony/twig-bundle
- symfony/asset
- doctrine/annotations
- symfony/serializer-pack
- sensio/framework-extra-bundle
- knplabs/knp-paginator-bundle
- form validator
- willdurand/hateoas-bundle

## Installation

### Prerequisites

- Symfony CLI v4.28.1 - installation : "https://symfony.com/download"
- Composer version 2.2.5 - installation : "https://getcomposer.org/download/"
- PHP version 8.1.1
- A Management System (SGBD) type 'phpMyAdmin'
- You must have the php-xml and php-sql extensions to install and activate

### Step 1: Clone your machine's repository to a folder of your choice

```powershell
git clone git@github.com:vanmarcke/ocr_projet7_Bilemo.git
```

### Step 2: Configure database access

- Create an .env.local file in the root of the project.
- In this file copy/paste the code below.
- Modify the 'DATABASE_URL' and 'JWT_PASSPHRASE' lines by putting your database and your passphrase.

```code
###> doctrine/doctrine-bundle ###
DATABASE_URL="mysql://db_user:db_password@db_host:db_port/db_name?serverVersion=db_server_name"
###< doctrine/doctrine-bundle ###

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=your_pass_phrase
###< lexik/jwt-authentication-bundle ###
```

Example:

DATABASE_URL="mysql://root:@127.0.0.1:3306/bilemo?serverVersion=mariadb-10.4.11"

JWT_PASSPHRASE=I-m-going-to-have-fun-with-this-api

### Step 3: Make sure your Apache and Mysql Modules (or others depending on your configuration) are running. In a powershell-like terminal or that of your code editor, run the command below at the root of the project

This command will install all dependencies, Generate the SSL key, database with Fixtures dataset and start the web server

```powershell
composer run-script install-projet --dev
```

### Step 4: The site is now functional at "https://127.0.0.1:8000/api/doc" , you can generate the token key with the credentials below via Login / POST

- username: client1@gmail.com
- password: 123456

or

- username: client2@gmail.com
- password: 123456

## Have a good fun on this api

## Author

**Frédéric Vanmarcke** - Student Openclassrooms school path PHP / Symfony application developer
