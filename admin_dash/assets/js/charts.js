// Line Chart
var chart1 = document.getElementById("linechart");
var myChart1 = new Chart(chart1, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            data: ['1200', '1500', '1700', '1300', '1600', '1800', '1500', '1700', '1600', '1900', '2000', '2200'],
            backgroundColor: "rgba(48, 164, 255, 0.2)",
            borderColor: "rgba(48, 164, 255, 0.8)",
            fill: true,
            borderWidth: 2
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeOutQuart',
        },
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Volume de Ventes Mensuel',
                position: 'left',
            },
        },
    }
});

// Bar Chart
var chart2 = document.getElementById('barchart');
var myChart2 = new Chart(chart2, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'Revenu',
                backgroundColor: "rgba(76, 175, 80, 0.5)",
                borderColor: "#6da252",
                borderWidth: 1,
                data: ["500", "600", "800", "700", "900", "1000", "850", "950", "700", "850", "1200", "1300"],
            }, {
                label: 'Dépenses',
                backgroundColor: "rgba(244, 67, 54, 0.5)",
                borderColor: "#f44336",
                borderWidth: 1,
                data: ["200", "300", "400", "350", "450", "500", "400", "450", "350", "400", "500", "600"],
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeOutQuart',
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            title: {
                display: true,
                text: 'Revenu vs Dépenses',
                position: 'left',
            },
        },
    }
});

// Pie Chart
var chart3 = document.getElementById("piechart");
var myChart3 = new Chart(chart3, {
    type: 'pie',
    data: {
        labels: ["Engineering", "Support Client", "Opérations", "Marketing", "R&D"],
        datasets: [{
            data: ["30", "25", "20", "15", "10"],
            backgroundColor: ["#009688", "#795548", "#673AB7", "#2196F3", "#6da252"],
            hoverOffset: 4
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeOutQuart',
        },
        plugins: {
            legend: {
                display: true,
                position: 'right',
            },
            title: {
                display: false,
            },
        },
    }
});

// Doughnut Chart
var chart4 = document.getElementById("doughnutchart");
var myChart4 = new Chart(chart4, {
    type: 'doughnut',
    data: {
        labels: ["Marié", "Célibataire", "Veuf", "Séparé", "Annulé"],
        datasets: [{
            data: ["40", "35", "10", "5", "10"],
            backgroundColor: ["#F44336", "#2196F3", "#795548", "#6da252", "#f39c12"],
            hoverOffset: 4
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeOutQuart',
        },
        plugins: {
            legend: {
                display: true,
                position: 'right',
            },
            title: {
                display: false,
            },
        },
    }
});

// Stacked Bar Chart
var chart5 = document.getElementById("stackedbarchart");
var myChart5 = new Chart(chart5, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
                label: 'Revenu',
                backgroundColor: "rgba(0, 150, 136, .5)",
                borderColor: "rgba(0, 150, 136)",
                borderWidth: 1,
                data: ["300", "400", "500", "400", "600", "700", "500"],
            }, {
                label: 'Dépenses',
                backgroundColor: "rgba(76, 175, 80, .5)",
                borderColor: "rgba(76, 175, 80)",
                borderWidth: 1,
                data: ["100", "200", "300", "250", "350", "450", "300"],
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeOutQuart',
        },
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true,
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            title: {
                display: true,
                text: 'Revenu vs Dépenses (Stacked)',
                position: 'left',
            },
        },
    }
});

// Radar Chart
var chart6 = document.getElementById("radarchart");
var myChart6 = new Chart(chart6, {
    type: 'radar',
    data: {
        labels: ['18-24 ans', '25-31 ans', '32-38 ans', '39-45 ans', '46 ans et plus'],
        datasets: [{
            data: ["25", "30", "28", "32", "15"],
            backgroundColor: "rgba(48, 164, 255, 0.2)",
            borderColor: "rgba(48, 164, 255, 0.8)",
        }]
    },
    options: {
        animation: {
            duration: 2000,
            easing: 'easeOutQuart',
        },
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Répartition par Tranche d\'Âge',
                position: 'top',
            },
        },
    }
});
