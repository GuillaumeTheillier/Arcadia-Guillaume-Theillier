const btnOpen = document.getElementById('btn-open-add-animal');
const btnClose = document.getElementById('btn-close-add-animal');
const createAnimalFrame = document.getElementById('create-animal-frame');

const body = document.getElementById('body');

btnOpen.addEventListener('click', () => {
    createAnimalFrame.style.display = 'block';
    body.style.overflow = 'hidden';
});

btnClose.addEventListener('click', () => {
    createAnimalFrame.style.display = 'none';
    body.style.overflow = 'auto';
});
/*
if (createAnimalFrame.style.display == 'block') {
    body.style.overflow = 'hidden';
}*/