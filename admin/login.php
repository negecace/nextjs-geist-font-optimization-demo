<?php
require_once '../inc/header.php';
require_once '../config.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Default admin credentials (as set in database.sql):
    // Username: admin
    // Password: admin123
    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_id'] = 1;
        $_SESSION['is_admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 400px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 3rem;">Admin Login</h1>

        <!-- Login Form -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <?php if ($error): ?>
                <div class="alert error" style="margin-bottom: 2rem; background: #fee2e2; color: #dc2626; padding: 1rem; border-radius: 4px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div style="margin-bottom: 1.5rem;">
                    <label for="username" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Username</label>
                    <input type="text" id="username" name="username" required autocomplete="username"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn" style="width: 100%; background: #000; color: #fff; border: none; padding: 1rem; font-size: 1.1rem; cursor: pointer; border-radius: 4px;">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Information -->
        <div style="margin-top: 2rem; text-align: center;">
            <p style="color: #666; font-size: 0.9rem;">
                For admin access issues, please contact the system administrator.
            </p>
        </div>
    </div>
</section>

<?php require_once '../inc/footer.php'; ?>
