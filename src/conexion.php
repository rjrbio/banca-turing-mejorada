<?php
$conexion = mysqli_connect("db", "user", "pass", "banco");
if (!$conexion) {
    die("Error al conectar con la base de datos");
}