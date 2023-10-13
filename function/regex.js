//untuk filter input
function filterInput(input) {
    var inputValue = input.value;
    var filteredValue = inputValue.replace(/[^a-zA-Z0-9]/g, ''); 
    if (filteredValue !== inputValue) {
        input.value = filteredValue;
    }
}