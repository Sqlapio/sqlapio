import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

function get_patient_register(countPatientRegister) {

  const labels = [
    'Total de pacientes registrados',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: ["Nro. Pacientes"],
      data: [countPatientRegister],
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
    $("#countPatientRegister"),
    config
  );
}

function get_medical_record(countMedicalRecordr) {

  const labels = [
    'Total de consultas realizadas',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: ["Nro. Consultas"],
      data: [countMedicalRecordr],
      backgroundColor: [
        'rgb(41,193,237)',
      ],
      borderColor: [
        'rgb(255, 99, 132)',
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
    $("#countMedicalRecordr"),
    config
  );
}

function get_history_register(countHistoryRegister) {

  const labels = [
    'Total de histrorias realizadas',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: ["Nro. Historias"],
      data: [countHistoryRegister],
      backgroundColor: [
        'rgb(202,202,203)',
      ],
      borderColor: [
        'rgb(255, 99, 132)',
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
    }
  };


  new Chart(
    $("#countHistoryRegister"),
    config
  );
}

function get_genere(boy_girl, teen) {
  let data = {
    labels: ["Niños", "Jovenes"],
    datasets: [
      {
        label: "Femenino",
        backgroundColor: "rgb(255,218,224)",
        data: [boy_girl.femenino, teen.femenino],
        borderRadius: 10,
        barPercentage: 0.5
      },
      {
        label: "Masculino",
        backgroundColor: "rgb(170,220,254)",
        data: [boy_girl.masculino, teen.masculino],
        borderRadius: 10,
        barPercentage: 0.5
      },
    ]
  };

  new Chart($("#countGenere"), {
    type: 'bar',
    data: data,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: 'white'
            }
          }
        }
      }
    }
  });
}

function get_general(elderly, adult) {
  let data = {
    labels:["Adultos", "Adultos Mayores"],
    datasets: [
      {
        label: "Femenino",
        backgroundColor: "rgb(255,218,224)",
        data: [adult.femenino, elderly.femenino],
        borderRadius: 10,
        barPercentage: 0.5
      },
      {
        label: "Masculino",
        backgroundColor: "rgb(170,220,254)",
        data: [adult.masculino, elderly.masculino],
        borderRadius: 10,
        barPercentage: 0.5
      },
    ]
  };

  new Chart($("#countGereral"), {
    type: 'bar',
    data: data,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: 'white'
            }
          }
        }
      }
    }
  });  
}

window.get_patient_register = get_patient_register;
window.get_medical_record = get_medical_record;
window.get_history_register = get_history_register;
window.get_genere = get_genere;
window.get_general = get_general;
