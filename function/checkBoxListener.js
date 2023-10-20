document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskId = this.getAttribute('data-task-id');
            const isComplete = this.checked ? 1 : 0;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../pages/workspace-page.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`taskId=${taskId}&isComplete=${isComplete}`);
        });
    });
});