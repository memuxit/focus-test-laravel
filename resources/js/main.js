import {Notify} from "notiflix/build/notiflix-notify-aio";
import {destroyChart, generateChart} from "./functions/chart";
import {destroyRows, fillTable} from "./functions/table";


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
                Notify.success('The information was refreshed correctly', {
                    timeout: 3000
                });
            } else {
                destroyRows();
                destroyChart();
                Notify.warning('No records found', {
                    timeout: 3000
                });
            }
        })
        .catch(err => {
            console.error(err);
            Notify.failure('There was an error getting the information', {
                timeout: 3000
            });
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
    } else {
        Notify.info('There are no records at the moment', {
            timeout: 3000
        });
    }
}, false);

refreshButton.addEventListener('click', () => getPopulation());

Echo.channel(import.meta.env.VITE_CHANNEL)
    .listen(`.${import.meta.env.VITE_EVENT}`, message => {
        fillTable(message.population);
        generateChart(message.population);
        Notify.success('The information was obtained correctly', {
            timeout: 3000
        });
    });
