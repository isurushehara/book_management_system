<?php

$pageTitle = $pageTitle ?? 'Book Management';
$bodyClass = $bodyClass ?? '';
$isAuthPage = $isAuthPage ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/style.css">
    <script defer src="<?= APP_BASE ?>/assets/js/script.js"></script>
</head>
<body class="<?= htmlspecialchars($bodyClass) ?>">
<div class="app-shell">
    <?php if (!$isAuthPage && !empty($_SESSION['user_id'])): ?>
        <?php require __DIR__ . '/navbar.php'; ?>
    <?php endif; ?>
    <main class="app-main">
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="flash flash-<?= htmlspecialchars($_SESSION['flash']['type'] ?? 'success') ?>">
                <span><?= htmlspecialchars($_SESSION['flash']['message'] ?? '') ?></span>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>