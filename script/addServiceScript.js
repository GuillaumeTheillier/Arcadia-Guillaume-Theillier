const btnOpen = document.getElementById('btn-open-add-service');
const btnClose = document.getElementById('btn-close-add-service');
const createServiceFrame = document.getElementById('create-service-frame');

btnOpen.addEventListener('click', () => {
    createServiceFrame.style.display = 'block';
})

btnClose.addEventListener('click', () => {
    createServiceFrame.style.display = 'none';
})