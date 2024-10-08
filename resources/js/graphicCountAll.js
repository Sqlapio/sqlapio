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
  langJson.graficas.diciembre
];

let chart_queries_month;
let chart_general_appointments;
let chart_general_appointments2;
let chart_recorded_appointments;
let patient_attended_corporate;

/**
 *
 * Grafica de rol Medico
 *
 */

/**
 *
 * Grafica de Pacientes por edad y sexo
 *
 */

function get_general(boy_girl, teen, adult, elderly) {
  const data = {
    labels: [langJson.graficas.niños, langJson.graficas.jovenes, langJson.graficas.adultos, langJson.graficas.adultos_mayores],
    datasets: [
      {
        label: langJson.graficas.femenino,
        data: [boy_girl.femenino, teen.femenino, adult.femenino, elderly.femenino],
        borderColor: "#f79a23",
        backgroundColor: "#f79a23",
        stack: "Stack 0"
      },
      {
        label: langJson.graficas.masculino,
        data: [boy_girl.masculino, teen.masculino, adult.masculino, elderly.masculino],
        borderColor: "#2380f7",
        backgroundColor: "#2380f7",
        stack: "Stack 0"
      }
    ]
  };

  const totalSum = data.datasets[0].data.reduce((sum, currentValue) => {
    return sum + currentValue;
  }, 0);

  new Chart($("#countGereral2"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      barThickness: 70,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1}, grace: 2
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        datalabels: {
            labels: {
                title: {
                color: "white",
                font: {
                    weight: "bold",
                    size: 14
                }
                }
            },
            formatter: function(value) {

                return value == 0 ? '' : Math.round(value / totalSum * 100) + "%";

            }
        },
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
      }
    },
    plugins: [ChartDataLabels]
  });
}

/**
 *
 * Grafica de consultas por mes
 *
*/


function get_queries_month(queries_month, meses) {

  const data = {
    labels: meses,
    datasets: [
      {
        label: langJson.graficas.total,
        data: queries_month,
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
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }
        },
        x: {
            ticks: { color: "#596167", beginAtZero: true },
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
        title: {
          display: true,
          //   text: langJson.graficas.consultas_mes,
          color: "#596167"
        }
      }
    }
  });
}

function updat_graphc(data) {
  chart_queries_month.data.datasets[0].data = data.get_queries_month;
  chart_queries_month.update();

  chart_general_appointments.data.datasets[0].data = data.get_appointments_attended;
  chart_general_appointments.data.datasets[1].data = data.get_appointments_unconfirmed;
  chart_general_appointments.update();

  chart_general_appointments2.data.datasets[0].data = data.get_appointments_unconfirmed;
  chart_general_appointments2.data.datasets[1].data = data.get_appointments_confirmed;
  chart_general_appointments2.data.datasets[2].data = data.get_appointments_attended;
  chart_general_appointments2.update();

  chart_recorded_appointments.data.datasets[1].data = data.get_appointments_unconfirmed;
  chart_recorded_appointments.update();

}

/**
 *
 * Grafica de citas atendidas por mes
 *
 */

function get_appointments_attended(appointments_attended) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.total,
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

  new Chart($("#appointments_attended"), {
    type: "line",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas_atendidas_mes,
          color: "#596167"
        }
      }
    }
  });
}

/**
 *
 * Grafica de citas canceladas por mes
 *
 */

function get_appointments_canceled(appointments_canceled) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.total,
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

  new Chart($("#appointments_canceled"), {
    type: "line",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas_canceladas_mes,
          color: "#596167"
        }
      }
    }
  });
}

/**
 *
 * Grafica de citas confirmadas por mes
 *
 */

function get_appointments_confirmed(appointments_confirmed) {
  const data = {
    labels: Meses,
    datasets: [
      {
        label: langJson.graficas.total,
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

  new Chart($("#appointments_confirmed"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
        title: {
          display: true,
          text: langJson.graficas.citas_confirmadas_mes,
          color: "#596167"
        }
      }
    }
  });
}

/**
 *
 * Grafica de citas agendadas vs confirmadas por mes
 *
 */

function get_appointments_confirmed_scheduled(appointments_unconfirmed, appointments_confirmed) {
    const data = {
      labels: Meses,
      datasets: [
          {
              label: langJson.graficas.citas_sinconfirmar_mes,
              data: appointments_unconfirmed,
              borderColor: "#6c757d",
              backgroundColor: "#6c757d"
          },
        {
          label: langJson.graficas.citas_confirmadas_mes,
          data: appointments_confirmed,
          borderColor: "#ffc107",
          backgroundColor: "#ffc107"
        },
      ]
    };

    new Chart($("#confirmed_scheduled"), {
      type: "bar",
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
          },
          x: {
            ticks: { color: "#596167", beginAtZero: true }
          }
        },
        plugins: {
          datalabels: {
              anchor: 'end',
              align: 'end',
              labels: {
                  title: {
                      color: "#596167",
                      font: {
                          weight: "bold",
                          size: 11
                      }
                  }
              },
              formatter: function(value) {
                  return value == 0 ? '' : value;
              }
          },
          legend: {
            position: "bottom",
            align: "start",
            labels: {
              color: "#596167"
            }
          },
        }
      },
      plugins: [ChartDataLabels]
    });
  }

/**
 *
 * Grafica de citas agendadas vs atendidas por mes
 *
 */

function get_appointments_attended_scheduled(appointments_unconfirmed, appointments_attended) {
    const data = {
      labels: Meses,
      datasets: [
          {
              label: langJson.graficas.citas_sinconfirmar_mes,
              data: appointments_unconfirmed,
              borderColor: "#6c757d",
              backgroundColor: "#6c757d"
          },

          {
              label: langJson.graficas.citas_atendidas_mes,
              data: appointments_attended,
              borderColor: "#198754",
              backgroundColor: "#198754"
            }
      ]
    };

    new Chart($("#attended_scheduled"), {
      type: "bar",
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
          },
          x: {
            ticks: { color: "#596167", beginAtZero: true }
          }
        },
        plugins: {
          datalabels: {
              anchor: 'end',
              align: 'end',
              labels: {
                  title: {
                      color: "#596167",
                      font: {
                          weight: "bold",
                          size: 11
                      }
                  }
              },
              formatter: function(value) {
                  return value == 0 ? '' : value;
              }
          },
          legend: {
            position: "bottom",
            align: "start",
            labels: {
              color: "#596167"
            }
          },
        }
      },
      plugins: [ChartDataLabels]
    });
  }

/**
 *
 * Grafica de citas agendadas vs canceladas por mes
 *
 */

function get_appointments_canceled_scheduled(appointments_unconfirmed, appointments_canceled) {

  const data = {
    labels: Meses,
    datasets: [
        {
            label: langJson.graficas.citas_sinconfirmar_mes,
            data: appointments_unconfirmed,
            borderColor: "#6c757d",
            backgroundColor: "#6c757d"
        },
        {
            label: langJson.graficas.citas_canceladas_mes,
            data: appointments_canceled,
            borderColor: "#dc3545",
            backgroundColor: "#dc3545"
        },
    ]
  };

  new Chart($("#canceled_scheduled"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'end',
            labels: {
                title: {
                    color: "#596167",
                    font: {
                        weight: "bold",
                        size: 11
                    }
                }
            },
            formatter: function(value) {
                return value == 0 ? '' : value;
            }
        },
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
      }
    },
    plugins: [ChartDataLabels]
  });
}

/**
 *
 * Grafica de citas agendadas vs no atendidas por mes
 *
 */

function get_appointments_not_attended_scheduled(appointments_unconfirmed, appointments_not_attended) {

  const data = {
    labels: Meses,
    datasets: [
        {
            label: langJson.graficas.citas_sinconfirmar_mes,
            data: appointments_unconfirmed,
            borderColor: "#6c757d",
            backgroundColor: "#6c757d"
        },
        {
            label: langJson.graficas.citas_noatendidas_mes,
            data: appointments_not_attended,
            borderColor: "#336fe0",
            backgroundColor: "#336fe0"
        },
    ]
  };

  new Chart($("#not_attended_scheduled"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'end',
            labels: {
                title: {
                    color: "#596167",
                    font: {
                        weight: "bold",
                        size: 11
                    }
                }
            },
            formatter: function(value) {
                return value == 0 ? '' : value;
            }
        },
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
      }
    },
    plugins: [ChartDataLabels]
  });
}

/**
 *
 * Grafica de pacientes por edad
 *
 */
function get_age(all_patient_boy_girl, all_patient_teen, all_patient_adult, all_patient_elderly ) {
    const data = {
        labels: [langJson.graficas.niños, langJson.graficas.jovenes, langJson.graficas.adultos, langJson.graficas.adultos_mayores],
        datasets: [
            {
                label: langJson.graficas.total,
                data: [all_patient_boy_girl, all_patient_teen, all_patient_adult, all_patient_elderly],
                backgroundColor: ["#00bfff", "#007df6", "#008089", "#008970"]
            },
        ]
      };

      new Chart($("#get_age"), {
        type: "bar",
        data: data,
        options: {
        responsive: true,
        barThickness: 70,
        scales: {
            y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
            },
            x: {
            ticks: { color: "#596167", beginAtZero: true }
            }
        },
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'end',
                labels: {
                    title: {
                        color: "#596167",
                        font: {
                            weight: "bold",
                            size: 11
                        }
                    }
                },
                formatter: function(value) {
                    return value == 0 ? '' : value;
                }
            },
            legend: {
                display: false,
                position: "bottom",
                align: "start",
                labels: {
                    color: "#596167"
                }
            },
        }
        },
        plugins: [ChartDataLabels]
      });
}

/**
 *
 * Grafica de paciente por genero
 *
 */
function get_gender(all_patient_gender) {
    const data = {
        labels: [langJson.graficas.femenino, langJson.graficas.masculino],
        datasets: [
            {
                label: langJson.graficas.femenino,
                data: [all_patient_gender.femenino, all_patient_gender.masculino,],
                backgroundColor: ["rgb(255, 99, 132)", "#2380f7"]
            },
        ]
      };

      new Chart($("#get_gender"), {
        type: "bar",
        data: data,
        options: {
        responsive: true,
        barThickness: 70,
        scales: {
            y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
            },
            x: {
            ticks: { color: "#596167", beginAtZero: true }
            }
        },
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'end',
                labels: {
                    title: {
                        color: "#596167",
                        font: {
                            weight: "bold",
                            size: 11
                        }
                    }
                },
                formatter: function(value) {
                    return value == 0 ? '' : value;
                }
            },
            legend: {
                display: false,
                position: "bottom",
                align: "start",
                labels: {
                    color: "#596167"
                }
            },
        }
        },
        plugins: [ChartDataLabels]
      });
}


/**
 *
 * Grafica de citas por a;o Agendadas, Confirmadas, Atendidas, Canceladas, no atendidas
 *
 */

function get_appointments_general(appointments_unconfirmed, appointments_confirmed, appointments_attended, appointments_canceled, appointments_not_attended) {

  const data = {
    labels: Meses,
    datasets: [
        {
            label: langJson.graficas.citas_sinconfirmar_mes,
            data: appointments_unconfirmed,
            borderColor: "#6c757d",
            backgroundColor: "#6c757d"
        },
        {
            label: langJson.graficas.citas_confirmadas_mes,
            data: appointments_confirmed,
            borderColor: "#ffc107",
            backgroundColor: "#ffc107"
        },
        {
            label: langJson.graficas.citas_atendidas_mes,
            data: appointments_attended,
            borderColor: "#198754",
            backgroundColor: "#198754"
        },
        {
            label: langJson.graficas.citas_canceladas_mes,
            data: appointments_canceled,
            borderColor: "#dc3545",
            backgroundColor: "#dc3545"
        },
        {
            label: langJson.graficas.citas_noatendidas_mes,
            data: appointments_not_attended,
            borderColor: "#336fe0",
            backgroundColor: "#336fe0"
        },
    ]
  };

  new Chart($("#appointments_general"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'end',
            labels: {
                title: {
                    color: "#596167",
                    font: {
                        weight: "bold",
                        size: 11
                    }
                }
            },
            formatter: function(value) {
                return value == 0 ? '' : value;
            }
        },
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
      }
    },
    plugins: [ChartDataLabels]
  });
}


/**
 *
 * Grafica de citas canceladas, atendidas y confirmadas acumuladas
 *
 */
function get_quotes(appointments_count_all_confirmada, appointments_count_all_canceled, appointments_count_all_attended) {
    const data = {
        // labels: [langJson.graficas.confirmadas, langJson.graficas.canceladas],
        labels: [langJson.graficas.confirmadas, langJson.graficas.canceladas, langJson.graficas.atendidas],
        datasets: [
            {
                label: langJson.graficas.total,
                data: [appointments_count_all_confirmada, appointments_count_all_canceled, appointments_count_all_attended],
                backgroundColor: ["#ffc107", "#dc3545", "#198754"]
            },
        ]
      };

      new Chart($("#quotes"), {
        type: "bar",
        data: data,
        options: {
        responsive: true,
        barThickness: 70,
        scales: {
            y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
            },
            x: {
            ticks: { color: "#596167", beginAtZero: true }
            }
        },
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'end',
                labels: {
                    title: {
                        color: "#596167",
                        font: {
                            weight: "bold",
                            size: 11
                        }
                    }
                },
                formatter: function(value) {
                    return value == 0 ? '' : value;
                }
            },
            legend: {
                display: false,
                position: "bottom",
                align: "start",
                labels: {
                    color: "#596167"
                }
            },
        }
        },
        plugins: [ChartDataLabels]
      });
}

/**
 *
 * Grafica de citas historias y consultas acumuladas
 *
 */

function get_consultas_history(countMedicalRecordr, countHistoryRegister) {
  const data = {
    labels: [langJson.graficas.num_consultas, langJson.graficas.num_historias],
    datasets: [
      {
        label: langJson.graficas.total,
        data: [countMedicalRecordr, countHistoryRegister],
        backgroundColor: ["#2380f7", "#56c1ff"]
      }
    ]
  };

  const totalSum = data.datasets[0].data.reduce((sum, currentValue) => {
    return sum + currentValue;
  }, 0);

  new Chart($("#consultas_history"), {
    type: "pie",
    data: data,
    options: {
      responsive: true,
      plugins: {
        datalabels: {
          labels: {
            title: {
              color: "white",
              font: {
                weight: "bold",
                size: 18
              }
            }
          },
          formatter: function(value) {
            return value == 0 ? '' : Math.round(value / totalSum * 100) + "%";
          }
        },
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        }
      }
    },
    plugins: [ChartDataLabels]
  });
}

/**
 *
 * Grafica de rol corporativo
 *
 */

/**
 *
 * Grafica de citas agendadas acumuladas x mes corporativo
 *
 */

function get_recorded_appointments(appointments_unconfirmed, meses) {
  const data = {
    labels: meses,
    datasets: [
      {
        label: langJson.graficas.total,
        data: appointments_unconfirmed,
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

  chart_recorded_appointments = new Chart($("#recorded_appointments"), {
    type: "line",
    data: data,
    options: {
      responsive: true,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
      }
    }
  });

}


/**
 *
 * Grafica de citas agendadas acumuladas x mes corporativo
 *
 */

function get_doctors(doctors_active, doctors_inactive) {
  const data = {
    labels: [langJson.graficas.doctores_activos, langJson.graficas.doctores_inactivos],
    datasets: [
      {
        label: langJson.graficas.total,
        data: [doctors_active, doctors_inactive],
        borderColor: "#36e97b",
        backgroundColor: ["#36e97b", "#f02c2cf0"]
      }
    ]
  };

    new Chart($("#doctors"), {
    type: "bar",
    data: data,
    options: {
      responsive: true,
      barThickness: 70,
      scales: {
        y: {
          ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
        },
        x: {
          ticks: { color: "#596167", beginAtZero: true }
        }
      },
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'end',
            labels: {
                title: {
                    color: "#596167",
                    font: {
                        weight: "bold",
                        size: 11
                    }
                }
            },
            formatter: function(value) {
                return value == 0 ? '' : value;
            }
        },
        legend: {
          position: "bottom",
          align: "start",
          labels: {
            color: "#596167"
          }
        },
      }
    },
    plugins: [ChartDataLabels]
  });
}

/**
 *
 * Grafica de pacientes atendidos x mes corporativo
 *
 */

function get_patient_attended_corporate(patient_attended_corporate, meses) {
    const data = {
      labels: meses,
      datasets: [
        {
          label: langJson.graficas.total,
          data: patient_attended_corporate,
          borderColor: "#198754",
        }
      ]
    };

    new Chart($("#patient_attended_corporate"), {
      type: "line",
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }
          },
          x: {
            ticks: { color: "#596167", beginAtZero: true }
          }
        },
        plugins: {
          legend: {
            position: "bottom",
            align: "start",
            labels: {
              color: "#596167"
            }
          },
        }
      }
    });
}

/**
 *
 * Grafica de Medicos por especialidad
 *
 */

function get_doctor_speciality(doctor_speciality, specialty) {

    const data = {
      labels: specialty,
      datasets: [
          {
              label: 'Total',
              data: doctor_speciality,
              borderColor: "#00b0eb",
              backgroundColor: "#00b0eb"
          },
      ]
    };

    new Chart($("#doctor_speciality"), {
      type: "bar",
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            ticks: { color: "#596167", beginAtZero: true, stepSize: 1 }, grace: 1
          },
          x: {
            ticks: { color: "#596167", beginAtZero: true }
          }
        },
        plugins: {
          datalabels: {
              anchor: 'end',
              align: 'end',
              labels: {
                  title: {
                      color: "#596167",
                      font: {
                          weight: "bold",
                          size: 11
                      }
                  }
              },
              formatter: function(value) {
                  return value == 0 ? '' : value;
              }
          },
          legend: {
            position: "bottom",
            align: "start",
            labels: {
              color: "#596167"
            }
          },
        }
      },
      plugins: [ChartDataLabels]
    });
  }


// window.get_patient_register = get_patient_register;
// window.get_medical_record = get_medical_record;
// window.get_history_register = get_history_register;
// window.get_general_appointments = get_general_appointments;
// window.get_general_appointments2 = get_general_appointments2;
window.updat_graphc = updat_graphc;
window.get_general = get_general;
window.get_queries_month = get_queries_month;
window.get_appointments_attended = get_appointments_attended;
window.get_appointments_canceled = get_appointments_canceled;
window.get_appointments_confirmed = get_appointments_confirmed;
window.get_quotes = get_quotes;
window.get_consultas_history = get_consultas_history;
window.get_recorded_appointments = get_recorded_appointments;
window.get_doctors = get_doctors;

window.get_appointments_confirmed_scheduled = get_appointments_confirmed_scheduled;
window.get_appointments_attended_scheduled = get_appointments_attended_scheduled;
window.get_appointments_canceled_scheduled = get_appointments_canceled_scheduled;
window.get_appointments_not_attended_scheduled = get_appointments_not_attended_scheduled;
window.get_appointments_general = get_appointments_general;
window.get_age = get_age;
window.get_gender = get_gender;
window.get_patient_attended_corporate = get_patient_attended_corporate;
window.get_doctor_speciality = get_doctor_speciality;
