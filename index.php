<!DOCTYPE HTML>

<html>
    <head>
        <title>Administrador Sol de las Sierras</title>

        <?php
        include("mod-dependencies.php");
        ?>
        <script src="scripts/jquery.canvasjs.min.js"></script>
    </head>

    <body>
        <?php
        // Navigation
        include("mod-header.php");
        ?>

        <script>
            window.onload = function() {
                let countries = [],
                    ages      = [];

                function PushData(arr, toArr) {
                    let coun = [];

                    arr.forEach(function (e) {
                        if (!coun.includes(e))
                            coun.push(e);
                    });

                    let nums = [];
                    for (let i = 0; i < coun.length; i++)
                        nums[i] = 0;

                    arr.forEach(function (e) {
                        nums[coun.indexOf(e)] += 1;
                    });

                    for (let i = 0; i < coun.length; i++) {
                        toArr.push({
                            y: nums[i],
                            label: coun[i]
                        });
                    }
                }

                $.getJSON("https://anarquiteam.000webhostapp.com/api/stats.php?getCountries", function (data) {
                    PushData(data, countries);

                    let coChart = new CanvasJS.Chart('passanger-countries', {
                        animationEnable: true,
                        theme: 'light2',
                        zoomEnabled: true,
                        title: {
                            text: 'Paises de Proveniencia de Pasajeros Registrados'
                        },
                        axisY: {
                            title: 'Cantidad'
                        },
                        data: [{
                            type: 'column',
                            yValueFormatString: '# pasajero(s)',
                            dataPoints: countries
                        }]
                    });

                    coChart.render();
                });

                $.getJSON("https://anarquiteam.000webhostapp.com/api/stats.php?getAges", function (data) {
                    PushData(data, ages);

                    let agChart = new CanvasJS.Chart('passanger-ages', {
                        animationEnable: true,
                        theme: 'light2',
                        zoomEnabled: true,
                        title: {
                            text: 'Edades de Pasajeros Registrados'
                        },
                        axisY: {
                            title: 'Cantidad'
                        },
                        data: [{
                            type: 'column',
                            yValueFormatString: '# pasajero(s)',
                            dataPoints: ages
                        }]
                    });

                    agChart.render();
                });
            }
        </script>

        <div class="container p-5">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        Bienvenido Administrador
                    </div>

                    <div class="card-body">
                        <p>En esta sección podrá observar un breve resumen estadístico de su empresa. Puede visitar las distintas secciones
                        para configurar el sistema, consultar información, editar o modificarla a gusto.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="col">
                <div class="card mb-5">
                    <div class="card-header">
                        Edad de Pasajeros
                    </div>

                    <div class="card-body">
                        <div id="passanger-ages" style="height: 370px; width: 100%;">
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Paises de Proveniencia de Pasajeros
                    </div>

                    <div class="card-body">
                        <div id="passanger-countries" style="height: 370px; width: 100%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>