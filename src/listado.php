<?php
require_once "conexion.php";


$orden = isset($_GET['orden']) ? $_GET['orden'] : "nombre";
$apunta = isset($_GET['apunta']) ? $_GET['apunta'] : "ASC";


if ($apunta != "ASC" && $apunta != "DESC") {
    $apunta = "ASC";
}

$sql = "SELECT dni, nombre, direccion, telefono 
        FROM cliente 
        ORDER BY $orden $apunta";
$consulta = mysqli_query($conexion, $sql);

// Función para iconos dinámicos
function iconoOrden($columna, $orden, $apunta)
{
    if ($orden == $columna) {
        return $apunta == "ASC"
            ? '<i class="bi bi-caret-up-fill"></i>'
            : '<i class="bi bi-caret-down-fill"></i>';
    }
    return "";
}
?>

<table class="table table-striped">
    <tr>
        <th> <a href="?orden=dni&apunta=<?= ($orden == 'dni' && $apunta == 'ASC') ? 'DESC' : 'ASC' ?>">
                DNI <?= iconoOrden("dni", $orden, $apunta) ?>
            </a></th>
        <th> <a href="?orden=nombre&apunta=<?= ($orden == 'nombre' && $apunta == 'ASC') ? 'DESC' : 'ASC' ?>">
                Nombre <?= iconoOrden("nombre", $orden, $apunta) ?>
            </a></th>
        <th><a href="?orden=direccion&apunta=<?= ($orden == 'direccion' && $apunta == 'ASC') ? 'DESC' : 'ASC' ?>">
                Dirección <?= iconoOrden("direccion", $orden, $apunta) ?>
            </a></th>
        <th><a href="?orden=telefono&apunta=<?= ($orden == 'telefono' && $apunta == 'ASC') ? 'DESC' : 'ASC' ?>">
                Teléfono <?= iconoOrden("telefono", $orden, $apunta) ?>
            </a></th>
        <th></th>
        <th></th>
    </tr>


    <?php while ($registro = mysqli_fetch_array($consulta)): ?>
        <?php if (($accion == "modificar") && ($dni == $registro["dni"])): ?>
            <tr class="fila-mod">
                <form action="index.php" method="post">
                    <td><input type="text" name="dni" value="<?= $registro['dni'] ?>"></td>
                    <td><input type="text" name="nombre" value="<?= $registro['nombre'] ?>"></td>
                    <td><input type="text" name="direccion" value="<?= $registro['direccion'] ?>"></td>
                    <td><input type="tel" name="telefono" value="<?= $registro['telefono'] ?>"></td>
                    <td>
                        <input type="hidden" name="accion" value="actualizar">
                        <input type="hidden" name="dniOld" value="<?= $registro['dni'] ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg"></i> Actualizar
                        </button>
                    </td>
                </form>
                <td>
                    <form action="index.php" method="post">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-lg"></i> Cancelar
                        </button>
                    </form>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td><?= $registro['dni'] ?></td>
                <td><?= $registro['nombre'] ?></td>
                <td><?= $registro['direccion'] ?></td>
                <td><?= $registro['telefono'] ?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="dni" value="<?= $registro['dni'] ?>">
                        <button type="submit" class="btn btn-danger" <?= $accion == "modificar" ? "disabled" : "" ?>>
                            <i class="bi bi-trash"></i> Borrar
                        </button>
                    </form>
                </td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="accion" value="modificar">
                        <input type="hidden" name="dni" value="<?= $registro['dni'] ?>">
                        <button type="submit" class="btn btn-primary" <?= $accion == "modificar" ? "disabled" : "" ?>>
                            <i class="bi bi-pencil"></i> Modificar
                        </button>
                    </form>
                </td>
            </tr>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php if ($accion != "modificar"): ?>
        <tr>
            <form action="index.php" method="post">
                <input type="hidden" name="accion" value="agregar">
                <td><input type="text" name="dni" required></td>
                <td><input type="text" name="nombre" required></td>
                <td><input type="text" name="direccion" required></td>
                <td><input type="tel" name="telefono" required></td>
                <td>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus"></i> Añadir
                    </button>
                </td>
            </form>
        </tr>
    <?php endif; ?>
</table>