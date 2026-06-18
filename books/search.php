<?php

require_once __DIR__ . '/../config/database.php';

$query = trim((string) ($_GET['q'] ?? ''));
header('Location: ' . APP_BASE . '/books/index.php?q=' . urlencode($query));
exit;