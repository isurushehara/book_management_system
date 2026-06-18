<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';

$pageTitle = 'Add Book';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="section-head">
    <div>
        <p class="eyebrow">New record</p>
        <h1>Add a Book</h1>
    </div>
    <a class="btn btn-secondary" href="<?= APP_BASE ?>/books/index.php">Back to books</a>
</section>

<section class="card form-card">
    <form class="form-grid" action="store.php" method="post">
        <label>
            <span>Title</span>
            <input type="text" name="title" required>
        </label>

        <label>
            <span>Author</span>
            <input type="text" name="author" required>
        </label>

        <label>
            <span>Category</span>
            <input type="text" name="category" required>
        </label>

        <label>
            <span>ISBN</span>
            <input type="text" name="isbn">
        </label>

        <label>
            <span>Published Year</span>
            <input type="number" name="published_year" min="0" max="9999">
        </label>

        <label>
            <span>Price</span>
            <input type="number" name="price" step="0.01" min="0" value="0.00" required>
        </label>

        <label>
            <span>Quantity</span>
            <input type="number" name="quantity" step="1" min="0" value="0" required>
        </label>

        <label class="full-width">
            <span>Description</span>
            <textarea name="description" rows="5"></textarea>
        </label>

        <button class="btn btn-primary" type="submit">Save Book</button>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>