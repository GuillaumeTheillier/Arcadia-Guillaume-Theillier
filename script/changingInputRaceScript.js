let select = document.getElementById('animal-choose-race');
let input = document.getElementById('animal-add-race');
let btn = document.getElementById('btn-add-race');

function reverseInput(element) {
    element.hidden = !element.hidden;
    element.disabled = !element.disabled;
}

btn.addEventListener('click', () => {
    //console.log(input);
    if (input.hidden) {
        reverseInput(select);
        reverseInput(input);
        btn.innerText = 'Sélectionner une race';
    } else if (select.hidden) {
        reverseInput(select);
        reverseInput(input);
        btn.innerText = 'Ajouter une race';
    }
});