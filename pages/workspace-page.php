<?php
    session_start();
    require '../vendor/autoload.php';
    require '../init.php';
    require '../lib/Models/Task.php';
    use Models\Task;
    if (isset($_SESSION['username'])) {
        // User is logged in; allow access to the dashboard
    } else {
      
        header('Location: ./login-page.php'); // Redirect to the login page
        exit();
    }

    $userLogin = Task::getInstance("localhost", "root", "", "todolist");
    $userLogin->getData($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace | Priorilist</title>
</head>
<body class="bg-gradient-to-tr from-orange-500 to-purple-500">
    <div>
        Hello <?= $_SESSION['username'] ?>
    </div>
</body>
</html>