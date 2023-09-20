import Chart from 'chart.js/auto';

const labels = [
    '01/02/2023',
    '02/02/2023',
    '03/02/2023',
    '04/02/2023',
    '05/02/2023',
    '06/02/2023',
    '07/02/2023',
    '08/02/2023',
    '09/02/2023',
    '10/02/2023',
    '11/02/2023',

];

const data = {
    labels: labels,
    datasets: [{
        label: '',
        borderColor: 'rgb(5,77,125)',
        backgroundColor:	'rgb(5,77,125)',
        data: [0, 25, 50, 75, 100],
        tension: 0.5,
        fill: {
            target: 'origin',
            above: 'rgb(56,172,227)',   // Area will be red above the origin
            below: 'rgb(56,172,227)'    // And blue below the origin
          }
        
    }]
};

const config = {
    type: 'line',
    data: data,
    // options: {
    //     with: '100px',
    //     height: '100px'
    // }
};

new Chart(
    $("#myChartResult"),
    config
);
