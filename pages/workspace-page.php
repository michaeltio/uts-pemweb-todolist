<?php
   session_start();
   require '../vendor/autoload.php';
   require '../init.php';
   require '../lib/Models/Task.php';
   use Models\Task;

   //deteksi kalo user belmo ada session
   if (!isset($_SESSION['username'])) {
      header('Location: ./login-page.php'); 
      exit();
   } 


   //nge fetch data
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

   //logout button, destroy session
   if (isset($_POST['logoutButton'])) {
      session_destroy();
  
      header("Location: login-page.php");
      exit();
  }
  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="/public/css/app.css">
      <link rel="stylesheet" href="./css/background.css">
      <title>Workspace | Priorilist</title>
   </head>
   <body class="">
      <div>
         <div class="text-center mt-8">
            <button id="logoutButton" class="fixed top-0 right-0 m-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
               Log Out
            </button>
            <h1 class="font-bold text-5xl text-white">PrioriList</h1>
            <p class="text-5xl text-white ">Hello, <?= $_SESSION['username'] ?> </p>
         </div>
         <div class="flex flex-wrap p-8 md:flex-nowrap md:justify-center md:gap-8">
            <div class="bg-neutral-50 mt-12 p-8 rounded-lg w-full md:w-full xl:w-1/4">
               <div class="flex justify-between">
                  <h1 class="font-bold text-center">List Kamu Sekarang</h1>
                  <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                     Tambah List
                  </button>
               </div>
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
                           <div class="flex items-center justify-center">
                              <input type="checkbox" <?= $row['isComplete'] ? 'checked' : '' ?> class="">
                           </div>
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
            <div class="bg-neutral-50 mt-12 p-8 rounded-lg w-full md:w-full xl:w-1/4">
               <h1 class="font-bold text-center">Sudah Selesai</h1>
               <table class="table-auto border-collapse border w-full mt-4">
                  <thead>
                     <tr>
                        <th class="bg-gray-100 border px-4 py-2">Task</th>
                        <th class="bg-gray-100 border px-4 py-2">Done</th>
                        <th class="bg-gray-100 border px-4 py-2">Delete</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($completedTasks as $row) {?>
                        <tr class="hover:bg-gray-200">
                           <td class="border px-4 py-2"><?= $row['title'] ?></td>
                           <td class="border px-4 py-2">
                              <div class="flex items-center justify-center">
                              <input type="checkbox" <?= $row['isComplete'] ? 'checked' : '' ?>>
                           </div>
                        </td>
                        <td class="border px-4 py-2">
                           <button class="border border-gray-500 hover:bg-red-500 hover:text-white  hover:border-white py-2 px-4 rounded w-full">
                              Hapus
                           </button>
                        </td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- logout -->
         <div id="logoutModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 invisible">
            <div class="bg-white p-4 rounded-lg shadow-md">
               <h1 class="text-2xl font-bold">Are you sure you want to log out?</h1>
               <form method="post">
                  <div class="mt-4 flex justify-center gap-8">
                     <button id="cancelButton" class="bg-gray-400 text-white p-2 rounded w-full">Cancel</button>
                     <button id="confirmButton" name="logoutButton" class="bg-red-500 text-white p-2 rounded w-full">Yes</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script src="../function/logoutPopUp.js"></script>
   </body>
</html>