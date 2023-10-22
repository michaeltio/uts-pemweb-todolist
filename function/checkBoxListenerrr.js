document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const finishTaskContainer = document.getElementById("finishTaskContainer");
    const yesFinish = document.getElementById("yesFinish");
    const noFinish = document.getElementById("noFinish");
    const h1Content = document.getElementById("h1Content");
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskId = this.getAttribute('data-task-id');
            const isComplete = this.checked ? 1 : 0;
            h1Content.textContent = isComplete ? "Are you sure you want to finish this task ?" : "Are you sure you want to unfinish this task?";
            finishTaskContainer.classList.remove('invisible');
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../pages/workspace-page.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    //console.log("change");
                    
                }
            };
            yesFinish.addEventListener('click', function(event) {
                xhr.send(`taskId=${taskId}&isComplete=${isComplete}`)
               
            });
            noFinish.addEventListener('click', function(event) {
                xhr.abort();
 
            });
          
        });
    });
});