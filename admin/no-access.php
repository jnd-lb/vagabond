<?php
// no-access.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="text-center p-4 bg-white rounded shadow">
        <h1 class="display-4 text-danger">Access Denied</h1>
        <p class="lead">You do not have permission to view this page.</p>
        <a href="../login.php" class="btn btn-primary">Go to Login</a>
        <a href="../index.php" class="btn btn-secondary ms-2">Go Home</a>
    </div>
</body>
</html>
