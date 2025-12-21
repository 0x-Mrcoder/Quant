import './bootstrap';

import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
import { createChart } from 'lightweight-charts';
window.ApexCharts = ApexCharts;
window.createChart = createChart;

Alpine.start();
