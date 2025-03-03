document.addEventListener("DOMContentLoaded", async function () {
    try {
        const url = document.getElementById("genUrl").getAttribute("data-url");
        const response = await fetch(url);
        const data = await response.json();

        if (!data || data.length === 0) {
            console.error("No hay datos disponibles.");
            return;
        }

        // Calcular el total de reconocimientos
        let totalRecognitions = data.reduce((sum, item) => sum + item.total, 0);
        document.getElementById("total-recognitions").innerText = totalRecognitions;

        // Extraer nombres y valores
        const labels = data.map(item => item.nombretipo);
        const values = data.map(item => Math.round(item.total));

        const backgroundColors = labels.map(() => `#${Math.floor(Math.random()*16777215).toString(16)}`);

        // Configuración del gráfico con ApexCharts
        let options = {
            chart: {
                type: "bar",
                height: 350
            },
            series: [{
                name: "Cantidad",
                data: values
            }],
            xaxis: {
                categories: labels,
                title: { text: "Tipos de Reconocimiento" }
            },
            yaxis: {
                title: { text: "Cantidad" },
                labels: {
                    formatter: (value) => Number.isInteger(value) ? value : '' // Mostrar solo valores enteros
                }
            },
            title: {
                text: "Cantidad de reconocimientos por tipo",
                align: "center"
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    distributed: true // Colores diferentes por columna
                }
            },
            colors: backgroundColors, // Aplicar colores generados
            legend: {
                position: "bottom"
            }
        };

        // Renderizar el gráfico
        let chart = new ApexCharts(document.querySelector("#recognitionChart"), options);
        chart.render();

    } catch (error) {
        console.error("Error obteniendo los datos:", error);
    }


    fetch($('#genUrl').attr('data-getUserRegistrationsByMonth'))
        .then(response => response.json())
        .then(data => {
        let meses = data.map(item => item.month);
        
        let user_register = data.reduce((sum, item) => sum + item.total, 0);
        document.getElementById("user_register").innerText = user_register;
        let cantidadUsuarios = data.map(item => Math.round(item.total));

        let options = {
            chart: {
                type: "area",
                height: 330
            },
            series: [{
                name: "Usuarios Registrados",
                data: cantidadUsuarios
            }],
            xaxis: {
                categories: meses,
                title: { text: "Mes" }
            },
            yaxis: {
                title: { text: "Cantidad de Usuarios" },
                labels: {
                    formatter: (value) => Number.isInteger(value) ? value : '' // Mostrar solo valores enteros
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            }
        };

        let chart = new ApexCharts(document.querySelector("#users-chart"), options);
        chart.render();

        // Actualizar el total de usuarios
        document.getElementById("total-users").innerText = cantidadUsuarios.reduce((a, b) => a + b, 0);
    }).catch(error => console.error("Error al cargar datos:", error));



         // Datos de enfermedades visuales con sus porcentajes
         let enfermedades = ["Miopía", "Hipermetropía", "Astigmatismo", "Cataratas", "Glaucoma"];
         let porcentajes = [35, 25, 20, 10, 10]; // Suma 100%

         let options = {
             chart: {
                 type: "pie",
                 height: 370
             },
             series: porcentajes, // Valores de los porcentajes
             labels: enfermedades, // Etiquetas de enfermedades
             legend: {
                 position: "bottom"
             },
             dataLabels: {
                 formatter: (val) => val.toFixed(1) + "%" // Mostrar porcentaje con 1 decimal
             }
         };

         let chart = new ApexCharts(document.querySelector("#chart"), options);
         chart.render();



         let edades = ["0-18", "19-35", "36-50", "51+"];
         // Datos de cada enfermedad en los diferentes rangos de edad
         let series = [
             { name: "Miopía", data: [40, 30, 20, 10] },
             { name: "Hipermetropía", data: [15, 25, 30, 40] },
             { name: "Astigmatismo", data: [20, 25, 25, 30] },
             { name: "Cataratas", data: [0, 5, 15, 40] },
             { name: "Glaucoma", data: [0, 3, 10, 25] }
         ];

         let opciones = {
             chart: {
                 type: "bar",
                 height: 305
             },
             series: series, // Datos de cada enfermedad por edad
             xaxis: {
                 categories: edades, // Rango de edades en el eje X
                 title: { text: "Rango de Edades" }
             },
             yaxis: {
                 title: { text: "Cantidad de Casos" }
             },
             plotOptions: {
                 bar: { horizontal: false, dataLabels: { position: "top" } }
             },
             dataLabels: {
                 enabled: true
             },
             legend: {
                 position: "bottom"
             }
         };

         let grafico = new ApexCharts(document.querySelector("#grafico"), opciones);
         grafico.render();

});
