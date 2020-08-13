/*
 *  Document   : be_comp_charts.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Charts Page
 */

// Full Calendar, for more examples you can check out http://fullcalendar.io/
class pageCompCharts {
    /*
    * Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs
    *
    */
    static initChartsChartJS() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#999';
        Chart.defaults.global.defaultFontStyle              = '600';
        Chart.defaults.scale.gridLines.color                = "rgba(0,0,0,.05)";
        Chart.defaults.scale.gridLines.zeroLineColor        = "rgba(0,0,0,.1)";
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 2;
        Chart.defaults.global.elements.point.radius         = 4;
        Chart.defaults.global.elements.point.hoverRadius    = 6;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.labels.boxWidth        = 15;

        // Get Chart Containers
        let chartLinesCon  = jQuery('.js-chartjs-lines');
        let chartBarsCon   = jQuery('.js-chartjs-bars');
        let chartRadarCon  = jQuery('.js-chartjs-radar');
        let chartPolarCon  = jQuery('.js-chartjs-polar');
        let chartPieCon    = jQuery('.js-chartjs-pie');
        let chartDonutCon  = jQuery('.js-chartjs-donut');

        // Set Chart and Chart Data variables
        let chartLines, chartBars, chartRadar, chartPolar, chartPie, chartDonut;
        let chartLinesBarsRadarData, chartPolarPieDonutData;

        // Lines/Bar/Radar Chart Data
        chartLinesBarsRadarData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(220,220,220,.3)',
                    borderColor: 'rgba(220,220,220,1)',
                    pointBackgroundColor: 'rgba(220,220,220,1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(220,220,220,1)',
                    data: [30, 32, 40, 45, 43, 38, 55]
                },
                {
                    label: 'Last Week',
                    fill: true,
                    backgroundColor: 'rgba(171, 227, 125, .3)',
                    borderColor: 'rgba(171, 227, 125, 1)',
                    pointBackgroundColor: 'rgba(171, 227, 125, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(171, 227, 125, 1)',
                    data: [15, 16, 20, 25, 23, 25, 32]
                }
            ]
        };

        // Polar/Pie/Donut Data
        chartPolarPieDonutData = {
            labels: [
                'Earnings',
                'Sales',
                'Tickets'
            ],
            datasets: [{
                data: [
                    48,
                    26,
                    26
                ],
                backgroundColor: [
                    'rgba(171, 227, 125, 1)',
                    'rgba(250, 219, 125, 1)',
                    'rgba(117, 176, 235, 1)'
                ],
                hoverBackgroundColor: [
                    'rgba(171, 227, 125, .75)',
                    'rgba(250, 219, 125, .75)',
                    'rgba(117, 176, 235, .75)'
                ]
            }]
        };

        // Init Charts
        if (chartLinesCon.length) {
            chartLines = new Chart(chartLinesCon, { type: 'line', data: chartLinesBarsRadarData });
        }

        if (chartBarsCon.length) {
            chartBars  = new Chart(chartBarsCon, { type: 'bar', data: chartLinesBarsRadarData });
        }

        if (chartRadarCon.length) {
            chartRadar = new Chart(chartRadarCon, { type: 'radar', data: chartLinesBarsRadarData });
        }

        if (chartPolarCon.length) {
            chartPolar = new Chart(chartPolarCon, { type: 'polarArea', data: chartPolarPieDonutData });
        }

        if (chartPieCon.length) {
            chartPie   = new Chart(chartPieCon, { type: 'pie', data: chartPolarPieDonutData });
        }

        if (chartDonutCon.length) {
            chartDonut = new Chart(chartDonutCon, { type: 'doughnut', data: chartPolarPieDonutData });
        }
    }

    /*
    * Randomize Easy Pie Chart values
    *
    */
    static initRandomEasyPieChart() {
        jQuery('.js-pie-randomize').on('click', e => {
            jQuery(e.currentTarget)
                .parents('.block')
                .find('.pie-chart')
                .each((index, element) => jQuery(element).data('easyPieChart').update(Math.floor((Math.random() * 100) + 1)));
        });
    }

    /*
    * Init functionality
    *
    */
    static init() {
        this.initChartsChartJS();
        this.initRandomEasyPieChart();
    }
}

// Initialize when page loads
jQuery(() => { pageCompCharts.init(); });
