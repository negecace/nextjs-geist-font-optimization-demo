# Piano Studio of Roy Campbell LLC - Hosting Guide

This guide provides step-by-step instructions for hosting the Piano Studio website on Hostinger.

## Prerequisites

1. A Hostinger hosting account
2. Domain name (e.g., roycampbellpiano.com)
3. FTP client (e.g., FileZilla)
4. Database credentials from Hostinger
5. PayPal Business account
6. Stripe account

## Step 1: Database Setup

1. Log in to Hostinger control panel
2. Navigate to MySQL Databases
3. Create a new database:
   - Note down the database name, username, and password
4. Import the database schema:
   - Open phpMyAdmin
   - Select your database
   - Click "Import"
   - Choose the `database.sql` file
   - Click "Go" to import

## Step 2: Configure the Website

1. Update `config.php` with your credentials:
   ```php
   // Database settings
   define('DB_HOST', 'your_hostinger_mysql_host');
   define('DB_NAME', 'your_database_name');
   define('DB_USER', 'your_database_username');
   define('DB_PASS', 'your_database_password');

   // PayPal settings
   define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
   define('PAYPAL_SECRET', 'your_paypal_secret');

   // Stripe settings
   define('STRIPE_PUBLISHABLE_KEY', 'your_stripe_publishable_key');
   define('STRIPE_SECRET_KEY', 'your_stripe_secret_key');
   ```

## Step 3: Upload Files

1. Connect to your Hostinger account via FTP:
   - Host: your-ftp-host.hostinger.com
   - Username: your-ftp-username
   - Password: your-ftp-password

2. Upload all files to the public_html directory:
   ```
   public_html/
   ├── assets/
   │   ├── css/
   │   ├── images/
   │   └── uploads/
   ├── inc/
   ├── index.php
   ├── about.php
   ├── register.php
   ├── contact.php
   ├── login.php
   ├── dashboard.php
   ├── payment.php
   ├── edit-profile.php
   ├── logout.php
   └── config.php
   ```

3. Set proper permissions:
   - Directories: 755 (drwxr-xr-x)
   - Files: 644 (-rw-r--r--)
   - assets/uploads: 777 (drwxrwxrwx)

## Step 4: SSL Certificate

1. In Hostinger control panel:
   - Navigate to SSL/TLS section
   - Install Let's Encrypt SSL certificate
   - Enable HTTPS redirection

## Step 5: Payment Gateway Setup

### PayPal Integration:
1. Log in to PayPal Business account
2. Go to Developer Dashboard
3. Create new app to get API credentials
4. Update config.php with PayPal credentials
5. Configure IPN (Instant Payment Notification) URL:
   - Set to: https://yourdomain.com/payment-callback.php
   - Enable IPN in PayPal account settings

### Stripe Integration:
1. Log in to Stripe Dashboard
2. Get API keys from Developers section
3. Update config.php with Stripe credentials
4. Configure webhook endpoints:
   - Set to: https://yourdomain.com/stripe-webhook.php
   - Add relevant webhook events (payment_intent.succeeded, etc.)

## Step 6: Email Configuration

1. In Hostinger control panel:
   - Set up professional email (e.g., info@roycampbellpiano.com)
   - Configure PHP mail settings or SMTP
   - Test email functionality

## Step 7: Security Measures

1. Enable Hostinger Security Features:
   - ModSecurity
   - DDoS protection
   - IP blocking

2. File permissions check:
   ```bash
   find /path/to/public_html -type f -exec chmod 644 {} \;
   find /path/to/public_html -type d -exec chmod 755 {} \;
   chmod 777 /path/to/public_html/assets/uploads
   ```

3. Configure PHP settings:
   - display_errors = Off
   - error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
   - session.cookie_httponly = 1
   - session.cookie_secure = 1

## Step 8: Testing

1. Test all forms and functionality:
   - Registration process
   - Login/logout
   - Contact form
   - Payment processing
   - File uploads
   - Dashboard access

2. Test on multiple browsers:
   - Chrome
   - Firefox
   - Safari
   - Edge

3. Test responsive design on:
   - Desktop
   - Tablet
   - Mobile devices

## Step 9: Maintenance

1. Regular tasks:
   - Database backups (daily)
   - File backups (weekly)
   - SSL certificate renewal
   - PHP version updates
   - Security patches

2. Monitor:
   - Error logs
   - Payment transactions
   - User registrations
   - Server performance

## Support

For technical support or questions:
1. Hostinger support: support.hostinger.com
2. Email: support@roycampbellpiano.com
3. Documentation: Refer to inline code comments and PHP documentation

## Important Notes

1. Always maintain a local backup of all files and database
2. Keep payment gateway API keys secure
3. Regularly update PHP version and dependencies
4. Monitor error logs for issues
5. Keep regular backups of user uploads
6. Test payment system in sandbox mode first
7. Maintain SSL certificate validity

Remember to replace placeholder values (yourdomain.com, API keys, etc.) with actual values before going live.
