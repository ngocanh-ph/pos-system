CREATE DATABASE MAVPOS CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE MAVPOS;
-- USERS --
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    avatar VARCHAR(255) DEFAULT 'default_avatar.png',
    role ENUM('admin', 'staff') NOT NULL DEFAULT 'staff',
    status ENUM('active', 'locked') NOT NULL DEFAULT 'active',
    is_first_login TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- LOGIN TOKENS --
CREATE TABLE login_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(128) NOT NULL UNIQUE,
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
-- CATEGORIES --
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE
    SET NULL
);
-- PRODUCTS --
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barcode VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(200) NOT NULL,
    import_price DECIMAL(15, 2) NOT NULL DEFAULT 0,
    sale_price DECIMAL(15, 2) NOT NULL DEFAULT 0,
    category_id INT,
    image VARCHAR(255) DEFAULT 'default_product.png',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE
    SET NULL
);
-- CUSTOMERS --
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    address TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- ORDERS --
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    user_id INT,
    total_amount DECIMAL(15, 2) NOT NULL,
    amount_paid DECIMAL(15, 2) NOT NULL,
    change_amount DECIMAL(15, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE
    SET NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE
    SET NULL
);
-- ORDER ITEMS --
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(15, 2) NOT NULL,
    total_price DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
);
-- ADMIN DEFAULT --
INSERT INTO users (
        fullname,
        email,
        username,
        password,
        role,
        status,
        is_first_login
    )
VALUES (
        'Administrator',
        'admin@gmail.com',
        'admin',
        'admin',
        'admin',
        'active',
        0
    );