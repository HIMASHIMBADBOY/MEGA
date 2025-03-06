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
    <title>Manage Fields</title>
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
        <h1 class="text-center">Manage Fields</h1>
        <div class="text-center mb-4">
            <a href="../Views/Admins/dashboard.view.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2 class="mt-4">Field List</h2>
        <?php if (isset($fields) && !empty($fields)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fields as $field): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                           
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No new fields found.</p>
        <?php endif; ?>

        <div class="text-center mb-4">
        <h4>Update Fields</h4>
        <a href="../Views/Admins/manageFields.view.php" class="btn btn-secondary">UPDATE</a>
        </div>
    </div>
</body>
</html>