<?php

if (empty($_SESSION['user_id'])) {
    header('Location: ' . APP_BASE . '/auth/login.php');
    exit;
}