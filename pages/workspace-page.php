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

  //deteksi untuk pembuatan list baru
   if (isset($_POST['addlistButton'])) {
      $taskTitle = $_POST['taskTitle'];
      $taskDescription = $_POST['taskDescription'];

      $userLogin->insertNewTask($_SESSION['username'], $taskTitle, $taskDescription);
      header('Location: workspace-page.php');
   }

   //checkbox listener
   if (isset($_POST['taskId']) && isset($_POST['isComplete'])) {
      $taskId = $_POST['taskId'];
      $isComplete = $_POST['isComplete'];
      $userLogin->updateCheckBox($taskId, $isComplete);
      header('Location: workspace-page.php');
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
   <body class="overflow-hidden">
      <div>
         <div class="text-center mt-8">
            <button id="logoutButton" class="fixed top-0 right-0 m-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
               Log Out
            </button>
            <h1 class="font-bold text-5xl text-white">PrioriList</h1>
            <p class="text-5xl text-white ">Hello, <?= $_SESSION['username'] ?> </p>
         </div>
         <!-- tabel list -->
         <div class="flex flex-wrap p-8 md:flex-nowrap md:justify-center md:gap-8 h-screen">
            <!-- tabel 1 -->
            <div class="bg-neutral-50 mt-12 p-8 rounded-lg w-full 2xl:w-1/4 h-4/6 overflow-x-auto">
               <div class="flex justify-between">
                  <h1 class="font-bold text-center">List Kamu Sekarang</h1>
                  <button id="addListButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
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
                              <input type="checkbox" <?= $row['isComplete'] ? 'checked' : '' ?> data-task-id="<?= $row['id_task']?>" >
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
            <!-- tabel 2 -->
            <div class="bg-neutral-50 mt-12 p-8 rounded-lg w-full 2xl:w-1/4 h-4/6 overflow-x-auto">
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
                              <input type="checkbox" <?= $row['isComplete'] ? 'checked' : '' ?> data-task-id="<?= $row['id_task']?>" >
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
         <!-- tambah list pop up -->
         <div id="addListContainer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 invisible">
            <div class="bg-white p-4 rounded-lg shadow-md">
               <div class="flex justify-between align-center">
                  <div class="flex items-stretch">
                     <h1 class="text-2xl font-bold text-center">Add New List</h1>
                  </div>
                  <button id="closeAddList" class="m-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-12">
                     <img src="../public/assets/images/close_round.svg" alt="">
                  </button>
               </div>
               <form method="post" class="bg-white p-6 rounded-lg shadow-md">
                  <label for="title" class="block mb-2">Title</label>
                  <input type="text" id="title" name="taskTitle" class="w-full p-2 border border-gray-300 rounded mb-4" require>

                  <label for="description" class="block mb-2">Description (optional)</label>
                  <textarea id="description" name="taskDescription" class="w-full p-2 border border-gray-300 rounded mb-4 h-32 resize-none"></textarea>

                  <button type="submit" name="addlistButton" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">
                     Add List
                  </button>
               </form>
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
      <script src="../function/closeAddList.js"></script>
      <script src="../function/checkBoxListener.js"></script>
   </body>
</html>