const btnOpenCreate = document.getElementById('btn-open-add-account');
const btnCloseCreate = document.getElementById('btn-close-add-account');
const btnOpenUpdate = document.getElementById('btn-open-update-account');
const btnCloseUpdate = document.getElementById('btn-close-update-account');

const createAccountFrame = document.getElementById('createAccountFrame');
const updateAccountFrame = document.getElementById('updateAccountFrame');

let username = document.getElementById('update-username');

//create account frame
btnOpenCreate.addEventListener('click', () => {
    createAccountFrame.style.display = 'block';
});

btnCloseCreate.addEventListener('click', () => {
    createAccountFrame.style.display = 'none';
});

//update account frame
btnOpenUpdate.addEventListener('click', () => {
    updateAccountFrame.style.display = 'block';
});

btnCloseUpdate.addEventListener('click', () => {
    updateAccountFrame.style.display = 'none';
});

function showPassword() {
    const passwordInput = document.getElementById('create-password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    }
    else {
        passwordInput.type = 'password';
    }
}