<?php
require_once 'inc/header.php';
require_once 'config.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Login processing will be implemented here with database
    // For now, we'll just redirect to a dummy dashboard
    $_SESSION['student_id'] = 1; // Dummy session
    header('Location: dashboard.php');
    exit;
}
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 400px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 3rem;">Student Login</h1>

        <!-- Login Form -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <?php if ($error): ?>
                <div class="alert error" style="margin-bottom: 2rem;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Password</label>
                    <input type="password" id="password" name="password" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn" style="width: 100%; background: #000; color: #fff; border: none; padding: 1rem; font-size: 1.1rem; cursor: pointer; border-radius: 4px;">
                        Login
                    </button>
                </div>
            </form>

            <div style="margin-top: 2rem; text-align: center;">
                <p style="margin-bottom: 1rem;">Don't have an account?</p>
                <a href="register.php" style="color: #000; text-decoration: underline;">Register Now</a>
            </div>
        </div>

        <!-- Additional Information -->
        <div style="margin-top: 2rem; text-align: center;">
            <p style="color: #666; font-size: 0.9rem;">
                Having trouble logging in? Contact us at<br>
                <a href="mailto:support@roycampbellpiano.com" style="color: #000;">support@roycampbellpiano.com</a>
            </p>
        </div>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
