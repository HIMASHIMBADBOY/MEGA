<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Fields</title>
</head>
<body>
    <a href="dashboard.view.php">Back to Dashboard</a> | <a href="../logout.php">Logout</a>
    <h2>Available Fields</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <?php if (isset($fields) && !empty($fields)): ?>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($fields as $field): ?>
                <tr>
                    <td><?php echo htmlspecialchars($field['field_name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($field['description'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($field['location'] ?? ''); ?></td>
                    <td>
                        <a href="Application.inc.php?field_id=<?php echo $field['field_id'] ?? ''; ?>">Apply</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No fields available.</p>
    <?php endif; ?>
</body>
</html>