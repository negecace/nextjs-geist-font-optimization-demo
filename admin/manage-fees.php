<?php
require_once '../inc/header.php';
require_once '../config.php';

session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

$success = $error = '';

// Handle fee updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
                $fee_id = $_POST['fee_id'] ?? '';
                $amount = $_POST['amount'] ?? '';
                $is_active = isset($_POST['is_active']) ? 1 : 0;
                
                if (!empty($fee_id) && !empty($amount)) {
                    // Update fee in database
                    $success = "Fee updated successfully";
                }
                break;
                
            case 'add':
                $fee_type = $_POST['fee_type'] ?? '';
                $amount = $_POST['amount'] ?? '';
                $description = $_POST['description'] ?? '';
                
                if (!empty($fee_type) && !empty($amount)) {
                    // Add new fee to database
                    $success = "New fee added successfully";
                }
                break;
        }
    }
}

// Dummy fee data for demonstration
$fees = [
    [
        'id' => 1,
        'fee_type' => 'Registration Fee',
        'amount' => 50.00,
        'description' => 'One-time registration fee for new students',
        'is_active' => true,
        'last_updated' => '2024-01-15'
    ],
    [
        'id' => 2,
        'fee_type' => 'Monthly Lesson Fee',
        'amount' => 200.00,
        'description' => 'Monthly piano lesson fee',
        'is_active' => true,
        'last_updated' => '2024-01-15'
    ],
    [
        'id' => 3,
        'fee_type' => 'Private Lesson',
        'amount' => 75.00,
        'description' => 'Single private lesson (1 hour)',
        'is_active' => true,
        'last_updated' => '2024-01-15'
    ]
];
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <h1>Manage Fees</h1>
            <div>
                <a href="dashboard.php" style="color: #666; text-decoration: none; margin-right: 1rem;">← Back to Dashboard</a>
            </div>
        </div>

        <?php if ($success): ?>
            <div style="background: #dcfce7; color: #16a34a; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div style="background: #fee2e2; color: #dc2626; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Add New Fee -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h2 style="margin-bottom: 1.5rem;">Add New Fee</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem;">Fee Type</label>
                        <input type="text" name="fee_type" required 
                               style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem;">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" required 
                               style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                </div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem;">Description</label>
                    <textarea name="description" required 
                              style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                </div>
                <button type="submit" 
                        style="background: #000; color: #fff; border: none; padding: 0.8rem 1.5rem; border-radius: 4px; cursor: pointer;">
                    Add Fee
                </button>
            </form>
        </div>

        <!-- Existing Fees -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="margin-bottom: 1.5rem;">Current Fees</h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Fee Type</th>
                            <th style="text-align: right; padding: 1rem; border-bottom: 2px solid #eee;">Amount</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Description</th>
                            <th style="text-align: center; padding: 1rem; border-bottom: 2px solid #eee;">Status</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Last Updated</th>
                            <th style="text-align: right; padding: 1rem; border-bottom: 2px solid #eee;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fees as $fee): ?>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">
                                <form method="POST">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="fee_id" value="<?php echo $fee['id']; ?>">
                                    <?php echo htmlspecialchars($fee['fee_type']); ?>
                            </td>
                            <td style="text-align: right; padding: 1rem; border-bottom: 1px solid #eee;">
                                <input type="number" name="amount" value="<?php echo $fee['amount']; ?>" step="0.01" required
                                       style="width: 100px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; text-align: right;">
                            </td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">
                                <?php echo htmlspecialchars($fee['description']); ?>
                            </td>
                            <td style="text-align: center; padding: 1rem; border-bottom: 1px solid #eee;">
                                <label style="display: inline-flex; align-items: center; cursor: pointer;">
                                    <input type="checkbox" name="is_active" <?php echo $fee['is_active'] ? 'checked' : ''; ?>
                                           style="margin-right: 0.5rem;">
                                    Active
                                </label>
                            </td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">
                                <?php echo $fee['last_updated']; ?>
                            </td>
                            <td style="text-align: right; padding: 1rem; border-bottom: 1px solid #eee;">
                                <button type="submit" 
                                        style="background: #000; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;">
                                    Update
                                </button>
                                </form>
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
