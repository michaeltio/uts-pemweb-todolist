<?php    
    require '../../vendor/autoload.php';
    require '../../init.php';
    require '../Models/User.php';
    use Models\User;


    $contentResult = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
    

        $state = '';
        $user = User::getInstance("localhost", "root", "", "todolist");
        // $username = mysqli_real_escape_string($user,$_POST['username']);
        // $password = mysqli_real_escape_string($user,$_POST['password']);
        if ($user->isUserAlreadyTaken($username)) {
            $state = "taken";
            $contentResult = "Username is already taken. Please choose a different one.";
        } else {
            $user->insertData($username, $password);
            $state = 'notTaken';
            $contentResult = "Registration successful.";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="../../pages/css/background.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register...</title>
</head>
<body>
    <div class="flex justify-center flex-col items-center h-screen">
        <div class="bg-white p-12 rounded-lg max-w-sm mx-auto mt-8">
            <h1 class="text-lg mb-4"><?= $contentResult ?></h1>
            <div class="flex justify-center text-center">
                <?php if ($state == "taken") { ?>
                    <a href="../../pages/register-page.php" class="bg-blue-500 text-white px-4 py-2 rounded-md mr-2 w-1/2">OK</a>
                    <a href="../../pages/register-page.php" class="bg-blue-500 text-white px-4 py-2 rounded-md w-1/2">LOGIN NOW</a>
                <?php } else { ?>
                    <a href="../../pages/login-page.php" class="bg-blue-500 text-white px-4 py-2 rounded-md">LOGIN NOW</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>