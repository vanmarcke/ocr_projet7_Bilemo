# Project 7 OpenClassrooms - Bilemo

- Project in progress

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
![Postman](https://img.shields.io/badge/Postman-9.14.0-orange)

## Code Quality

![php-cs-fixer](https://img.shields.io/badge/php--cs--fixer-%5E3.7-succes)

**SymfonyInsight:**

[![SymfonyInsight](https://insight.symfony.com/projects/b3a17fcb-b2ec-4c03-aa3a-819a029f81c1/big.svg)](https://insight.symfony.com/projects/b3a17fcb-b2ec-4c03-aa3a-819a029f81c1)

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

## Libraries added

- Project in progress

## Installation

- Project in progress

### Prerequisites

- Symfony CLI version v4.28.1
- PHP version 8.1.1
- Composer version 2.2.5
- A Management System (SGBD) type 'phpMyAdmin'

### Step 1: Clone your machine's repository to a folder of your choice

```powershell
git clone git@github.com:vanmarcke/ocr_projet7_Bilemo.git
```

### Step 2: Configure database access

- Create an .env.local file in the root of the project.
- In this file copy/paste the code below.
- Modify the 'DATABASE_URL' and 'Gmail' lines by putting your database and Gmail identifiers.

```code
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.4.11"
```

Example: DATABASE_URL="mysql://root:@127.0.0.1:3306/bilemo?serverVersion=mariadb-10.4.11"

### Step 3: Make sure your Apache and Mysql Modules (or others depending on your configuration) are running. In a powershell-like terminal or that of your code editor, run the command below at the root of the project

This command will install all dependencies, webpack-encore-bundle, database with Fixtures dataset and start the web server

```powershell
- Project in progress
```

### Step 4: The site is now functional, you can create an account with your own identifiers or use the identifiers below

- username: client1@gmail.com
- password: 123456

## Future Developments

- Project in progress

## Author

**Frédéric Vanmarcke** - Student Openclassrooms school path PHP / Symfony application developer
