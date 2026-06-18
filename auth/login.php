<?php

require_once __DIR__ . '/../config/database.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: ' . APP_BASE . '/dashboard.php');
    exit;
}

$loginError = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

$pageTitle = 'Login';
$bodyClass = 'auth-body';
$isAuthPage = true;
require_once __DIR__ . '/../includes/header.php';
?>

<section class="auth-card card auth-split">
    <div class="auth-main">
        <div class="auth-copy">
            <p class="eyebrow">Welcome back</p>
            <h1>Sign in to BookFlow</h1>
            <p class="muted">Manage your catalog, track inventory, and keep every title organized.</p>
        </div>

        <?php if ($loginError): ?>
            <div class="flash flash-error">
                <span><?= htmlspecialchars($loginError) ?></span>
            </div>
        <?php endif; ?>

        <form class="form-grid auth-form" action="login_process.php" method="post" autocomplete="off">
            <label>
                <span>Username</span>
                <input type="text" name="username" required>
            </label>

            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label>

            <button class="btn btn-primary btn-full" type="submit">Login</button>
        </form>

        <div class="auth-actions">
            <a class="btn btn-secondary btn-full" href="<?= APP_BASE ?>/auth/signup.php">Create account</a>
        </div>

       
    </div>

    <aside class="auth-aside" aria-label="BookFlow highlights">
        <div class="auth-aside-header">
            <p class="eyebrow">Quick glance</p>
            <h2>Interactive workspace</h2>
            <p class="muted">Tap a card to preview what the dashboard can do.</p>
        </div>

        <div class="feature-switcher" role="tablist" aria-label="Feature previews">
            <button class="feature-tab is-active" type="button" data-feature="catalog">Catalog</button>
            <button class="feature-tab" type="button" data-feature="inventory">Inventory</button>
            <button class="feature-tab" type="button" data-feature="reports">Reports</button>
        </div>

        <div class="feature-preview" data-feature-panel>
            <div class="feature-badge">Catalog overview</div>
            <h3>Browse every book in one place</h3>
            <p>Search titles, update records, and keep the collection organized without leaving the dashboard.</p>

            <div class="feature-stats">
                <div>
                    <strong>Fast search</strong>
                    <span>Find books by title, author, or ISBN</span>
                </div>
                <div>
                    <strong>Quick actions</strong>
                    <span>Edit, view, or delete with one click</span>
                </div>
            </div>
        </div>
    </aside>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>