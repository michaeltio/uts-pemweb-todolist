const popup = document.getElementById('deleteConfirmContainer');
const inputHidden = document.getElementById('taskIdInput');
const taskIdElement = document.getElementById('deleteContent');
function showPopup(taskTitle, taskId) {
    taskIdElement.textContent = taskTitle;
    inputHidden.value = taskId;
    popup.classList.remove('invisible');
}
function closePopUp(){
    popup.classList.add('invisible');
}


