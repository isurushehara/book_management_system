<?php

require_once __DIR__ . '/config/database.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: ' . APP_BASE . '/dashboard.php');
    exit;
}

header('Location: ' . APP_BASE . '/auth/login.php');
exit;