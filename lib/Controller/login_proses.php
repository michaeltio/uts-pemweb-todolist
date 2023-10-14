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
            echo "Hello {$_SESSION['username']}";
        }
        else{
            echo "invalid";
        }
    }
?>