let btnOpen = document.querySelectorAll('.btn-open-frame');
let btnClose = document.querySelector('.btn-close-frame');
let frame = document.querySelector('.crud-frame');
let body = document.querySelector('body');
//console.log(frame);

function openFrameWithMultipleButton() {
    btnOpen.forEach(element => {
        let btnSubmit = document.querySelector('.submitFrameBtn');
        element.addEventListener('click', () => {
            btnSubmit.value = element.dataset.animalId;
            //console.log(element.dataset.animalId);
            frame.classList.add('visible');
            body.style.overflow = 'hidden';
        });
    });
}

/**
 * Open frame on button click and disable the scrollbar for the main page.
 */
function openFrame() {
    btnOpen[0].addEventListener('click', () => {
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


if (btnOpen.length > 1) {
    openFrameWithMultipleButton()
    closeFrame();
} else if (btnOpen.length === 1) {
    openFrame();
    closeFrame();
}

