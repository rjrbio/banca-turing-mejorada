<?php
$conexion = mysqli_connect("db", "root", "test", "Banca");
if (!$conexion) {
    die("Error al conectar con la base de datos");
}