LOTTERY GAME LUMEN
=======
Разворачивание и конфигурация проекта
------------
1. Создать каталог `/home/<user>/lottery_game`
2. При помощи `git clone` склонировать проект в свою директорию
3. Перейти в директорию `/lottery_game/project` и установить зависимости при помощи `php composer.phar install`
4. На основе `.env.exapmple` создать свой `.env` указав в нём следующие поля: DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD для подключения к БД. Также стоит указать указать поля JWT_SECRET (ключ) и JWT_ALG (алгоритм) для использования JWT библиотеки.
5. Далее переходим в директорию `/lottery_game/deploy` в файл `docker-compose.yml`
6. В контейнере db в environment устанавливаем значения переменных окружения для подключения к БД, такие же как в файле `.env`
7. В этой же директории, при помощи команды `docker compose up -d db` поднимаем контейнер с PostgreSQL
8. Далее при помощи `docker compose up --build lumenapp` поднимаем контейнер с самим приложением. Сервер будет работать внутри контейнера на 0.0.0.0:8000, а на хосте localhost:8000
9. Заходим в контейнер командой `docker exec -it lumenapp /bin/sh` и выполняем миграции `php artisan migrate`. Также можно запустить сидер командой `php artisan db:seed --class=DatabaseSeeder`
10. Приложение развёрнуто!

ПРИМЕЧАНИЯ
------------
1. Запросы с Postman слать на `http://localhost:8000` c префиксом `api`
2. При указании параметров в тело запроса в Postman рекомендуется использовать не `form-data`, а `x-www-form-urlencoded`!!! Иначе может прилететь пустой запрос...
3. JWT токен после аутентификации помещать в Postman в раздел `Authorization` c типом `Bearer Token`
