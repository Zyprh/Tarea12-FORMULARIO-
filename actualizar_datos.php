<?php
// actualizar_datos.php

$archivo = 'datos_producto.txt'; // Nombre del archivo de texto

// Obtener los datos del formulario
$id = $_POST['campo1']; // El ID es único y se utiliza para identificar el registro
$fechaVenta = $_POST['campo2'];
$nombre = $_POST['campo3'];
$fechaVencimiento = $_POST['campo4'];
$precio = $_POST['campo5'];
$proveedor = $_POST['campo6'];
$categoria = $_POST['campo7'];
$almacen = $_POST['campo8'];
$stock = $_POST['campo9'];
$tipoProducto = $_POST['campo10'];

// Leer el contenido del archivo
$productos = file($archivo, FILE_IGNORE_NEW_LINES);

// Actualizar el registro correspondiente
foreach ($productos as &$producto) {
    $datos = explode(',', $producto);
    if ($datos[0] == $id) {
        // Actualizar los campos
        $producto = implode(',', [$id, $fechaVenta, $nombre, $fechaVencimiento, $precio, $proveedor, $categoria, $almacen, $stock, $tipoProducto]);
        break;
    }
}

// Guardar de nuevo en el archivo
file_put_contents($archivo, implode("\n", $productos));

echo "Producto actualizado exitosamente.";
?>