import './bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    const chartCanvas = document.getElementById('salesChart');

    if (!chartCanvas) {
        return;
    }

    const labels = JSON.parse(chartCanvas.dataset.labels || '[]');
    const values = JSON.parse(chartCanvas.dataset.values || '[]');

    new Chart(chartCanvas, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Pendapatan (Rp)',
                    data: values,
                    borderColor: 'rgba(37, 99, 235, 1)',
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(37, 99, 235, 1)',
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => value.toLocaleString('id-ID'),
                    },
                },
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: context => {
                            const value = context.parsed.y || 0;
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                    },
                },
            },
        },
    });
});
