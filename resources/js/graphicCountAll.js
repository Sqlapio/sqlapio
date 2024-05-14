import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

const lang = document.getElementById("lang").value;

const langJson = JSON.parse(lang);

// function get_patient_register(countPatientRegister) {

//   const labels = [langJson.graficas.total_pacientes];

//   const data = {
//     labels: labels,
//     datasets: [
//       {
//         label: [langJson.graficas.num_pacientes],
//         data: [countPatientRegister],
//         backgroundColor: ["rgb(71,82,94)"],
//         borderColor: ["rgb(255, 205, 86)"],
//         borderRadius: 10,
//         barPercentage: 0.3
//       }
//     ]
//   };

//   const config = {
//     type: "bar",
//     data: data,
//     plugins: [ChartDataLabels],
//     options: {
//       responsive: true,
//       scales: {
//         y: {
//           beginAtZero: true,
//           ticks: {
//             stepSize: 1
//           }
//         }
//       },
//       plugins: {
//         datalabels: {
//           labels: {
//             title: {
//               color: "white"
//             }
//           }
//         }
//       }
//     }
//   };

//   new Chart($("#countPatientRegister"), config);
// }

function get_medical_record(countMedicalRecordr) {
  const labels = [langJson.graficas.total_consultas];

  const data = {
    labels: labels,
    datasets: [
      {
        label: [langJson.graficas.num_consultas],
        data: [countMedicalRecordr],
        backgroundColor: ["rgb(41,193,237)"],
        borderColor: ["rgb(255, 99, 132)"],
        borderRadius: 10,
        barPercentage: 0.3
      }
    ]
  };

  const config = {
    type: "bar",
    data: data,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: "white"
            }
          }
        }
      }
    }
  };

  new Chart($("#countMedicalRecordr"), config);
}

function get_history_register(countHistoryRegister) {
  const labels = [langJson.graficas.total_historias];

  const data = {
    labels: labels,
    datasets: [
      {
        label: [langJson.graficas.num_historias],
        data: [countHistoryRegister],
        backgroundColor: ["rgb(202,202,203)"],
        borderColor: ["rgb(255, 99, 132)"],
        borderRadius: 10,
        barPercentage: 0.3
      }
    ]
  };

  const config = {
    type: "bar",
    data: data,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: "white"
            }
          }
        }
      }
    }
  };

  new Chart($("#countHistoryRegister"), config);
}

function get_genere(boy_girl, teen) {
  let data = {
    labels: [langJson.graficas.niños, langJson.graficas.jovenes],
    datasets: [
      {
        label: langJson.graficas.femenino,
        backgroundColor: "rgb(255,218,224)",
        data: [boy_girl.femenino, teen.femenino],
        borderRadius: 10,
        barPercentage: 0.5
      },
      {
        label: langJson.graficas.masculino,
        backgroundColor: "rgb(170,220,254)",
        data: [boy_girl.masculino, teen.masculino],
        borderRadius: 10,
        barPercentage: 0.5
      }
    ]
  };

  new Chart($("#countGenere"), {
    type: "bar",
    data: data,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: "white"
            }
          }
        }
      }
    }
  });
}

// function get_general(elderly, adult) {

//   let data = {
//     labels: [langJson.graficas.adultos, langJson.graficas.adultos_mayores],
//     datasets: [
//       {
//         label: langJson.graficas.femenino,
//         backgroundColor: "rgb(255,218,224)",
//         data: [adult.femenino, elderly.femenino],
//         borderRadius: 10,
//         barPercentage: 0.5
//       },
//       {
//         label: langJson.graficas.masculino,
//         backgroundColor: "rgb(170,220,254)",
//         data: [adult.masculino, elderly.masculino],
//         borderRadius: 10,
//         barPercentage: 0.5
//       }
//     ]
//   };

//   new Chart($("#countGereral"), {
//     type: "bar",
//     data: data,
//     plugins: [ChartDataLabels],
//     options: {
//       responsive: true,
//       scales: {
//         y: {
//           ticks: {
//             stepSize: 1
//           }
//         }
//       },
//       plugins: {
//         datalabels: {
//           labels: {
//             title: {
//               color: "white"
//             }
//           }
//         }
//       }
//     }
//   });
// }


function get_general(boy_girl, teen,elderly, adult ) {
    const data = {
        labels: [langJson.graficas.niños, langJson.graficas.jovenes, langJson.graficas.adultos, langJson.graficas.adultos_mayores],
        datasets: [
          {
            label: langJson.graficas.femenino,
            data: [boy_girl.femenino, teen.femenino, adult.femenino, elderly.femenino],
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor:'rgb(255, 99, 132)',
          },
          {
            label: langJson.graficas.masculino,
            data: [boy_girl.masculino, teen.masculino, adult.masculino, elderly.masculino],
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgb(54, 162, 235)',
          }
        ]
      };

      new Chart($("#countGereral2"),  {
        type: 'line',
        data: data,
        options: {
          responsive: true,
          scales: {
            y: {
              ticks: {
                stepSize: 1
              }
            }
          },
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Pacientes'
            }
          }
        },
      });

}

function get_quotes() {

    const data = {
        labels: ['Canceladas', 'Atendidas'],
        datasets: [
          {
            label: 'Dataset 1',
            data: [8, 5],
            backgroundColor: ["rgb(54, 162, 235)", 'rgb(255, 99, 132)'],
          }
        ]
    };

    new Chart($("#quotes"), {
        type: 'pie',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Citas'
            }
          }
        },
      });
}

// window.get_patient_register = get_patient_register;
window.get_medical_record = get_medical_record;
window.get_history_register = get_history_register;
window.get_genere = get_genere;
window.get_general = get_general;
window.get_quotes = get_quotes;

