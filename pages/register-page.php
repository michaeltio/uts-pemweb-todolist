<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: ./workspace-page.php'); 
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./../function/regex.js"></script>
    
    <title>Register | Priorilist</title>
</head>
<body class="bg-gradient-to-tr from-orange-500 to-purple-500">
    <div class="flex justify-center flex-col items-center h-screen">
        <form action="../lib/Controller/register_proses.php" method="post" class="bg-white p-12 rounded-lg max-w-sm mx-auto mt-8">
            <a href="./index.php"><-</a>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" id="username" name="username" oninput="filterInput(this)" class="input-required shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Username" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="input-required shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Register</button>
            </div>
        </form>

    </div>
</body>
</html>