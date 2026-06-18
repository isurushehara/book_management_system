<?php

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . APP_BASE . '/auth/signup.php');
    exit;
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$confirmPassword = (string) ($_POST['confirm_password'] ?? '');

if (strlen($username) < 3) {
    $_SESSION['signup_error'] = 'Username must be at least 3 characters long.';
    header('Location: ' . APP_BASE . '/auth/signup.php');
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['signup_error'] = 'Password must be at least 6 characters long.';
    header('Location: ' . APP_BASE . '/auth/signup.php');
    exit;
}

if ($password !== $confirmPassword) {
    $_SESSION['signup_error'] = 'Passwords do not match.';
    header('Location: ' . APP_BASE . '/auth/signup.php');
    exit;
}

$check = $pdo->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
$check->execute(['username' => $username]);

if ($check->fetch()) {
    $_SESSION['signup_error'] = 'That username is already taken.';
    header('Location: ' . APP_BASE . '/auth/signup.php');
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insert = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
$insert->execute([
    'username' => $username,
    'password' => $hashedPassword,
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Account created successfully. Please log in.',
];

header('Location: ' . APP_BASE . '/auth/login.php');
exit;