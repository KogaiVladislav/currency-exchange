<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Сервис обмена валюты

Сервис для тестового задания разрабатывался на MacOS с использованием Laravel 8 и Laravel Valet


## Деплой проекта

Настроить .env скопировав .env.example и заполнив данные БД:
```
cp .env.example .env
```
Запустить установку пакетов composer:
```
composer install
```
Запустить миграции:
```
php artisan migrate
```
## Функционал
Создана artisan команда для загрузки последних курсов валют.
Доступна загрузка курсов валют только относительно USD, так как ключ приложения имеет ограниченный доступ, если изменить уровень доступа возможно загрузить любую валюту:
```
php artisan currencies:fetch USD
```
Команда внесена в планировщик задач и запускается с интервалом каждые 30 минут. Для включения планировщика, есть 2 варианта:

Первый это запустить в консоле команду:
```
php artisan schedule:work
```

Второй это добавить команду в cron, открыв планировщик:
```
crontab -e
```
и добвив команду в формате:
```
* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
```

## Документация
Документация генерируется командой:
```
php artisan scribe:generate
```

Если запустить приложение через команду:
```
php artisan serve
```
то Url документации:
```
http://localhost:8000/docs/index.html
```
