<?php

// Información de headers HTTP para permitir el pedido de datos a esta página.
// Esta página es utilizada UNICAMENTE para obtener datos desde la base de datos en formato JSON o similar.
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include("../db.php");

if (isset($_GET['getRoom'])) {
    $id = $_GET['getRoom'];

    $q = "SELECT * FROM reservas WHERE habitacion LIKE '%$id%'";
    $r = mysqli_query($db, $q);

    if ($r) {
        $json = array();
        while ($row = $r->fetch_array()) {
            $client = $row['cliente'];

            $q2 = "SELECT nombre, apellido FROM pasajeros WHERE id = $client";
            $res = mysqli_query($db, $q2)->fetch_array();

            $name = $res['apellido'] . ", " . $res['nombre'];

            $entry = date("d/m H:i", strtotime($row['entrada']));
            $exit  = date("d/m H:i", strtotime($row['salida']));

            $date = $entry . " - " . $exit;

            $pass = $row['pasajeros'];
            $pens = $row['pension'];
            $stat = $row['estado'];
            $cost = $row['costo'];

            $obj = array('nombre' => $name, 'fecha' => $date, 'pasajeros' => $pass, 'pension' => $pens, 'estado' => $stat, 'costo' => $cost);

            array_push($json, $obj);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        return;
    }
    echo "{}";
}

?>