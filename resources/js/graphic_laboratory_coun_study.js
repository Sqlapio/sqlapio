import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

function get_study(countStudy) {

  console.log(countStudy);

  const labels = [
    'Total de estudios realizados',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: ["Nro. estudios"],
      data: [countStudy],
      backgroundColor: [
        'rgb(71,82,94)',
      ],
      borderColor: [
        'rgb(255, 205, 86)',
      ],
      borderRadius: 10,
      barPercentage: 0.3
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      },
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: 'white'
            }
          }
        }
      }
    },
  };

  new Chart(
    $("#countStudies"),
    config
  );
}


window.get_study = get_study;