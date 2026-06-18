<?php

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
?>
<header class="topbar">
    <a class="brand" href="<?= APP_BASE ?>/dashboard.php">BookFlow</a>

    <nav class="nav-links" aria-label="Main navigation">
        <a class="<?= str_contains($currentPath, '/dashboard.php') ? 'active' : '' ?>" href="<?= APP_BASE ?>/dashboard.php">Dashboard</a>
        <a class="<?= str_contains($currentPath, '/books') ? 'active' : '' ?>" href="<?= APP_BASE ?>/books/index.php">Books</a>
        <a href="<?= APP_BASE ?>/books/create.php">Add Book</a>
    </nav>

    <div class="nav-user">
        <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        <a class="btn btn-ghost" href="<?= APP_BASE ?>/auth/logout.php">Logout</a>
    </div>
</header>