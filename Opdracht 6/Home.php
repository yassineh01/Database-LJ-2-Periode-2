<?php
require_once 'Database.php';
session_start();

// Check if the user is not logged in, redirect to form.php
if (!isset($_SESSION['username'])) {
    header('Location: form.php');
    exit();
} else {
    $username = $_SESSION['username'];
}

$db = new Database();

// Handle logout
if (isset($_POST['logout'])) {
    $db->destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Welcome</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #007bff;
            margin-top: 50px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Welcome, <?php echo $username ?></h1>
        <form method="post" class="text-center">
            <button type="submit" name="logout" class="btn btn-primary">Logout</button>
        </form>
    </div>
</body>

</html>
