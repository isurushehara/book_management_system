<?php

require_once __DIR__ . '/../config/database.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: ' . APP_BASE . '/dashboard.php');
    exit;
}

$signupError = $_SESSION['signup_error'] ?? '';
unset($_SESSION['signup_error']);

$pageTitle = 'Sign Up';
$bodyClass = 'auth-body';
$isAuthPage = true;
require_once __DIR__ . '/../includes/header.php';
?>

<section class="auth-card card auth-split">
    <div class="auth-main">
        <div class="auth-copy">
            <p class="eyebrow">Get started</p>
            <h1>Create your BookFlow account</h1>
            <p class="muted">Set up a new account to manage books, inventory, and daily catalog tasks.</p>
        </div>

        <?php if ($signupError): ?>
            <div class="flash flash-error">
                <span><?= htmlspecialchars($signupError) ?></span>
            </div>
        <?php endif; ?>

        <form class="form-grid auth-form" action="signup_process.php" method="post" autocomplete="off">
            <label>
                <span>Username</span>
                <input type="text" name="username" minlength="3" maxlength="100" required>
            </label>

            <label>
                <span>Password</span>
                <input type="password" name="password" minlength="6" required>
            </label>

            <label>
                <span>Confirm Password</span>
                <input type="password" name="confirm_password" minlength="6" required>
            </label>

            <button class="btn btn-primary btn-full" type="submit">Create Account</button>
        </form>

        <p class="auth-note">
            Already have an account?
            <a href="<?= APP_BASE ?>/auth/login.php"><strong>Login here</strong></a>
        </p>
    </div>

    <aside class="auth-aside" aria-label="Account creation tips">
        <div class="auth-aside-header">
            <p class="eyebrow">Why sign up</p>
            <h2>Your own workspace</h2>
            <p class="muted">Make a personal account and keep your library workflow organized.</p>
        </div>

        <div class="feature-preview signup-preview">
            <div class="feature-badge">Secure access</div>
            <h3>Store your password safely</h3>
            <p>Every new account is saved with a hashed password and checked against duplicates before creation.</p>

            <div class="feature-stats">
                <div>
                    <strong>Unique usernames</strong>
                    <span>No two accounts can share the same login name</span>
                </div>
                <div>
                    <strong>Fast onboarding</strong>
                    <span>Create an account and start using the app right away</span>
                </div>
            </div>
        </div>
    </aside>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>