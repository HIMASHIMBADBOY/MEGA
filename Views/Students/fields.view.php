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
    <title>Available Fields</title>
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
        <div class="text-center mb-4">
            <a href="../Views/Students/dashboard.view.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2>Available Fields</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($fields) && !empty($fields)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fields as $field): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                            <td>
                                <a href="applicationManage.inc.php?field_id=<?php echo $field['field_id'] ?? ''; ?>" class="btn btn-primary btn-sm">Apply</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No fields available.</p>
        <?php endif; ?>
    </div>
</body>
</html>