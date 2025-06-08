<?php 
require_once 'inc/header.php';
require_once 'config.php';

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form processing will be implemented here
    // For now, we'll just show a success message
    $success = "Thank you for your message. We will get back to you soon!";
}
?>

<section style="padding: 4rem 0;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 3rem;">Contact Us</h1>

        <!-- Contact Information -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 1rem;">Studio Location</h3>
                <p style="margin-bottom: 0.5rem;">123 Music Avenue, Suite 100</p>
                <p style="margin-bottom: 0.5rem;">Anytown, ST 12345</p>
            </div>

            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 1rem;">Contact Details</h3>
                <p style="margin-bottom: 0.5rem;">Phone: (555) 123-4567</p>
                <p style="margin-bottom: 0.5rem;">Email: info@roycampbellpiano.com</p>
            </div>

            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 1rem;">Studio Hours</h3>
                <p style="margin-bottom: 0.5rem;">Monday - Friday: 9:00 AM - 7:00 PM</p>
                <p style="margin-bottom: 0.5rem;">Saturday: 10:00 AM - 4:00 PM</p>
                <p>Sunday: Closed</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="margin-bottom: 2rem;">Send us a Message</h2>

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

            <form method="POST">
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
                    <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Phone Number</label>
                    <input type="tel" id="phone" name="phone" 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="subject" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Subject *</label>
                    <input type="text" id="subject" name="subject" required 
                           style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="message" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Message *</label>
                    <textarea id="message" name="message" required 
                              style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; min-height: 150px;"></textarea>
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn" style="background: #000; color: #fff; border: none; padding: 1rem 2rem; font-size: 1.1rem; cursor: pointer;">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
