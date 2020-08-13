/*
 *  Document   : be_pages_ecom_dashboard.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in eCommerce Dashboard Page
 */

class pageEcomDashboard {
    /*
     * Chart.js, for more examples you can check out http://www.chartjs.org/docs
     *
     */
    static initOverviewChart() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#495057';
        Chart.defaults.scale.gridLines.color                = 'transparent';
        Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
        //Chart.defaults.scale.display                        = false;
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 0;
        Chart.defaults.global.elements.point.radius         = 0;
        Chart.defaults.global.elements.point.hoverRadius    = 0;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.labels.boxWidth        = 12;

        // Get Chart Container
        let chartOverviewCon  = jQuery('.js-chartjs-overview');

        // Set Chart Variables
        let chartOverview, chartOverviewOptions, chartOverviewData;

        // Overview Chart Options
        chartOverviewOptions = {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 500
                    }
                }]
            },
            tooltips: {
                intersect: false,
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' $' + tooltipItems.yLabel;
                    }
                }
            }
        };

        // Overview Chart Data
        chartOverviewData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(132, 94, 247, .3)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(132, 94, 247, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(132, 94, 247, 1)',
                    data: [390, 290, 410, 290, 450, 180, 360]
                },
                {
                    label: 'Last Week',
                    fill: true,
                    backgroundColor: 'rgba(233, 236, 239, 1)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(233, 236, 239, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(233, 236, 239, 1)',
                    data: [180, 360, 236, 320, 210, 295, 260]
                }
            ]
        };

        // Init Overview Chart
        if (chartOverviewCon.length) {
            chartOverview = new Chart(chartOverviewCon, {
                type: 'line',
                data: chartOverviewData,
                options: chartOverviewOptions
            });
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initOverviewChart();
    }
}

// Initialize when page loads
jQuery(() => { pageEcomDashboard.init(); });
