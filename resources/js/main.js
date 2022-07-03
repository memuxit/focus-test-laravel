import {generateChart} from "./functions/chart";
import {fillTable} from "./functions/table";


const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER
});
const channel = pusher.subscribe(import.meta.env.VITE_CHANNEL);
const refreshButton = document.getElementById('refresh-btn');
const btnIcon = document.getElementById('btn-icon');

const getPopulation = () => {
    refreshButton.disabled = true;
    btnIcon.classList.remove('fa-rotate');
    btnIcon.classList.add('fa-sync', 'fa-spin');
    axios.get('/api/population')
        .then(res => {
            if (res.status === 200 && res.data.success) {
                fillTable(res.data.data);
                generateChart(res.data.data);
            }
        })
        .catch(err => {
            console.error(err);
        })
        .then(() => {
            btnIcon.classList.add('fa-rotate');
            btnIcon.classList.remove('fa-sync', 'fa-spin');
            refreshButton.disabled = false;
        });
}

window.addEventListener('load', function () {
    if (initialPopulation !== null && initialPopulation.length > 0) {
        generateChart(initialPopulation);
    }
}, false);

refreshButton.addEventListener('click', () => getPopulation());

channel.bind(import.meta.env.VITE_EVENT, message => {
    fillTable(message.population);
    generateChart(message.population);
});
