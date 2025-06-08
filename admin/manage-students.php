<?php
require_once '../inc/header.php';
require_once '../config.php';

session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

// Handle student status updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $student_id = $_POST['student_id'] ?? '';
    $action = $_POST['action'];
    
    switch ($action) {
        case 'approve':
            // Update student status to active
            $success = "Student approved successfully";
            break;
        case 'suspend':
            // Update student status to suspended
            $success = "Student suspended successfully";
            break;
        case 'delete':
            // Delete student
            $success = "Student deleted successfully";
            break;
    }
}

// Dummy student data for demonstration
$students = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '(555) 123-4567',
        'level' => 'Intermediate',
        'status' => 'pending',
        'registration_date' => '2024-01-15'
    ],
    [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'phone' => '(555) 987-6543',
        'level' => 'Advanced',
        'status' => 'active',
        'registration_date' => '2024-01-16'
    ]
];
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <h1>Manage Students</h1>
            <div>
                <a href="dashboard.php" style="color: #666; text-decoration: none; margin-right: 1rem;">← Back to Dashboard</a>
            </div>
        </div>

        <?php if (isset($success)): ?>
            <div style="background: #dcfce7; color: #16a34a; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- Students Table -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">ID</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Name</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Email</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Phone</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Level</th>
                            <th style="text-align: left; padding: 1rem; border-bottom: 2px solid #eee;">Registration Date</th>
                            <th style="text-align: center; padding: 1rem; border-bottom: 2px solid #eee;">Status</th>
                            <th style="text-align: right; padding: 1rem; border-bottom: 2px solid #eee;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo $student['id']; ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($student['name']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($student['email']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($student['phone']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($student['level']); ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?php echo $student['registration_date']; ?></td>
                            <td style="text-align: center; padding: 1rem; border-bottom: 1px solid #eee;">
                                <span style="display: inline-block; padding: 0.25rem 0.75rem; background: <?php echo $student['status'] === 'active' ? '#dcfce7' : '#fee2e2'; ?>; color: <?php echo $student['status'] === 'active' ? '#16a34a' : '#dc2626'; ?>; border-radius: 9999px; font-size: 0.875rem;">
                                    <?php echo ucfirst($student['status']); ?>
                                </span>
                            </td>
                            <td style="text-align: right; padding: 1rem; border-bottom: 1px solid #eee;">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                    <?php if ($student['status'] === 'pending'): ?>
                                        <button type="submit" name="action" value="approve" 
                                                style="background: #16a34a; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; margin-right: 0.5rem;">
                                            Approve
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($student['status'] === 'active'): ?>
                                        <button type="submit" name="action" value="suspend"
                                                style="background: #dc2626; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; margin-right: 0.5rem;">
                                            Suspend
                                        </button>
                                    <?php endif; ?>
                                    <button type="submit" name="action" value="delete" 
                                            style="background: #000; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;"
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                        Delete
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
