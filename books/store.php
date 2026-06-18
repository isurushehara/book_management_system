<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . APP_BASE . '/books/create.php');
    exit;
}

$title = trim((string) ($_POST['title'] ?? ''));
$author = trim((string) ($_POST['author'] ?? ''));
$category = trim((string) ($_POST['category'] ?? ''));
$isbn = trim((string) ($_POST['isbn'] ?? ''));
$publishedYear = trim((string) ($_POST['published_year'] ?? ''));
$price = trim((string) ($_POST['price'] ?? '0'));
$quantity = trim((string) ($_POST['quantity'] ?? '0'));
$description = trim((string) ($_POST['description'] ?? ''));

if ($title === '' || $author === '' || $category === '') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Title, author, and category are required.',
    ];
    header('Location: ' . APP_BASE . '/books/create.php');
    exit;
}

$stmt = $pdo->prepare(
    'INSERT INTO books (title, author, category, isbn, published_year, price, quantity, description)
     VALUES (:title, :author, :category, :isbn, :published_year, :price, :quantity, :description)'
);

$stmt->execute([
    'title' => $title,
    'author' => $author,
    'category' => $category,
    'isbn' => $isbn !== '' ? $isbn : null,
    'published_year' => $publishedYear !== '' ? (int) $publishedYear : null,
    'price' => (float) $price,
    'quantity' => (int) $quantity,
    'description' => $description !== '' ? $description : null,
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Book added successfully.',
];

header('Location: ' . APP_BASE . '/books/index.php');
exit;