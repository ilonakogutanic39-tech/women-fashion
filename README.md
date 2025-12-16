# Women Fashion

Проєкт **Women Fashion** — інтернет-каталог та адмін-панель на **Laravel**, для управління товарами, категоріями та мудбордами.

Репозиторій: https://github.com/ilonakogutanic39-tech/women-fashion

## Коротко

Цей проєкт містить:
- CRUD для товарів та категорій
- Модель `Moodboard` та зв'язки з товарами
- Адмін-панель для менеджменту контенту
- Авторизацію (Laravel Breeze)

## Вимоги

- PHP 8.1+ (перевірте `composer.json`)
- Composer
- Node.js & npm
- MySQL (Laragon рекомендується на Windows)

## Інструкція встановлення (Laragon)

1. Скопіюйте папку проекту в `C:\laragon\www\women-fashion`

2. Встановіть PHP-пакети:

```bash
composer install
```

3. Встановіть JS-пакети та зберіть assets:

```bash
npm install
npm run dev     # для розробки
npm run build   # production
```

4. Створіть `.env` з прикладу і налаштуйте БД:

```bash
cp .env.example .env
# або скопіюйте вручну .env.example → .env
```

У `.env` вкажіть:

```
DB_DATABASE=women_fashion
DB_USERNAME=root
DB_PASSWORD=
APP_URL=http://localhost
```

5. Застосуйте міграції та (за потреби) сидери:

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

6. Запустіть сервер:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Відкрийте `http://127.0.0.1:8000` або ваш локальний домен Laragon.

## Запуск тестів

```bash
php artisan test
```

## Додатково

- Права на запис: переконайтесь, що папки `storage/` та `bootstrap/cache/` доступні для запису.
- Якщо будете розгортати на продакшн — згенеруйте оптимізовані автозавантаження та зберіть фронтенд для production.

## Автор

ilonakogutanic39-tech — https://github.com/ilonakogutanic39-tech

## Структура проєкту

Орієнтовна файлово-папкова структура проєкту:

```
women-fashion/
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── Admin/ (адмінські контролери)
│   │   │   ├── CategoryController.php
│   │   │   ├── ProductController.php
│   │   │   └── MoodboardController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   └── Moodboard.php
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── assets/
│   └── index.php
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── auth/
│       ├── admin/
│       ├── categories/
│       ├── products/
│       └── moodboards/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
├── tests/
├── .env.example
├── composer.json
├── package.json
└── README.md
```
