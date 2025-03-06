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
        <h1 class="text-center">Update Fields</h1>
        <div class="text-center mb-4">
            <a href="../Views/Admins/dashboard.view.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2>Add Fields</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <form action="../../Includes/fieldManage.inc.php" method="POST" class="bg-white p-4 shadow rounded">
            <div class="form-group">
                <label for="field_name">Name:</label>
                <input type="text" name="field_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-2" name="submit">Add Field</button>
        </form>

        <h2 class="mt-4">Field List</h2>
        <?php if (isset($data) && !empty($data)): ?>
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
                    <?php foreach ($data as $field): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                            <td>
                                <a href="edit_field.php?id=<?php echo $field['field_id'] ?? ''; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_field.php?id=<?php echo $field['field_id'] ?? ''; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No new fields found.</p>
        <?php endif; ?>
    </div>
</body>
</html>