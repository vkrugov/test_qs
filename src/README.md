## TestApp

Required:
- PHP 7.4
- Mysql

#You need
- create DataBase 'test_qs' in MySql
- sudo apt-get install php7.4-gd

## For Localhost

go to folder afore project and set permissions:
- sudo chgrp -R www-data test_app.loc/
- sudo chmod -R 775 test_app.loc/storage/
- sudo chmod -R 777 test_app.loc/storage/logs

1) in project create .env and fill it from .env.example
2) in .env Fill next fields with your local data:
   * DB_DATABASE=test_app
   * DB_USERNAME=***
   * DB_PASSWORD=***
3) run next commands:
```
- composer install
- php artisan key:generate
- php artisan migrate
```
copy .env.example to .env and set properties for your db


### Parse posts from habr
There are 2 ways to parse posts:
1) open tinker and input `dispatch_now(new HabrParse())`
2) set params in .env for example :
```
REPEAT_PERIOD=week
REPEAT_PERIOD=2
```

### Project Start
1) You can use `php artisan serve`. In this case front will be connected to http://127.0.0.1:8000
2) Or you can set app url in `src/app/resources/js/config/js`

### Screenshots: 
1) https://prnt.sc/zj0066
2) https://prnt.sc/zj55b0
