const sortBy = document.querySelector('.filter').dataset.sort;
const animalFilter = document.querySelector('.filter').dataset.animalFilter;
let sortSelect = document.querySelector('.select-sort');
let animalSelect = document.querySelector('.select-animal');
const clearFilterBtn = document.querySelector('.clear-filter');
let dateSelect = document.querySelector('.date-filter');

/**
 * Check for each option in select param the option selected. 
 *
 * @param {Element} select 
 */
function selectOption(select, value) {
    for (let i = 0; i < select.length; i++) {
        if (select[i].value == value) {
            select[i].selected = true;
        }
    }
}

selectOption(sortSelect, sortBy);
selectOption(animalSelect, animalFilter);