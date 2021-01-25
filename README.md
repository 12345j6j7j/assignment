## INSTALLATION STEPS

*preferably linux

1. Clone repo in local directory

2. Create local database 

3. Position yourself on the project folder (console) and type:

- composer install
- cp .env.example .env 

-> adjust .env settings:
Open .env in your IDE and set db connection as described bellow

DB_DATABASE={db name}
DB_USERNAME={db username}
DB_PASSWORD={db password}

back to console and type: 
- php artisan migrate
- php artisan db:seed
- php artisan storage:link

If you are using Laravel server
- type in console: php artisan serve

Email: mail@mail.com
Password: password