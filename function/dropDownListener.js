const dropdowns = document.querySelectorAll(".progressDropdown");
  dropdowns.forEach(function(dropdown) {
    dropdown.addEventListener("change", function() {
    
      var selectedValue = this.value;
      var taskId = this.getAttribute("data-task-id");

    
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../pages/workspace-page.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          location.reload();
        }
      };


      xhr.send(`selectedValue=${selectedValue}&taskId=${taskId}`);
    });
  });