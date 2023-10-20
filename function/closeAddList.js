document.getElementById('addListButton').addEventListener('click', function () {
    document.getElementById('addListContainer').classList.remove('invisible');
});

document.getElementById('closeAddList').addEventListener('click', function () {
    document.getElementById('addListContainer').classList.add('invisible');
});
