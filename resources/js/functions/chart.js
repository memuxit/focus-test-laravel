import {Chart, registerables} from "chart.js";

Chart.register(...registerables);


const ctx = document.getElementById('population');
let chart;

/**
 *
 * Generate the chart or update it
 *
 * @param population
 */
export const generateChart = population => {
    if (chart === undefined) {
        createChart(population);
    } else {
        ctx.style.display = 'block';
        updateChart(population);
    }
};

/**
 * Destroy the existing chart
 */
export const destroyChart = () => {
    ctx.style.display = 'none';
}

/**
 * Create a new chart
 *
 * @param population
 */
const createChart = population => {
    const labels = [];
    const data = [];

    population.forEach(item => {
        labels.push(item.year.toString());
        data.push(item.population);
    });

    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: '# population',
                data,
                fill: false,
                borderColor: 'rgb(251, 51, 153)',
                tension: 0,
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            }]
        },
        options: {
            scales: {
                y: {
                    stacked: true
                }
            },
            responsive: true,
        }
    });
};

/**
 * Update existing chart
 *
 * @param population
 */
const updateChart = population => {
    const labels = [];
    const data = [];

    population.forEach(item => {
        labels.push(item.year.toString());
        data.push(item.population);
    });

    chart.data.labels = labels;
    chart.data.datasets.data = data;

    chart.update();
};
