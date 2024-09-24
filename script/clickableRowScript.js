let row = document.querySelectorAll('.click-row');
console.log(row);
for (let i = 1; i < row.length + 1; i++) {
    for (let j = 1; j < 4; j++) {
        row[i].addEventListener('click', () => {
            document.location.href = 'index.php?action=animalConsumptionList&animal=2';
        })
    }
}
