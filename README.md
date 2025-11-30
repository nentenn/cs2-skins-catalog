Проєкт PixelSkins — це веб-каталог скінів CS2, створений на фреймворку Laravel.
Система дозволяє переглядати товари, фільтрувати їх за різними параметрами, переглядати детальну інформацію, додавати до улюблених, керувати корзиною та працювати через адмін-панель. Реалізовано архітектуру MVC, авторизацію (Laravel Breeze), роботу з базою даних, а також адаптивний інтерфейс на базі TailwindCSS.

У проєкті використовуються моделі: Product, Category, User, Favorite, CartItem; контролери ShopController, ProductController, CategoryController, FavoriteController, CartController, AdminController; Blade-шаблони для фронтенду та панелі адміністратора. База даних містить таблиці: users, products, categories, favorites, cart_items. За допомогою сидерів додано великий каталог скінів.

Основний функціонал сайту:
— виведення каталогу з пагінацією;
— пошук та фільтрація за категорією, ціною, рідкістю, якістю, StatTrak;
— сторінка товару з детальним описом та схожими товарами;
— система “Улюблені”;
— кошик: додавання/видалення/оновлення товарів;
— особистий кабінет користувача;
— адмін-панель з CRUD-операціями для товарів та категорій.

ER-зв'язки:

Category 1 → ∞ Product

User 1 → ∞ Favorite

Product 1 → ∞ Favorite

User 1 → ∞ CartItem

Product 1 → ∞ CartItem

Інструкція запуску:

Клонувати репозиторій|
git clone <repo_url>

Встановити залежності |
composer install

Встановити Node-пакети |
npm install && npm run build

Створити .env |
cp .env.example .env

Згенерувати ключ |
php artisan key:generate

Налаштувати | MySQL у .env

Виконати міграції |
php artisan migrate

Заповнити базу |
php artisan db:seed

Запустити сервер |
php artisan serve


