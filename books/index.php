<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

$search = trim((string) ($_GET['q'] ?? ''));

if ($search !== '') {
    $stmt = $pdo->prepare(
        'SELECT * FROM books
         WHERE title LIKE :term
            OR author LIKE :term
            OR category LIKE :term
            OR isbn LIKE :term
         ORDER BY created_at DESC'
    );
    $stmt->execute(['term' => '%' . $search . '%']);
} else {
    $stmt = $pdo->query('SELECT * FROM books ORDER BY created_at DESC');
}

$books = $stmt->fetchAll();

$pageTitle = 'Books';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="section-head">
    <div>
        <p class="eyebrow">Catalog</p>
        <h1>Books</h1>
        <p class="muted">Browse, search, create, and manage every title in the collection.</p>
    </div>

    <a class="btn btn-primary" href="<?= APP_BASE ?>/books/create.php">Add Book</a>
</section>

<section class="card toolbar-card">
    <form class="search-form" action="search.php" method="get">
        <input type="search" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search by title, author, category, or ISBN">
        <button class="btn btn-secondary" type="submit">Search</button>
    </form>
</section>

<section class="card table-card">
    <?php if ($books): ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>ISBN</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= htmlspecialchars($book['category']) ?></td>
                            <td><?= htmlspecialchars($book['isbn'] ?? '') ?></td>
                            <td><?= htmlspecialchars((string) ($book['published_year'] ?? '')) ?></td>
                            <td>$<?= number_format((float) $book['price'], 2) ?></td>
                            <td><?= (int) $book['quantity'] ?></td>
                            <td>
                                <div class="row-actions">
                                    <a class="link-button" href="show.php?id=<?= (int) $book['id'] ?>">View</a>
                                    <a class="link-button" href="edit.php?id=<?= (int) $book['id'] ?>">Edit</a>
                                    <form action="delete.php" method="post" class="inline-form" data-confirm="Delete this book?">
                                        <input type="hidden" name="id" value="<?= (int) $book['id'] ?>">
                                        <button class="danger-link" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>No books found.</p>
            <a class="btn btn-primary" href="<?= APP_BASE ?>/books/create.php">Add your first book</a>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>