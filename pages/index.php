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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/public/css/tailwind.css" rel="stylesheet">
    <title>To do List</title>
</head>

<body class="bg-gradient-to-tr from-orange-500 to-purple-500">
    <div class="flex justify-center flex-col items-center h-screen">
        <h1 class="text-6xl text-center text-white raleway-bold">WELCOME TO PRIORILIST</h1>
        <p class="text-white text-lg">Stay Organized, Achieve More.</p>
        <div class="mt-4">
            <a href="./register-page.php" class="inline-block px-6 py-3 text-lg font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-full hover:shadow-lg transition duration-300 ease-in-out mr-4">Register</a>
            <a href="./login-page.php" class="inline-block px-6 py-3 text-lg font-semibold text-white bg-green-500 hover:bg-green-600 rounded-full hover:shadow-lg transition duration-300 ease-in-out">Login</a>
        </div>
    </div>
</body>
</html