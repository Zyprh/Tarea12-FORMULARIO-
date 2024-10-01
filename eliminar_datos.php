<?php
// eliminar_datos.php

$archivo = 'datos_producto.txt'; // Nombre del archivo de texto

// Obtener el ID del producto a eliminar
$id = $_POST['id'];

// Leer el contenido del archivo
$productos = file($archivo, FILE_IGNORE_NEW_LINES);

// Filtrar los productos que no coinciden con el ID proporcionado
$productosFiltrados = array_filter($productos, function($producto) use ($id) {
    return explode(',', $producto)[0] != $id;
});

// Guardar los productos filtrados de nuevo en el archivo
file_put_contents($archivo, implode("\n", $productosFiltrados));

echo "Producto eliminado exitosamente.";
?>