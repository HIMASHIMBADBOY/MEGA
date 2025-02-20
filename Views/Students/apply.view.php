<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Field</title>
</head>
<body>
    <h1>Apply for Field</h1>
    <a href="fields.view.php">Back to Fields</a> | <a href="../logout.php">Logout</a>
    <h2>Field Details</h2>
    <?php if (isset($field)): ?>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($field['field_name'] ?? ''); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($field['description'] ?? ''); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($field['location'] ?? ''); ?></p>
    <?php else: ?>
        <p>No field details available.</p>
    <?php endif; ?>

    <h2>Application Form</h2>
    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form method="post" action="Application.inc.php?field_id=<?php echo $field_id; ?>" enctype="multipart/form-data">
        Resume: <input type="file" name="resume" required><br>
        Cover Letter: <input type="file" name="cover_letter" required><br>
        <button type="submit" name= "submit">Apply</button>
    </form>
</body>
</html>