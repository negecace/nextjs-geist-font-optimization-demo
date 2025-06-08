<?php
require_once 'inc/header.php';
require_once 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

// Dummy data for demonstration
$student = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'phone' => '(555) 123-4567',
    'address' => '123 Main St, Anytown, ST 12345',
    'level' => 'intermediate',
    'years_experience' => 2
];

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form processing will be implemented here
    // For now, we'll just show a success message
    $success = "Profile updated successfully!";
}
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 3rem;">Edit Profile</h1>

        <?php if ($success): ?>
            <div class="alert success" style="margin-bottom: 2rem; background: #dcfce7; color: #16a34a; padding: 1rem; border-radius: 4px;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error" style="margin-bottom: 2rem; background: #fee2e2; color: #dc2626; padding: 1rem; border-radius: 4px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <!-- Personal Information -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Personal Information</h2>
                
                <div style="margin-bottom: 1rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Full Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="address" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Address</label>
                    <textarea id="address" name="address" required 
                              style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; min-height: 100px;"><?php echo htmlspecialchars($student['address']); ?></textarea>
                </div>
            </div>

            <!-- Musical Background -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Musical Background</h2>
                
                <div style="margin-bottom: 1rem;">
                    <label for="level" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Music Knowledge Level</label>
                    <select id="level" name="level" required 
                            style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="beginner" <?php echo $student['level'] == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                        <option value="intermediate" <?php echo $student['level'] == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                        <option value="advanced" <?php echo $student['level'] == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="experience" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Years of Experience</label>
                    <input type="number" id="experience" name="experience" value="<?php echo htmlspecialchars($student['years_experience']); ?>" min="0" 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Password Update -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Update Password</h2>
                <p style="margin-bottom: 1rem; color: #666;">Leave blank if you don't want to change your password</p>
                
                <div style="margin-bottom: 1rem;">
                    <label for="current_password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Current Password</label>
                    <input type="password" id="current_password" name="current_password"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="new_password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">New Password</label>
                    <input type="password" id="new_password" name="new_password"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="confirm_password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="dashboard.php" style="color: #666; text-decoration: none;">← Back to Dashboard</a>
                <button type="submit" class="btn" style="background: #000; color: #fff; border: none; padding: 1rem 2rem; font-size: 1.1rem; cursor: pointer;">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
