## :rocket: SIMPLE E-SPP SYSTEM

## WHAT IS SIMPLE E-SPP?
This Simple Application Was Made To Manage School SPP Payments

## System Requirement
- PHP Version 7.2 or Above
- Composer
- Git
- Node Js


## Installation

Use the package manager (composer and npm) for installing

1. Do the following commands for installing
```bash
git clone https://github.com/rizalpahlevi372/spp-system.git
cd spp-system
composer install
npm install
copy .env.example .env
```
2. Create a database **e_spp** 
3. Setting database name, username, and password in your .env file
4. Do the following instructions if you're done setting database in .env
```bash
php artisan migrate
php artisan key:generate
```
## To run the application
```bash
php artisan serve
```


## Account Demo
1.  Username: **mrizalpahlevi372@gmail.com**
    Password: **12345678**

2.  Username: **11700618**
    Password: **wikrama**