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
            <a href="../Views/Students/dashboard.view.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="../../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2>Application List</h2>
        <?php if (isset($result) && !empty($result)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Field Name</th>
                        <th>Submission Date</th>
                        <th>Application Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $results): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($results['field_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($results['submission_date'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($results['application_status'] ?? ''); ?></td>
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