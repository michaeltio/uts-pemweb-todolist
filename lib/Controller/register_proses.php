<?php    
    require '../../vendor/autoload.php';
    require '../../init.php';
    require '../Models/User.php';
    use Models\User;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        $user = User::getInstance("localhost", "root", "", "todolist");
        $user->insertData($username,$password);

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>register sucesfull</h1>
    <a href="../../pages/login-page.php">Login Now</a>
</body>
</html>