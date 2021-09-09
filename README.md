# Steps to run the project on WAMP
### Prerequisite 
WAMP, Composer must be installed 

## Create project directory in wap
Create project directory in this path  `C:\wamp64\www\project\`

## Download Project
Use git to clone in the command prompt (or Terminal in Visual Code), type
```
git clone https://github.com/pavanksd/employee_details.git
```
## Install Packages
```
cd employee_details
composer Install
```
## Generate Application Key
```
copy .env.example .env
php artisan key:generate
```
## Set up DB
In .env file specify the DB details, example below
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_DB_name
DB_USERNAME=your_username
DB_PASSWORD=your_passoword
```
## Run migration files
```
php artisan migrate
```

## Running the application in browser
In the browser, type the URL `http://localhost/project/employee_details/public/` to run the application

## To test this application added in expample csv file in ```sample csv``` folder