<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

$bookId = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $bookId]);
$book = $stmt->fetch();

if (!$book) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Book not found.',
    ];

    header('Location: ' . APP_BASE . '/books/index.php');
    exit;
}

$pageTitle = $book['title'];
require_once __DIR__ . '/../includes/header.php';
?>

<section class="section-head">
    <div>
        <p class="eyebrow">Book details</p>
        <h1><?= htmlspecialchars($book['title']) ?></h1>
        <p class="muted">Complete record for the selected book.</p>
    </div>
    <div class="hero-actions">
        <a class="btn btn-secondary" href="<?= APP_BASE ?>/books/index.php">Back to books</a>
        <a class="btn btn-primary" href="<?= APP_BASE ?>/books/edit.php?id=<?= (int) $book['id'] ?>">Edit Book</a>
    </div>
</section>

<section class="card details-grid">
    <div class="detail-item">
        <span>Author</span>
        <strong><?= htmlspecialchars($book['author']) ?></strong>
    </div>
    <div class="detail-item">
        <span>Category</span>
        <strong><?= htmlspecialchars($book['category']) ?></strong>
    </div>
    <div class="detail-item">
        <span>ISBN</span>
        <strong><?= htmlspecialchars($book['isbn'] ?? 'N/A') ?></strong>
    </div>
    <div class="detail-item">
        <span>Published Year</span>
        <strong><?= htmlspecialchars((string) ($book['published_year'] ?? 'N/A')) ?></strong>
    </div>
    <div class="detail-item">
        <span>Price</span>
        <strong>$<?= number_format((float) $book['price'], 2) ?></strong>
    </div>
    <div class="detail-item">
        <span>Quantity</span>
        <strong><?= (int) $book['quantity'] ?></strong>
    </div>
    <div class="detail-item full-width">
        <span>Description</span>
        <p><?= nl2br(htmlspecialchars($book['description'] ?? 'No description provided.')) ?></p>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>