<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . APP_BASE . '/books/index.php');
    exit;
}

$bookId = (int) ($_POST['id'] ?? 0);
$title = trim((string) ($_POST['title'] ?? ''));
$author = trim((string) ($_POST['author'] ?? ''));
$category = trim((string) ($_POST['category'] ?? ''));
$isbn = trim((string) ($_POST['isbn'] ?? ''));
$publishedYear = trim((string) ($_POST['published_year'] ?? ''));
$price = trim((string) ($_POST['price'] ?? '0'));
$quantity = trim((string) ($_POST['quantity'] ?? '0'));
$description = trim((string) ($_POST['description'] ?? ''));

if ($bookId <= 0 || $title === '' || $author === '' || $category === '') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Please complete all required fields.',
    ];

    header('Location: ' . APP_BASE . '/books/edit.php?id=' . $bookId);
    exit;
}

$stmt = $pdo->prepare(
    'UPDATE books
        SET title = :title,
            author = :author,
            category = :category,
            isbn = :isbn,
            published_year = :published_year,
            price = :price,
            quantity = :quantity,
            description = :description
      WHERE id = :id'
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
    'id' => $bookId,
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Book updated successfully.',
];

header('Location: ' . APP_BASE . '/books/show.php?id=' . $bookId);
exit;