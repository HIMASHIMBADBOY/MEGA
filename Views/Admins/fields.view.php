<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Fields</title>
</head>
<body>
    <h1>Manage Fields</h1>
    <a href="../Views/Admins/dashboard.view.php">Back to Dashboard</a> | <a href="../signout.php">Logout</a>
    <h2>Add Fields</h2>
    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <form action="../../Includes/Admin.inc.php" method="POST">
        <label for="field_name">Name:</label>
        <input type="text" name="field_name" required><br>
        <label for="description">Description:</label>
        <input type="text" name="description" required><br>
        <label for="location">Location:</label>
        <input type="text" name="location" required><br>
        <button type="submit" name="submit">Add Field</button>
    </form>

    <h2>Field List</h2>
    <?php if (isset($data) && !empty($data)): ?>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($data as $field): ?>
                <tr>
                    <td><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                    <td>
                        <a href="edit_field.php?id=<?php echo $field['field_id'] ?? ''; ?>">Edit</a> |
                        <a href="delete_field.php?id=<?php echo $field['field_id'] ?? ''; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No new fields found.</p>
    <?php endif; ?>
</body>
</html>