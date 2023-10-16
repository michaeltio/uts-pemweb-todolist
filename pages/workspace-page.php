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
    $taskList = $userLogin->getData($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Workspace | Priorilist</title>
</head>
<body class="bg-gradient-to-tr from-orange-500 to-purple-500">
    <div class="">
        <div class="text-5xl text-white text-center mt-8">
            <h1 class="font-bold">PrioriList</h1>
            <p class="">Hello, <?= $_SESSION['username'] ?> </p>
        </div>
        <div class="bg-neutral-50 mx-auto mt-12 p-8 rounded-lg w-96">
            <h1 class="font-bold">List Kamu Sekarang</h1>
            <table class="table-auto border-collapse border">
                <thead>
                    <tr>
                        <th class="bg-gray-100 border px-4 py-2">Title</th>
                        <th class="bg-gray-100 border px-4 py-2">isComplete</th>
                        <th class="bg-gray-100 border px-4 py-2">Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $taskList->fetch_assoc()) { ?>
                        <tr class="hover:bg-gray-200">
                            <td class="border px-4 py-2"><?= "{$row['title']}" ?></td>  
                            <td class="border px-4 py-2"><?= "{$row['isComplete']}" ?></td>
                            <td class="border px-4 py-2"><?= "{$row['progress']}" ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>