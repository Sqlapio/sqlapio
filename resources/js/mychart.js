import Chart from 'chart.js/auto';

const labels = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Noviembre',
    'Diciembre',

];

const data = {
    labels: labels,
    datasets: [{
        label: 'Tiempos de espera',
        borderColor: 'rgb(5,77,125)',
        backgroundColor:	'rgb(5,77,125)',
        data: [0, 45, 0, 45, 0, 45, 0,45,15,0,0],
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
    $("#myChart"),
    config
);
