<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link href="../../Assets/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            margin-top: 50px;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Manage Applications</h1>
        <div class="text-center mb-4">
            <a href="../Views/Admins/dashboard.view.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="applicationApproval.inc.php" class="btn btn-primary">Approved Applications</a>
            <a href="../../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2>Application List</h2>
        <?php if (isset($approved) && !empty($approved)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Field ID</th>
                        <th>Status</th>
                        <th>Resume</th>
                        <th>Cover letter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($approved as $application): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($application['user_id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($application['field_id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($application['application_status'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($application['resumee'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($application['cover_letter'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No applications found.</p>
        <?php endif; ?>
    </div>
</body>
</html>