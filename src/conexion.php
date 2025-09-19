<?php
$conexion = mysqli_connect("mysql-rjrbio.alwaysdata.net", "rjrbio", "Killoloko00", "rjrbio_banco");
if (!$conexion) {
    die("Error al conectar con la base de datos");
}