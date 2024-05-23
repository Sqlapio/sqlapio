import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

const lang = document.getElementById("lang").value;

const langJson = JSON.parse(lang);

const Meses = [
    langJson.graficas.enero,
    langJson.graficas.febrero,
    langJson.graficas.marzo,
    langJson.graficas.abril,
    langJson.graficas.mayo,
    langJson.graficas.junio,
    langJson.graficas.julio,
    langJson.graficas.agosto,
    langJson.graficas.septiembre,
    langJson.graficas.octubre,
    langJson.graficas.noviembre,
    langJson.graficas.diciembre,
];

let chart_queries_month;
let chart_appointments_attended;
let chart_appointments_canceled;
let chart_appointments_confirmed;

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

// function get_medical_record(countMedicalRecordr) {
//   const labels = [langJson.graficas.total_consultas];

//   const data = {
//     labels: labels,
//     datasets: [
//       {
//         label: [langJson.graficas.num_consultas],
//         data: [countMedicalRecordr],
//         backgroundColor: ["rgb(41,193,237)"],
//         borderColor: ["rgb(255, 99, 132)"],
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

//   new Chart($("#countMedicalRecordr"), config);
// }

// function get_history_register(countMedicalRecordr) {
//   const labels = [langJson.graficas.total_historias];

//   const data = {
//     labels: labels,
//     datasets: [
//       {
//         label: [langJson.graficas.num_historias],
//         data: [countHistoryRegister],
//         backgroundColor: ["rgb(202,202,203)"],
//         borderColor: ["rgb(255, 99, 132)"],
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

//   new Chart($("#countHistoryRegister"), config);
// }

// function get_genere(boy_girl, teen) {
//   let data = {
//     labels: [langJson.graficas.niños, langJson.graficas.jovenes],
//     datasets: [
//       {
//         label: langJson.graficas.femenino,
//         backgroundColor: "rgb(255,218,224)",
//         data: [boy_girl.femenino, teen.femenino],
//         borderRadius: 10,
//         barPercentage: 0.5
//       },
//       {
//         label: langJson.graficas.masculino,
//         backgroundColor: "rgb(170,220,254)",
//         data: [boy_girl.masculino, teen.masculino],
//         borderRadius: 10,
//         barPercentage: 0.5
//       }
//     ]
//   };

//   new Chart($("#countGenere"), {
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

function get_general(boy_girl, teen, elderly, adult) {
  const data = {
    labels: [langJson.graficas.niños, langJson.graficas.jovenes, langJson.graficas.adultos, langJson.graficas.adultos_mayores],
    datasets: [
      {
        label: langJson.graficas.femenino,
        data: [boy_girl.femenino, teen.femenino, adult.femenino, elderly.femenino],
        borderColor: "rgb(255, 99, 132)",
        backgroundColor: "rgb(255, 99, 132)"
      },
      {
        label: langJson.graficas.masculino,
        data: [boy_girl.masculino, teen.masculino, adult.masculino, elderly.masculino],
        borderColor: "#2380f7",
        backgroundColor: "#2380f7"
      }
    ]
  };

  new Chart($("#countGereral2"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#b3b3b3", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#b3b3b3", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
            position: "bottom",
            align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.pacientes_tipo,
          color: "#b3b3b3"
        }
      }
    }
  });
}

function get_queries_month(queries_month) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.consultas_mes,
        data:queries_month,
        borderColor: "#2380f7",
        backgroundColor: context => {
          const bgcolor = ["#2380f7", "#2380f77a", "#0000"];

          if (!context.chart.chartArea) {
            return;
          }
          const { ctx, data, chartArea: { top, bottom } } = context.chart;
          const gradientBg = ctx.createLinearGradient(0, top, 0, bottom);
          gradientBg.addColorStop(0, bgcolor[0]);
          gradientBg.addColorStop(0.5, bgcolor[1]);
          gradientBg.addColorStop(1, bgcolor[2]);
          return gradientBg;
        },
        fill: true,
        tension: 0.4
      }
    ]
  };

  chart_queries_month = new Chart($("#queries_month"), {
    type: "line",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#b3b3b3", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#b3b3b3", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.consultas_mes,
          color: "#b3b3b3"
        }
      }
    }
  });
}

function updat_graphc(data) {

  chart_queries_month.data.datasets[0].data = data.get_queries_month;
  chart_queries_month.update();

  chart_appointments_attended.data.datasets[0].data = data.get_appointments_attended;
  chart_appointments_attended.update();

  chart_appointments_canceled.data.datasets[0].data = data.get_appointments_canceled;
  chart_appointments_canceled.update();

  chart_appointments_confirmed.data.datasets[0].data = data.get_appointments_confirmed;
  chart_appointments_confirmed.update();
}
function get_appointments_attended(appointments_attended) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.citas_atendidas_mes,
        data: appointments_attended,
        borderColor: "#ffba56",
        backgroundColor: context => {
          const bgcolor = ["#ffba56", "#ffba5694", "#0000"];

          if (!context.chart.chartArea) {
            return;
          }
          const { ctx, data, chartArea: { top, bottom } } = context.chart;
          const gradientBg = ctx.createLinearGradient(0, top, 0, bottom);
          gradientBg.addColorStop(0, bgcolor[0]);
          gradientBg.addColorStop(0.5, bgcolor[1]);
          gradientBg.addColorStop(1, bgcolor[2]);
          return gradientBg;
        },
        fill: true,
        tension: 0.4
      }
    ]
  };

  chart_appointments_attended = new Chart($("#appointments_attended"), {
    type: "line",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#b3b3b3", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#b3b3b3", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas_atendidas_mes,
          color: "#b3b3b3"
        }
      }
    }
  });
}

function get_appointments_canceled(appointments_canceled) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.citas_canceladas_mes,
        data: appointments_canceled,
        borderColor: "#af5a5c",
        backgroundColor: context => {

          const bgcolor = ["#af5a5c", "#af5a5c9c", "#0000"];

          if (!context.chart.chartArea) {
            return;
          }
          const { ctx, data, chartArea: { top, bottom } } = context.chart;
          const gradientBg = ctx.createLinearGradient(0, top, 0, bottom);
          gradientBg.addColorStop(0, bgcolor[0]);
          gradientBg.addColorStop(0.5, bgcolor[1]);
          gradientBg.addColorStop(1, bgcolor[2]);
          return gradientBg;
        },
        fill: true,
        tension: 0.4
      }
    ]
  };

  chart_appointments_canceled = new Chart($("#appointments_canceled"), {
    type: "line",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#b3b3b3", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#b3b3b3", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas_canceladas_mes,
          color: "#b3b3b3"
        }
      }
    }
  });
}

function get_appointments_confirmed(appointments_confirmed) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.citas_confirmadas_mes,
        data: appointments_confirmed,
        borderColor: "#36e97b",
        borderWidth: 2,
        backgroundColor: context => {
        //   const bgcolor = ["#af5a5c", "#af5a5c9c", "#af5a5c5c"];
          const bgcolor = ["#36e97b", "#38ef7d7a", "#38ef7d36"];

          if (!context.chart.chartArea) {
            return;
          }
          const { ctx, data, chartArea: { top, bottom } } = context.chart;
          const gradientBg = ctx.createLinearGradient(0, top, 0, bottom);
          gradientBg.addColorStop(0, bgcolor[0]);
          gradientBg.addColorStop(0.5, bgcolor[1]);
          gradientBg.addColorStop(1, bgcolor[2]);
          return gradientBg;
        },
        fill: true,
        tension: 0.4
      }
    ]
  };

  chart_appointments_confirmed = new Chart($("#appointments_confirmed"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#b3b3b3", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#b3b3b3", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas_confirmadas_mes,
          color: "#b3b3b3"
        }
      }
    }
  });
}

function get_quotes(appointments_count_all) {
  const data = {
    labels: [langJson.graficas.canceladas, langJson.graficas.atendidas, langJson.graficas.confirmadas],
    datasets: [
      {
        label: langJson.graficas.total,
        data: appointments_count_all,
        backgroundColor: ["#ed6c6c", "#ffba56", "#36e97b"]
      }
    ]
  };

  new Chart($("#quotes"), {
    type: "pie",
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas,
          color: "#b3b3b3"
        }
      }
    }
  });
}

function get_consultas_history(countMedicalRecordr, countHistoryRegister) {
  const data = {
    labels: [langJson.graficas.num_consultas, langJson.graficas.num_historias],
    datasets: [
      {
        label: langJson.graficas.total,
        data: [countMedicalRecordr , countHistoryRegister],
        backgroundColor: ["#ed6c6c", "#ffba56",]
      }
    ]
  };

  new Chart($("#consultas_history"), {
    type: "pie",
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#b3b3b3"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.consultas_historias,
          color: "#b3b3b3"
        }
      }
    }
  });
}

// window.get_patient_register = get_patient_register;
// window.get_medical_record = get_medical_record;
// window.get_history_register = get_history_register;
window.updat_graphc = updat_graphc;
window.get_general = get_general;
window.get_queries_month = get_queries_month;
window.get_appointments_attended = get_appointments_attended;
window.get_appointments_canceled = get_appointments_canceled;
window.get_appointments_confirmed = get_appointments_confirmed;
window.get_quotes = get_quotes;
window.get_consultas_history = get_consultas_history;
