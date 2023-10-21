<?php
    require '../../vendor/autoload.php';
    require '../../init.php';
    require '../Models/User.php';
    use Models\User;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        $login = User::getInstance("localhost", "root", "", "todolist");
        if($login->auth($username, $password)){
            header('location: ../../pages/workspace-page.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../pages/css/background.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login...</title>
</head>
<body>
    <div class="flex justify-center flex-col items-center h-screen">
        <div class="bg-white p-8 rounded-lg max-w-md mx-auto mt-8 text-center">
            <h1 class="text-2xl font-bold mb-4 h-16">Invalid Credentials</h1>
            <div class="flex justify-center space-x-4 items-center">
                <a href="../../pages/register-page.php" class="w-1/2 bg-blue-500 text-white p-2 rounded-md transition duration-300 hover:bg-blue-600 hover:shadow-md h-full">Don't have an account?</a>
                <a href="../../pages/login-page.php" class="w-1/2 bg-blue-500 text-white p-2 rounded-md transition duration-300 hover:bg-blue-600 hover:shadow-md h-full">Retry</a>
            </div>
        </div>
    </div>
</body>
</html>
