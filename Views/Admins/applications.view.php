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
            <a href="ApplicationDenial.inc.php" class="btn btn-primary">Rejected Applications</a>
            <a href="../../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2>Application List</h2>
        <?php if (isset($applications) && !empty($applications)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Field ID</th>
                        <th>Status</th>
                        <th>Submission Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $application): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($application['user_id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($application['field_id'] ?? ''); ?></td>
                            <td><span class="status" data-id="<?php echo $application['id']; ?>"><?php echo htmlspecialchars($application['application_status'] ?? ''); ?></span></td>
                            <td><?php echo htmlspecialchars($application['submission_date'] ?? ''); ?></td>
                            <td>
                              <button onclick="updateApplicationStatus(<?php echo $application['id']; ?>, 'Approved')" class="btn btn-success btn-sm">Accept</button>
                              <button onclick="updateApplicationStatus(<?php echo $application['id']; ?>, 'Rejected')" class="btn btn-danger btn-sm">Reject</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No applications found.</p>
        <?php endif; ?>
    </div>
    <script src="../../Assets/status.js"></script>
</body>
</html>