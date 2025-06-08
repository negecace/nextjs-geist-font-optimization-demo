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
    'level' => 'Intermediate',
    'registration_date' => '2024-01-15',
    'status' => 'Active'
];

$payments = [
    [
        'date' => '2024-01-15',
        'description' => 'Registration Fee',
        'amount' => 50.00,
        'status' => 'Paid'
    ],
    [
        'date' => '2024-02-01',
        'description' => 'Monthly Lesson Fee - February',
        'amount' => 200.00,
        'status' => 'Paid'
    ]
];
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <!-- Welcome Header -->
        <div style="margin-bottom: 3rem;">
            <h1 style="margin-bottom: 1rem;">Welcome, <?php echo htmlspecialchars($student['name']); ?></h1>
            <p style="color: #666;">Student Dashboard</p>
        </div>

        <!-- Dashboard Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Profile Section -->
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2 style="margin-bottom: 1.5rem;">Profile Information</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <p style="margin-bottom: 0.5rem; color: #666;">Name</p>
                    <p style="font-weight: 500;"><?php echo htmlspecialchars($student['name']); ?></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <p style="margin-bottom: 0.5rem; color: #666;">Email</p>
                    <p style="font-weight: 500;"><?php echo htmlspecialchars($student['email']); ?></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <p style="margin-bottom: 0.5rem; color: #666;">Phone</p>
                    <p style="font-weight: 500;"><?php echo htmlspecialchars($student['phone']); ?></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <p style="margin-bottom: 0.5rem; color: #666;">Level</p>
                    <p style="font-weight: 500;"><?php echo htmlspecialchars($student['level']); ?></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <p style="margin-bottom: 0.5rem; color: #666;">Registration Date</p>
                    <p style="font-weight: 500;"><?php echo htmlspecialchars($student['registration_date']); ?></p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <p style="margin-bottom: 0.5rem; color: #666;">Status</p>
                    <p style="font-weight: 500; color: #16a34a;"><?php echo htmlspecialchars($student['status']); ?></p>
                </div>

                <a href="edit-profile.php" class="btn" style="display: inline-block; background: #000; color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 4px;">
                    Edit Profile
                </a>
            </div>

            <!-- Payment History Section -->
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2>Payment History</h2>
                    <a href="payment.php" class="btn" style="background: #000; color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 4px;">
                        Make Payment
                    </a>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Date</th>
                                <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Description</th>
                                <th style="text-align: right; padding: 1rem; border-bottom: 2px solid #eee;">Amount</th>
                                <th style="text-align: center; padding: 1rem; border-bottom: 2px solid #eee;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">
                                    <?php echo htmlspecialchars($payment['date']); ?>
                                </td>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">
                                    <?php echo htmlspecialchars($payment['description']); ?>
                                </td>
                                <td style="text-align: right; padding: 1rem; border-bottom: 1px solid #eee;">
                                    $<?php echo number_format($payment['amount'], 2); ?>
                                </td>
                                <td style="text-align: center; padding: 1rem; border-bottom: 1px solid #eee;">
                                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #dcfce7; color: #16a34a; border-radius: 9999px; font-size: 0.875rem;">
                                        <?php echo htmlspecialchars($payment['status']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Upcoming Lessons Section -->
        <div style="margin-top: 2rem; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="margin-bottom: 1.5rem;">Upcoming Lessons</h2>
            <p style="color: #666;">No upcoming lessons scheduled. Contact the studio to schedule your next lesson.</p>
        </div>

        <!-- Quick Actions -->
        <div style="margin-top: 2rem; text-align: center;">
            <a href="logout.php" style="color: #666; text-decoration: underline;">Logout</a>
        </div>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
