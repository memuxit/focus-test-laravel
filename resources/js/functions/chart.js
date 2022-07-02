import {Chart, registerables} from "chart.js";

Chart.register(...registerables);

const data = {
    labels: ['2013', '2014', '2015', '2016', '2017', '2018', '2019'],
    datasets: [{
        label: '# population',
        data: [316128839, 318857056, 321418821, 323127515, 325719178, 327167439, 328239523],
        fill: false,
        borderColor: 'rgb(251, 51, 153)',
        tension: 0,
        pointStyle: 'circle',
        pointRadius: 10,
        pointHoverRadius: 15
    }]
};

const options = {
    scales: {
        y: {
            stacked: true
        }
    },
    responsive: true,
};

const ctx = document.getElementById('population');
const chart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options,
});
