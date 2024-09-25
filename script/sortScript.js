const sortBy = document.querySelector('.filter').dataset.sort;
let sortSelect = document.querySelector('.select-sort');

/**
 * Check for each option in select param the option selected. 
 *
 * @param {Element} select 
 */
function selectOption(select) {
    for (let i = 0; i < select.length; i++) {
        if (select[i].value == sortBy) {
            select[i].selected = true;
        }
    }
}

selectOption(sortSelect);