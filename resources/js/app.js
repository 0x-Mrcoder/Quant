import './bootstrap';

import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
import { createChart } from 'lightweight-charts';
window.ApexCharts = ApexCharts;
window.createChart = createChart;

document.addEventListener('alpine:init', () => {
    Alpine.store('loader', {
        show: false,
        start() { this.show = true; },
        stop() { this.show = false; }
    });
});

// Fallback if event already fired
if (window.Alpine) {
    window.Alpine.store('loader', {
        show: false,
        start() { this.show = true; },
        stop() { this.show = false; }
    });
}

Alpine.start();
