//const btnOpen = document.getElementById('btn-crud-add');
//const btnClose = document.getElementById('btn-crud-close')


function openCreateAccount() {
    const frame = document.getElementById('createAccountFrame');
    frame.style.display = 'block';
}

function closeCreateAccount() {
    const frame = document.getElementById('createAccountFrame');
    frame.style.display = 'none';
}

function openUpdateAccount() {
    const frame = document.getElementById('updateAccountFrame');
    frame.style.display = 'block';
}

function closeUpdateAccount() {
    const frame = document.getElementById('updateAccountFrame');
    frame.style.display = 'none';
}

function showPassword() {
    const passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    }
    else {
        passwordInput.type = 'password';
    }
}