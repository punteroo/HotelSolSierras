<?php

// Estos son los detalles de la base de datos.
// Utilizamos un driver de MariaDB proveído por phpMyAdmin para utilizar contacto con nuestra base de datos.
//
// $hostname = Host de la base de datos, por defecto este se llama localhost.
// $user = Nombre de usuario para iniciar sesión en la base de datos, este usuario está ligado a permisos para modificar la base acorde
//        a la configuración de la misma.
// $pass = Contraseña del usuario para iniciar sesión.
// $base = Nombre de la base de datos con la que queremos establecer la conexión.
// $db = Objeto final con la conexión exitosa (o fallida en caso de error) que contiene todas las funciones para interactuar con la DB.
//       En todo el proyecto, siempre llamamos a esta variable global para interactuar con la base de datos.

$hostname = "localhost";
$user     = "root";
$pass     = "";
$base     = "hotel_sol";
$db       = mysqli_connect("$hostname","$user","$pass","$base");

?>