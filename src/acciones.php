<?php
require_once "conexion.php";

$accion = $_POST["accion"] ?? "";
$dni = $_POST["dni"] ?? "";
$nombre = $_POST["nombre"] ?? "";
$direccion = $_POST["direccion"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$dniOld = $_POST["dniOld"] ?? "";

if ($accion == "agregar") {
    $sql_check = "SELECT * FROM cliente WHERE dni='$dni'";
    $resultado = mysqli_query($conexion, $sql_check);
    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>alert('Error: El DNI ya existe.'); window.location.href = 'index.php';</script>";
     } else {
    $sql = "INSERT INTO cliente VALUES ('$dni','$nombre','$direccion','$telefono')";
    mysqli_query($conexion, $sql);
}
}

if ($accion == "eliminar") {
    $sql = "DELETE FROM cliente WHERE dni='$dni'";
    mysqli_query($conexion, $sql);
}

if ($accion == "actualizar") {
    $sql = "UPDATE cliente 
            SET dni='$dni', nombre='$nombre', direccion='$direccion', telefono='$telefono' 
            WHERE dni='$dniOld'";
    mysqli_query($conexion, $sql);
}

// devolvemos la acción a index
return $accion;