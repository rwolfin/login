<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'auth_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// VK 
define('VK_CLIENT_ID', 'YOUR_VK_APP_ID');
define('VK_CLIENT_SECRET', 'YOUR_VK_APP_SECRET');
define('VK_REDIRECT_URI', 'http://yourdomain.com/vk_callback');

// URL
define('BASE_URL', 'http://yourdomain.com');

// Security settings
define('CSRF_TOKEN_NAME', 'csrf_token');