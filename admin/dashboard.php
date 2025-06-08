<?php
require_once '../inc/header.php';
require_once '../config.php';

session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

// Dummy data for demonstration
$recent_registrations = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'date' => '2024-01-15',
        'status' => 'pending'
    ],
    [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'date' => '2024-01-16',
        'status' => 'active'
    ]
];

$recent_payments = [
    [
        'id' => 1,
        'student' => 'John Doe',
        'amount' => 50.00,
        'date' => '2024-01-15',
        'type' => 'Registration Fee',
        'status' => 'completed'
    ],
    [
        'id' => 2,
        'student' => 'Jane Smith',
        'amount' => 200.00,
        'date' => '2024-01-16',
        'type' => 'Monthly Lesson',
        'status' => 'completed'
    ]
];
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="margin-bottom: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Admin Dashboard</h1>
                <a href="logout.php" class="btn" style="background: #000; color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 4px;">
                    Logout
                </a>
            </div>
            
            <!-- Quick Actions -->
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="manage-students.php" style="background: #000; color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 4px;">
                    Manage Students
                </a>
                <a href="manage-fees.php" style="background: #000; color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 4px;">
                    Manage Fees
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 1rem;">Total Students</h3>
                <p style="font-size: 2rem; font-weight: 500;">25</p>
            </div>
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 1rem;">Monthly Revenue</h3>
                <p style="font-size: 2rem; font-weight: 500;">$5,000</p>
            </div>
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 1rem;">Pending Registrations</h3>
                <p style="font-size: 2rem; font-weight: 500;">3</p>
            </div>
        </div>

        <!-- Recent Registrations -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2>Recent Registrations</h2>
                <a href="registrations.php" style="color: #000; text-decoration: underline;">View All</a>
            </div>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">ID</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Name</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Email</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Date</th>
                            <th style="text-align: center; padding: 1rem; border-bottom: 2px solid #eee;">Status</th>
                            <th style="text-align: right; padding: 1rem; border-bottom: 2px solid #eee;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_registrations as $registration): ?>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo $registration['id']; ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($registration['name']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($registration['email']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo $registration['date']; ?></td>
                            <td style="text-align: center; padding: 1rem; border-bottom: 1px solid #eee;">
                                <span style="display: inline-block; padding: 0.25rem 0.75rem; background: <?php echo $registration['status'] === 'active' ? '#dcfce7' : '#fee2e2'; ?>; color: <?php echo $registration['status'] === 'active' ? '#16a34a' : '#dc2626'; ?>; border-radius: 9999px; font-size: 0.875rem;">
                                    <?php echo ucfirst($registration['status']); ?>
                                </span>
                            </td>
                            <td style="text-align: right; padding: 1rem; border-bottom: 1px solid #eee;">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="student_id" value="<?php echo $registration['id']; ?>">
                                    <button type="submit" name="action" value="approve" 
                                            style="background: #16a34a; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; margin-right: 0.5rem;">
                                        Approve
                                    </button>
                                    <a href="manage-students.php" style="color: #000; text-decoration: none;">View Details</a>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Payments -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2>Recent Payments</h2>
                <a href="payments.php" style="color: #000; text-decoration: underline;">View All</a>
            </div>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">ID</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Student</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Type</th>
                            <th style="text-align: right; padding: 1rem; border-bottom: 2px solid #eee;">Amount</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Date</th>
                            <th style="text-align: center; padding: 1rem; border-bottom: 2px solid #eee;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_payments as $payment): ?>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo $payment['id']; ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($payment['student']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($payment['type']); ?></td>
                            <td style="text-align: right; padding: 1rem; border-bottom: 1px solid #eee;">$<?php echo number_format($payment['amount'], 2); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo $payment['date']; ?></td>
                            <td style="text-align: center; padding: 1rem; border-bottom: 1px solid #eee;">
                                <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #dcfce7; color: #16a34a; border-radius: 9999px; font-size: 0.875rem;">
                                    <?php echo ucfirst($payment['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require_once '../inc/footer.php'; ?>
