<?php

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . APP_BASE . '/auth/login.php');
    exit;
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    $_SESSION['login_error'] = 'Please enter your username and password.';
    header('Location: ' . APP_BASE . '/auth/login.php');
    exit;
}

$stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :username LIMIT 1');
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if (!empty($user)) {
    $passwordInfo = password_get_info((string) $user['password']);
    $passwordIsHashed = ($passwordInfo['algo'] ?? 0) !== 0;
    $passwordIsValid = $passwordIsHashed
        ? password_verify($password, (string) $user['password'])
        : hash_equals((string) $user['password'], $password);

    if ($passwordIsValid) {
        if (!$passwordIsHashed) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $update = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');
            $update->execute([
                'password' => $hashedPassword,
                'id' => $user['id'],
            ]);
        }

        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['username'] = (string) $user['username'];
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Welcome back, ' . $user['username'] . '.',
        ];

        header('Location: ' . APP_BASE . '/dashboard.php');
        exit;
    }
}

$_SESSION['login_error'] = 'Invalid username or password.';
header('Location: ' . APP_BASE . '/auth/login.php');
exit;