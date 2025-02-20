<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Applications</title>
</head>
<body>
    <h1>Manage Applications</h1>
    <a href="dashboard.php">Back to Dashboard</a> | <a href="../../signout.php">Logout</a>
    <h2>Application List</h2>
    <?php if (isset($applications) && !empty($applications)): ?>
        <table>
            <tr>
                <th>Field Name</th>
                <th>Applicant Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($applications as $application): ?>
                <tr>
                    <td><?php echo htmlspecialchars($application['field_name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($application['applicant_name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($application['status'] ?? ''); ?></td>
                    <td>
                        <a href="update_application.php?id=<?php echo $application['id'] ?? ''; ?>&status=accepted">Accept</a> |
                        <a href="update_application.php?id=<?php echo $application['id'] ?? ''; ?>&status=rejected">Reject</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No applications found.</p>
    <?php endif; ?>
</body>
</html>