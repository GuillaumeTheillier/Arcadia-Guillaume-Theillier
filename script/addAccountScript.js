const btnOpenCreate = document.getElementById('btn-open-add-account');
const btnCloseCreate = document.getElementById('btn-close-add-account');

const btnOpenUpdate = document.getElementsByClassName('btn-open-update-account');
const btnCloseUpdate = document.getElementById('btn-close-update-account');

const createAccountFrame = document.getElementById('create-account-frame');
const updateAccountFrame = document.getElementById('update-account-frame');

//create account frame
eventButtonOpen(btnOpenCreate, createAccountFrame);
eventButtonClose(btnCloseCreate, createAccountFrame);

//update account frame
for (let i = 0; i < btnOpenUpdate.length; i++) {
    eventButtonOpen(btnOpenUpdate[i], updateAccountFrame);
}
eventButtonClose(btnCloseUpdate, updateAccountFrame);


/**
 * Create an event, when we press a button open the frame
 * @param {HTMLElement} button button to press to open the frame
 * @param {HTMLElement} frame frame to open
 */
function eventButtonOpen(button, frame) {
    button.addEventListener('click', () => openFrame(frame));
}

/**
 * Create an event, when we press a button close the frame
 * @param {HTMLElement} button button to press to close the frame
 * @param {HTMLElement} frame frame to close
 */
function eventButtonClose(button, frame) {
    button.addEventListener('click', () => closeFrame(frame));
}

/**
 * Change the display style to 'block' so that the user see the frame
 * @param {HTMLElement} frame 
 */
function openFrame(frame) {
    frame.style.display = 'block';
}

/**
 * Change the display style to 'none' so that the user doesn't see the frame
 * @param {HTMLElement} frame 
 */
function closeFrame(frame) {
    frame.style.display = 'none';
}

// When we press a button the password change to text type to see it.
const passwordInput = document.getElementById('create-password');
const btnShowPassword = document.getElementById('checkbox-display-password');

btnShowPassword.addEventListener('click', () => {
    showPassword(passwordInput);
});
/**
 * Change the type of the input password so that the user see the password
 * @param {HTMLElement} passwordInput 
 */
function showPassword(passwordInput) {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    }
    else {
        passwordInput.type = 'password';
    }
}

// Recover the account data to display them in the frame

/*const usernameInput = document.getElementById('update-username');
const firstNameInput = document.getElementById('update-firstName');
const surnameInput = document.getElementById('update-surname');
const roleIput = document.getElementById('update-role');
const passwordInput = document.getElementById('update-password');*/