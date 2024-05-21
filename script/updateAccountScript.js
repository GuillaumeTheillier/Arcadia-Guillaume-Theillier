// When we press a button the password change to text type to see it.
const passwordInput = document.getElementById('update-password');
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