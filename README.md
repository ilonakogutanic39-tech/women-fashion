Встановлення проєкту на новий комп’ютер (Laragon)
1. Клонувати або розпакувати проєкт

Скопіюйте папку проєкту у директорію:

C:\laragon\www\


Наприклад:

C:\laragon\www\women-fashion

2. Встановити залежності
2.1. Встановити PHP-пакети

У папці проєкту виконати:

composer install

2.2. Встановити JavaScript залежності

(якщо Tailwind / npm використовується)

npm install
npm run build

3. Створити .env файл

Скопіювати приклад:

cp .env.example .env

4. Налаштувати базу даних у Laragon
4.1. Створити нову базу

Відкрити:

Menu → MySQL → Create new database

Назва наприклад:

women_fashion

4.2. Вказати дані у .env
DB_DATABASE=women_fashion
DB_USERNAME=root
DB_PASSWORD=


(за замовчуванням у Laragon пароль порожній)

5. Згенерувати ключ застосунку
php artisan key:generate

6. Виконати міграції
php artisan migrate

7. Створити символічне посилання на storage
php artisan storage:link

8. Запустити сервер (якщо потрібно не через Laragon)
php artisan serve


Зазвичай Laragon автоматично піднімає сайт за адресою:

http://women-fashion.test


або

http://localhost/women-fashion/public