<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . APP_BASE . '/books/index.php');
    exit;
}

$bookId = (int) ($_POST['id'] ?? 0);

if ($bookId <= 0) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Invalid book selection.',
    ];

    header('Location: ' . APP_BASE . '/books/index.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM books WHERE id = :id');
$stmt->execute(['id' => $bookId]);

$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Book deleted successfully.',
];

header('Location: ' . APP_BASE . '/books/index.php');
exit;