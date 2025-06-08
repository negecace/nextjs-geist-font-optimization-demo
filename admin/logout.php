<?php
session_start();

// Clear admin session
unset($_SESSION['admin_id']);
unset($_SESSION['is_admin']);

// Destroy all session data
session_destroy();

// Clear session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to admin login page
header('Location: login.php');
exit;
