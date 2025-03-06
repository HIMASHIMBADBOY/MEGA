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
    <title>Apply for Field</title>
    <link href="../../Assets/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Apply for Field</h1>
        <div class="text-center mb-4">
            <a href="../../Includes/Student.inc.php" class="btn btn-secondary">Back to Fields</a>
            <a href="../signout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2>Field Details</h2>
        <?php if (isset($field)): ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($field['field_name'] ?? ''); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($field['description'] ?? ''); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($field['location'] ?? ''); ?></p>
        <?php else: ?>
            <p>No field details available.</p>
        <?php endif; ?>

        <h3>Instructions</h3>
        <p><b>Step 01:</b> download our resume template.</p>
        <a href="../../Assets/resume_template.docx" class="btn btn-info mb-3" download>Download Resume Template</a>
        <p><b>Step 02:</b> fill out all the required.</p>
        <p><b>Step 03:</b> upload the ready-filled resume.</p>
        <p><b>NB:</b> failure to write precise and valid information will cause the denial of your application form.</p>

        <h2>Application Form</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="post" action="applicationManage.inc.php?field_id=<?php echo $field_id; ?>" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
            <div class="form-group">
                <label for="resume">Resume:</label>
                <input type="file" name="resume" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cover_letter">Cover Letter:</label>
                <input type="file" name="cover_letter" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-2" name="submit">Apply</button>
        </form>
    </div>
</body>
</html>