# 🙎‍♂️Система аутентификации MVC

## 📋 Описание проекта
Проект представляет собой систему аутентификации с регистрацией, авторизацией через логин/пароль и через VK OAuth. Реализована защита от CSRF-атак, система ролей пользователей и логирование неудачных попыток входа.

## ✨ Основные функции
- ✅ Регистрация с помощью логина и пароля
- ✅ Авторизация через логин/пароль
- ✅ Авторизация через VK OAuth
- ✅ Защита от CSRF-атак
- ✅ Система ролей пользователей
- ✅ Защищенная страница с разным контентом для разных ролей
- ✅ Логирование неудачных попыток входа

## 📂 Структура проекта
```
📁 login/
├── 📁 app/
│   ├── 📁 controllers/
│   │   ├── 📄 AuthController.php
│   │   ├── 📄 VkAuthController.php
│   │   ├── 📄 ProtectedController.php
│   │   ├── 📄 DashboardController.php
│   │   └── 📄 HomeController.php
│   ├── 📁 core/
│   │   ├── 📄 Router.php
│   │   ├── 📄 Database.php
│   │   ├── 📄 Controller.php
│   │   ├── 📄 Model.php
│   │   └── 📄 Auth.php
│   ├── 📁 models/
│   │   ├── 📄 User.php
│   │   ├── 📄 AuthModel.php
│   │   ├── 📄 VkAuthModel.php
│   │   ├── 📄 CsrfModel.php
│   │   └── 📄 Logger.php
│   └── 📁 views/
│       ├── 📁 layouts/
│       │   ├── 📄 header.php
│       │   └── 📄 footer.php
│       ├── 📁 auth/
│       │   ├── 📄 register.php
│       │   └── 📄 login.php
│       ├── 📁 protected/
│       │   └── 📄 index.php
│       ├── 📁 dashboard/
│       │   └── 📄 index.php
│       └── 📁 home/
│           └── 📄 index.php
├── 📁 public/
│   ├── 📄 index.php
│   └── ⚙️ .htaccess
├── 📁 config/
│   └── 📄 config.php
├── 📁 logs/
│   └── 📄 auth_attempts.log
└── 📄 README.md
```


## ⚙️ Требования
- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx с поддержкой mod_rewrite
- Аккаунт разработчика VK для OAuth

## 🚀 Установка и настройка

### 1. Клонирование репозитория
```bash
git clone https://github.com/rwolfin/login.git
```

### 2. Настройка базы данных

Создайте базу данных и выполните SQL-запрос:

```SQL

CREATE DATABASE auth_db;
USE auth_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('regular', 'vk') NOT NULL DEFAULT 'regular',
    email VARCHAR(100) DEFAULT NULL,
    vk_user_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```


### 3. Настройка конфигурации

Отредактируйте файл ```config/config.php```:

```php
<?php
// Настройки базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'auth_db');
define('DB_USER', 'ваш_пользователь');
define('DB_PASS', 'ваш_пароль');

// Настройки VK OAuth
define('VK_CLIENT_ID', 'ваш_vk_app_id');
define('VK_CLIENT_SECRET', 'ваш_vk_app_secret');
define('VK_REDIRECT_URI', 'http://ваш-домен/vk_callback');

// Базовый URL
define('BASE_URL', 'http://ваш-домен');

// Настройки безопасности
define('CSRF_TOKEN_NAME', 'csrf_token');
```

### 4. Настройка VK OAuth

- Создайте приложение на VK для разработчиков

 -  В настройках приложения укажите:

    -   Standalone-приложение

    - Адрес сайта: http://ваш-домен

    - Базовый домен: ваш-домен

    - Callback API: http://ваш-домен/vk_callback

- Сохраните ID приложения и защищенный ключ

### 5. Настройка веб-сервера

Настройте веб-сервер так, чтобы корневой директорией была папка ```public/```
Пример для Apache (```/etc/apache2/sites-available/000-default.conf```):

```apache
<VirtualHost *:80>
    ServerName ваш-домен
    DocumentRoot /путь/к/login/public
    
    <Directory /путь/к/login/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 6. Права доступа

Убедитесь, что веб-сервер имеет права на запись в директорию ```logs/```:

```bash
chmod -R 775 logs/
```

## 🛠 Технологии

MVC-архитектура - четкое разделение логики, данных и представления

PDO - безопасная работа с базой данных

OAuth 2.0 - авторизация через VK

CSRF-защита - предотвращение межсайтовых запросов

PSR-4 - стандарт автозагрузки классов

## 🌐 Маршруты приложения

```/``` - Главная страница

```/register``` - Регистрация нового пользователя

```/login``` - Страница входа

```/dashboard``` - Личный кабинет

```/protected``` - Защищенная страница

```/logout``` - Выход из системы

```/vk_callback``` - Обработчик авторизации VK



## 🔒 Безопасность    

- Все пароли хранятся в хешированном виде

- Защита от CSRF-атак с помощью токенов

- Санитизация пользовательского ввода

- Логирование неудачных попыток входа

- Разделение привилегий пользователей


## 🪵 Логирование

Все неудачные попытки входа логируются в файл ```logs/auth_attempts.log``` в формате:

```text
[2023-12-15 14:30:45] Неудачная попытка входа для пользователя: test_user (IP: 192.168.1.1)
```

## 📝 Лицензия

MIT License. Используйте свободно и улучшайте под свои нужды.

---

> Разработано с ❤️ для учебных и демонстрационных целей в школе Skillfactory