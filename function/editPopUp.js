const popUpEdit = document.getElementById('editListContainer');
const titleDate = document.getElementById("taskDate");
const titleInput = document.getElementById('taskEditTitle');
const descriptionInput = document.getElementById('taskEditDescription');
const hiddenTaskId = document.getElementById("hiddenTaskIdEdit");
function showEditPopUp(taskTitle, taskDescription, taskDate, taskId) {
    titleDate.textContent = taskDate;
    titleInput.value = taskTitle;
    descriptionInput.value = taskDescription;
    hiddenTaskId.value = taskId;
    popUpEdit.classList.remove('invisible');
}
function closeEditPopUp(){
    popUpEdit.classList.add('invisible');
}
