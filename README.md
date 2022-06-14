### Как развернуть проект?:
1) git clone
2) Развернуть laradock 
   1) Link: laradock.io/
   2) Переименовать докеровский .env.example => .env
   3) Установить и запустить docker
   4) Command: docker-compose up -d nginx mysql phpmyadmin redis workspace
3) composer install
4) Отредактировать .env проекта для подключения к докеровской БД (прикладываю .env.example проекта)
   1) DB_CONNECTION=mysql
      DB_HOST=mysql
      DB_PORT=3306
      DB_DATABASE=DevitDB
      DB_USERNAME=root
      DB_PASSWORD=root
5) php artisan migrate
6) Запустить artisan команду: php artisan posts:getRSS (или подождать отработку CRON)
7) Ссылка на Swagger Documentation: http://localhost/api/documentation
