let btnOpen = document.getElementsByClassName('btn-open-frame');
let btnClose = document.getElementsByClassName('btn-close-frame');
let frame = document.getElementsByClassName('crud-frame');
let body = document.getElementsByTagName('body');

//In each page there are one button with the class name : 'btn-open-frame' or 'btn-close-frame'.
btnOpen = btnOpen[0];
btnClose = btnClose[0];
frame = frame[0];
body = body[0];
console.log(body);

btnOpen.addEventListener('click', () => {
    frame.classList.add('visible');
    body.style.overflow = 'hidden';
});

btnClose.addEventListener('click', () => {
    frame.classList.remove('visible');
    body.style.overflow = 'auto';
});