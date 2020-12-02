<!-- Todo documento de HTML empieza con esta etiqueta, declara que se utilize la última versión de HTML disponible. -->

<!DOCTYPE HTML>

<html>
    <!-- El tag 'head' nos permite definir meta-datos de la página, como tambien importar librerias, imágenes, etcétera. -->
    <head>
        <title>Administrador Sol de las Sierras</title>

        <?php
        // Incluimos las dependencias, estas serían Bootstrap y JQuery, además de otros elementos detallados en el documento.
        include("mod-dependencies.php");
        ?>
        <script src="scripts/jquery.canvasjs.min.js"></script>
    </head>

    <body>
        <?php
        // Navigation
        include("mod-header.php");
        ?>

        <!--
            Este script nos permite visualizar las estadísticas del hotel.
        -->
        <script>
            // Una vez que cargue la web completa...
            window.onload = function() {
                // Declaramos dos arreglos que contendran los datos para las gráficas estadísticas.
                let countries = [],
                    ages      = [];

                // void PushData(arr, toArr)
                // - arr   = Arreglo principal de donde tomar la información.
                // - toArr = Arreglo al que insertar los datos finales para generar la gráfica estadística.
                function PushData(arr, toArr) {
                    // coun = Arreglo temporal que contendrá los elementos originales para hacer el conteo.
                    let coun = [];
                    
                    // Por cada elemento del arreglo original, meter un ÚNICO elemento del mismo en el temporal.
                    // SIN REPITENCIA DE ELEMENTOS.
                    arr.forEach(function (e) {
                        if (!coun.includes(e))
                            coun.push(e);
                    });

                    // Crear un arreglo que contendrá la cantidad de cada elemento, y llenarlo de 0s.
                    let nums = [];
                    for (let i = 0; i < coun.length; i++)
                        nums[i] = 0;

                    // Por cada elemento del arreglo original (arr), agregar 1 en el índice del arreglo de conteo (nums) que corresponde también
                    // al índice donde está ubicado el elemento original (coun).
                    // Por ejemplo: coun = ['H', 'L', 'O'];
                    //              nums = [5, 3, 2];
                    //   Hay 5 'H', debido a que el elemento 'H' comparte el índice 0 con el 5 en nums.
                    //   La misma lógica aplica a los otros elementos.
                    arr.forEach(function (e) {
                        nums[coun.indexOf(e)] += 1;
                    });

                    // Finalmente, insertamos en el toArr los datos finales con el formato específico pedido por nuestra dependencia, CanvasJS.
                    for (let i = 0; i < coun.length; i++) {
                        toArr.push({
                            y: nums[i],
                            label: coun[i]
                        });
                    }
                }

                // AJAX call para obtener en JSON los datos de los pasajeros respecto a sus paises.
                $.getJSON("https://anarquiteam.000webhostapp.com/api/stats.php?getCountries", function (data) {
                    // Creamos el arreglo con los datos en el formato correcto.
                    PushData(data, countries);

                    // Creamos el objeto que contendrá la estadística.
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

                    // La renderizamos.
                    coChart.render();
                });

                // AJAX call para obtener en JSON los datos de los pasajeros respecto a sus edades.
                $.getJSON("https://anarquiteam.000webhostapp.com/api/stats.php?getAges", function (data) {
                    // Creamos el arreglo con los datos en el formato correcto.
                    PushData(data, ages);

                    // Creamos el objeto que contendrá la estadística.
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

                    // La renderizamos.
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