<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include("../db.php");

if (isset($_GET['getAges'])) {
    $json = array();

    $q = "SELECT edad FROM pasajeros";
    $r = mysqli_query($db, $q);

    if ($r) {
        while ($row = $r->fetch_array()) {
            array_push($json, intval($row['edad']));
        }
    }

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}

if (isset($_GET['getCountries'])) {
    $json = array();

    $q = "SELECT pais FROM pasajeros";
    $r = mysqli_query($db, $q);

    if ($r) {
        while ($row = $r->fetch_array()) {
            array_push($json, $row['pais']);
        }
    }

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}

?>