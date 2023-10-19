document.getElementById('logoutButton').addEventListener('click', function () {
    document.getElementById('logoutModal').classList.remove('invisible');
});

document.getElementById('cancelButton').addEventListener('click', function () {
    document.getElementById('logoutModal').classList.add('invisible');
});
