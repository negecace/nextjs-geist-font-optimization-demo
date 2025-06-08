<?php 
require_once 'inc/header.php';
require_once 'config.php';

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $level = $_POST['level'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($level) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // In a real application, you would:
        // 1. Hash the password
        // 2. Save the user data to database
        // 3. Handle file uploads
        // For now, we'll just store in session and redirect
        $_SESSION['registration'] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'level' => $level
        ];
        
        // Redirect to payment page
        header('Location: payment.php?type=registration');
        exit;
    }
}
?>

<section style="padding: 4rem 0;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 3rem;">Student Registration</h1>

        <?php if ($success): ?>
            <div class="alert success" style="margin-bottom: 2rem;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error" style="margin-bottom: 2rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <!-- Personal Information -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Personal Information</h2>
                
                <div style="margin-bottom: 1rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Full Name *</label>
                    <input type="text" id="name" name="name" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address *</label>
                    <input type="email" id="email" name="email" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="address" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Address *</label>
                    <textarea id="address" name="address" required 
                              style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; min-height: 100px;"></textarea>
                </div>
            </div>

            <!-- Musical Background -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Musical Background</h2>
                
                <div style="margin-bottom: 1rem;">
                    <label for="level" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Music Knowledge Level *</label>
                    <select id="level" name="level" required 
                            style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Select your level</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="experience" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Years of Experience</label>
                    <input type="number" id="experience" name="experience" min="0" 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Document Upload -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Documents</h2>
                
                <div style="margin-bottom: 1rem;">
                    <label for="resume" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Resume (PDF, DOC, DOCX) *</label>
                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="certificates" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Music Certificates (PDF, JPG, PNG)</label>
                    <input type="file" id="certificates" name="certificates" accept=".pdf,.jpg,.jpeg,.png"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Password Setup -->
            <div style="margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Account Setup</h2>
                
                <div style="margin-bottom: 1rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Create Password *</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="confirm_password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required autocomplete="new-password"
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Submit Button -->
            <div style="text-align: center;">
                <button type="submit" class="btn" style="background: #000; color: #fff; border: none; padding: 1rem 2rem; font-size: 1.1rem; cursor: pointer;">
                    Submit Registration
                </button>
            </div>
        </form>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
