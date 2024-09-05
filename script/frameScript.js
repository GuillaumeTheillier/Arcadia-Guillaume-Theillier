let btnOpen = document.querySelector('.btn-open-frame');
let btnClose = document.querySelector('.btn-close-frame');
let frame = document.querySelector('.crud-frame');
let body = document.querySelector('body');
//console.log(frame);

/**
 * Open frame on button click and disable the scrollbar for the main page.
 */
function openFrame() {
    btnOpen.addEventListener('click', () => {
        frame.classList.add('visible');
        body.style.overflow = 'hidden';
    });
}

/**
 * Close frame on button click and enable the scrollbar for the main page.
 */
function closeFrame() {
    btnClose.addEventListener('click', () => {
        frame.classList.remove('visible');
        body.style.overflow = 'auto';
    });
}

openFrame();
closeFrame();