CREATE DATABASE IF NOT EXISTS book_management;
USE book_management;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category VARCHAR(150) NOT NULL,
    isbn VARCHAR(50) DEFAULT NULL,
    published_year INT DEFAULT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    quantity INT NOT NULL DEFAULT 0,
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (username, password)
VALUES ('admin', 'admin123')
ON DUPLICATE KEY UPDATE username = username;

INSERT INTO books (title, author, category, isbn, published_year, price, quantity, description)
VALUES
    ('The Pragmatic Programmer', 'Andrew Hunt', 'Programming', '9780201616224', 1999, 42.50, 8, 'A classic guide to practical software craftsmanship.'),
    ('Clean Code', 'Robert C. Martin', 'Programming', '9780132350884', 2008, 38.00, 12, 'Patterns and practices for writing readable code.');