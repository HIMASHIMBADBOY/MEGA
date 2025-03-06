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
    <title>Student Dashboard</title>
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
        <h1 class="text-center">Student Dashboard</h1>
        <div class="text-center">
            <a href="../../Includes/Student.inc.php" class="btn btn-primary">View Available Fields</a>
            <a href="../../Includes/ApplicationResult.inc.php" class="btn btn-success">Applications Insights</a>
            <a href="profile.php" class="btn btn-secondary">View Profile</a>
            <a href="../../signout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>