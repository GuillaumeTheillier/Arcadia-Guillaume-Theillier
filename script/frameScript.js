let btnOpen = document.querySelectorAll('.btn-open-frame');
let btnClose = document.querySelectorAll('.btn-close-frame');
let frame = document.querySelectorAll('.crud-frame');
let body = document.querySelector('body');

/**
 * Open frame on button click and disable the scrollbar for the main page.
 */
function openFrame(indexBtn, indexFrame) {
    btnOpen[indexBtn].addEventListener('click', () => {
        frame[indexFrame].classList.add('visible');
        body.style.overflow = 'hidden';
    });
}

/**
 * Close frame on button click and enable the scrollbar for the main page.
 */
function closeFrame(indexBtn, indexFrame) {
    btnClose[indexBtn].addEventListener('click', () => {
        frame[indexFrame].classList.remove('visible');
        body.style.overflow = 'auto';
    });
}

/**
 * 
 */
function openFrameWithMultipleButton(index) {
    btnOpen.forEach(element => {
        let btnSubmit = document.querySelector('.submitFrameBtn');
        element.addEventListener('click', () => {
            btnSubmit.value = element.dataset.animalId;
            //console.log(element.dataset.animalId);
            frame[index].classList.add('visible');
            body.style.overflow = 'hidden';
        });
    });
}

function openCloseCorrectFrame() {
    //console.log(frame);
    //frame array
    for (let i = 0; i < frame.length; i++) {
        // button array
        for (let j = 0; j < btnOpen.length; j++) {
            if (frame[i].dataset.frameName == btnOpen[j].dataset.frameToOpen) {
                openFrame(j, i)
                closeFrame(i, j);
            }
        }
    }
}

if (frame.length === 1) {
    if (btnOpen.length > 1) {
        openFrameWithMultipleButton(0)
        closeFrame(0, 0);
    } else if (btnOpen.length === 1) {
        openFrame(0, 0);
        closeFrame(0, 0);
    }
} else {
    openCloseCorrectFrame();
}


