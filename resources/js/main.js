import {generateChart} from "./functions/chart";
import {fillTable} from "./functions/table";


window.addEventListener('load', function () {
    if (initialPopulation !== null && initialPopulation.length > 0) {
        generateChart(initialPopulation);
    }
}, false);

const refreshButton = document.getElementById('refresh-btn');
refreshButton.addEventListener('click', () => getPopulation());

const getPopulation = () => {
    axios.get('/api/population')
        .then(res => {
            if (res.status === 200 && res.data.success) {
                fillTable(res.data.data);
                generateChart(res.data.data);
            }
        })
        .catch(err => {
            console.error(err);
        });
}
