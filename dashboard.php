<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';

$totalBooks = (int) $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();
$totalCategories = (int) $pdo->query('SELECT COUNT(DISTINCT category) FROM books')->fetchColumn();
$latestBooksStmt = $pdo->query('SELECT id, title, author, category, price, quantity FROM books ORDER BY created_at DESC LIMIT 5');
$latestBooks = $latestBooksStmt->fetchAll();

$pageTitle = 'Dashboard';
require_once __DIR__ . '/includes/header.php';
?>

<section class="hero card">
	<div>
		<p class="eyebrow">Overview</p>
		<h1>Book Management Dashboard</h1>
		<p class="muted">Track your catalog, manage inventory, and keep the library organized from one place.</p>
	</div>
	<div class="hero-actions">
		<a class="btn btn-primary" href="<?= APP_BASE ?>/books/create.php">Add Book</a>
		<a class="btn btn-secondary" href="<?= APP_BASE ?>/books/index.php">View Books</a>
	</div>
</section>

<section class="stats-grid">
	<article class="stat-card card">
		<span class="stat-label">Total Books</span>
		<strong class="stat-value"><?= number_format($totalBooks) ?></strong>
	</article>
	<article class="stat-card card">
		<span class="stat-label">Categories</span>
		<strong class="stat-value"><?= number_format($totalCategories) ?></strong>
	</article>
	<article class="stat-card card">
		<span class="stat-label">Signed In As</span>
		<strong class="stat-value"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></strong>
	</article>
</section>

<section class="card table-card">
	<div class="section-heading">
		<div>
			<p class="eyebrow">Latest Entries</p>
			<h2>Recently Added Books</h2>
		</div>
		<a class="link-button" href="<?= APP_BASE ?>/books/index.php">Open catalog</a>
	</div>

	<?php if ($latestBooks): ?>
		<div class="table-wrap">
			<table>
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Price</th>
						<th>Qty</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($latestBooks as $book): ?>
						<tr>
							<td><?= htmlspecialchars($book['title']) ?></td>
							<td><?= htmlspecialchars($book['author']) ?></td>
							<td><?= htmlspecialchars($book['category']) ?></td>
							<td>$<?= number_format((float) $book['price'], 2) ?></td>
							<td><?= (int) $book['quantity'] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php else: ?>
		<div class="empty-state">
			<p>No books have been added yet.</p>
			<a class="btn btn-primary" href="<?= APP_BASE ?>/books/create.php">Create your first book</a>
		</div>
	<?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
