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
      <link rel="stylesheet" href="./css/background.css">
      <title>Workspace | Priorilist</title>
   </head>
   <body class="">
      <div>
         <div class="text-center mt-8">
            <button  button class="fixed top-0 right-0 m-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Log Out
            </button>
            <h1 class="font-bold text-5xl text-white ">PrioriList</h1>
            <p class="text-5xl text-white ">Hello, <?= $_SESSION['username'] ?> </p>
         </div>
         <div class="flex flex-wrap p-8 md:flex-nowrap md:justify-center md:gap-8">
            <div class="bg-neutral-50 mt-12 p-8 rounded-lg w-full md:w-1/4">
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

            <div class="bg-neutral-50 mt-12 p-8 rounded-lg w-full md:w-1/4">
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
      </div>
   </body>
</html>