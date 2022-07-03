const table = document.getElementById('population-table');

/**
 * Update the information in the table
 *
 * @param population
 */
export const fillTable = population => {
    destroyRows();

    const tblBody = document.createElement('tbody');
    tblBody.classList.add('text-end');

    for (let item of population) {
        const row = document.createElement('tr');
        for (let j = 0; j < 2; j++) {
            const cell = document.createElement('td');
            const value = document.createTextNode(j === 0 ? item.year : item.population);
            cell.appendChild(value);
            row.appendChild(cell);
        }
        tblBody.appendChild(row);
    }

    table.appendChild(tblBody);
};

/**
 * Destroy tbody rows
 */
export const destroyRows = () => {
    const tbody = table.getElementsByTagName('tbody')[0];

    if (tbody !== undefined) {
        table.removeChild(table.getElementsByTagName('tbody')[0]);
    }
};
