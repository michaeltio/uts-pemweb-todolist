function showPopup(taskTitle) {
    const popup = document.getElementById('deleteConfirmContainer');
    const taskIdElement = document.getElementById('deleteContent');
    
    taskIdElement.textContent = taskTitle;

   
    popup.classList.remove('invisible');
}


document.getElementById('deleteConfirmContainer').addEventListener('click', function () {
    const popup = document.getElementById('popup');
    popup.classList.add('invisible');
});
