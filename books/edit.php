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

$pageTitle = 'Edit Book';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="section-head">
    <div>
        <p class="eyebrow">Update record</p>
        <h1>Edit Book</h1>
    </div>
    <a class="btn btn-secondary" href="<?= APP_BASE ?>/books/show.php?id=<?= (int) $book['id'] ?>">Back to details</a>
</section>

<section class="card form-card">
    <form class="form-grid" action="update.php" method="post">
        <input type="hidden" name="id" value="<?= (int) $book['id'] ?>">

        <label>
            <span>Title</span>
            <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
        </label>

        <label>
            <span>Author</span>
            <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
        </label>

        <label>
            <span>Category</span>
            <input type="text" name="category" value="<?= htmlspecialchars($book['category']) ?>" required>
        </label>

        <label>
            <span>ISBN</span>
            <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>">
        </label>

        <label>
            <span>Published Year</span>
            <input type="number" name="published_year" min="0" max="9999" value="<?= htmlspecialchars((string) ($book['published_year'] ?? '')) ?>">
        </label>

        <label>
            <span>Price</span>
            <input type="number" name="price" step="0.01" min="0" value="<?= htmlspecialchars((string) $book['price']) ?>" required>
        </label>

        <label>
            <span>Quantity</span>
            <input type="number" name="quantity" step="1" min="0" value="<?= (int) $book['quantity'] ?>" required>
        </label>

        <label class="full-width">
            <span>Description</span>
            <textarea name="description" rows="5"><?= htmlspecialchars($book['description'] ?? '') ?></textarea>
        </label>

        <button class="btn btn-primary" type="submit">Update Book</button>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>