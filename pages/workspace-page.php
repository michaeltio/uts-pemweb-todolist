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

    $incompleteTasks = [];
    $completedTasks = [];

    while ($row = $taskList->fetch_assoc()) {
        if ($row['isComplete'] == 0) {
            $incompleteTasks[] = $row;
        } else {
            $completedTasks[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/public/css/app.css">
    <title>Workspace | Priorilist</title>
</head>
<body class="bg-gradient-to-tr from-orange-500 to-purple-500">
    <div class="">
        <div class="text-5xl text-white text-center mt-8">
            <h1 class="font-bold">PrioriList</h1>
            <p class="">Hello, <?= $_SESSION['username'] ?> </p>
        </div>
        <div class="flex flex-wrap md:flex-nowrap">
            <div class="bg-neutral-50 mx-auto mt-12 p-8 rounded-lg w-1/4">
                <h1 class="font-bold text-center">List Kamu Sekarang</h1>
                <table class="table-auto border-collapse border w-full mt-4">
                    <thead>
                        <tr>
                            <th class="bg-gray-100 border px-4 py-2">Task</th>
                            <th class="bg-gray-100 border px-4 py-2">Done</th>
                            <th class="bg-gray-100 border px-4 py-2">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incompleteTasks as $row) {?>
                            <tr class="hover:bg-gray-200">
                                <td class="border px-4 py-2"><?= $row['title'] ?></td>  
                                <td class="border px-4 py-2">
                                    <input type="checkbox" <?= $row['isComplete'] ? 'checked' : '' ?> class="">
                                </td>
                                <td class="border px-4 py-2">
                                    <select name="progressDropdown" class="w-full">
                                        <option value="plantodo">Plan To Do</option>
                                        <option value="onhold">On Hold</option>
                                        <option value="inprogress">In Progress</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="bg-neutral-50 mx-auto mt-12 p-8 rounded-lg w-1/4">
                <h1 class="font-bold text-center">Sudah Selesai</h1>
                <table class="table-auto border-collapse border w-full mt-4">
                    <thead>
                        <tr>
                            <th class="bg-gray-100 border px-4 py-2">Task</th>
                            <th class="bg-gray-100 border px-4 py-2">Done</th>
                            <th class="bg-gray-100 border px-4 py-2">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($completedTasks as $row) {?>
                            <tr class="hover:bg-gray-200">
                                <td class="border px-4 py-2"><?= $row['title'] ?></td>  
                                <td class="border px-4 py-2">
                                    <input type="checkbox" <?= $row['isComplete'] ? 'checked' : '' ?>>
                                </td>
                                <td class="border px-4 py-2">
                                    Hapus
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>