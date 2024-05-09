const btnOpen = document.getElementById('btn-crud-add');
const btnClose = document.getElementById('btn-crud-close')
const cadre = document.getElementById('cadre');


cadre.style.display = 'none';

btnOpen.addEventListener('click', () => {
    console.log('test');
    cadre.style.display = 'block';
});

btnClose.addEventListener('click', () => {
    cadre.style.display = 'none';
});