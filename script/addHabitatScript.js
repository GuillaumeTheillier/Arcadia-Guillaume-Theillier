const btnOpen = document.getElementById('btn-open-add-habitat');
const btnClose = document.getElementById('btn-close-add-habitat');
const createHabitatFrame = document.getElementById('create-habitat-frame');

const body = document.getElementById('body');

btnOpen.addEventListener('click', () => {
    createHabitatFrame.style.display = 'block';
    body.style.overflow = 'hidden';
});

btnClose.addEventListener('click', () => {
    createHabitatFrame.style.display = 'none';
    body.style.overflow = 'auto';
});

if (createHabitatFrame.style.display == 'block') {
    body.style.overflow = 'hidden';
}