let filterType = document.querySelector('.filter').dataset.filterType;
let filterLabelId = document.querySelector('.filter').dataset.filterLabelId;
let habitatCol = document.querySelectorAll('.habitat-col');
let raceCol = document.querySelectorAll('.race-col');
let raceSelect = document.querySelector('.race-select');
let habitatSelect = document.querySelector('.habitat-select');

//console.log(habitatSelect[3].value);
//console.log(filterLabelId);
//habitatSelect.selectedIndex = 2;

/**
 * Check for each option in select param the option selected in the filter. 
 * 
 * @param {Element} select 
 */
function selectFilterOption(select) {
    for (let i = 0; i < select.length; i++) {
        if (filterLabelId == select[i].value) {
            select[i].selected = true;
        }
    }
}

if (filterType === 'habitat') {
    raceSelect.selectedIndex = 0;
    for (let i = 0; i < habitatCol.length; i++) {
        raceCol[i].classList.remove('hidden');
        habitatCol[i].classList.add('hidden');
    }
    selectFilterOption(habitatSelect);
}
else if (filterType === 'race') {
    habitatSelect.selectedIndex = 0;
    for (let i = 0; i < raceCol.length; i++) {
        habitatCol[i].classList.remove('hidden');
        raceCol[i].classList.add('hidden');
    }
    selectFilterOption(raceSelect);
}
else {
    raceSelect.selectedIndex = 0;
    habitatSelect.selectedIndex = 0;
    for (let i = 0; i < raceCol.length; i++) {
        habitatCol[i].classList.remove('hidden');
        raceCol[i].classList.remove('hidden');
    }
}


