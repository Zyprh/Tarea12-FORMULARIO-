<?php
// Leer el archivo de texto
$archivo = 'datos_producto.txt';

if (file_exists($archivo)) {
    // Leer el contenido del archivo
    $contenido = file_get_contents($archivo);
    
    // Separar las líneas del archivo
    $lineas = explode("\n", trim($contenido));
    
    // Ignorar la primera línea (cabecera)
    array_shift($lineas);
    
    // Separar los datos por comas
    $datos = array_map(function($linea) {
        return explode(",", $linea);
    }, $lineas);

    // Enviar los datos como JSON
    echo json_encode($datos);
} else {
    echo json_encode(["Error: Archivo no encontrado"]);
}
?>
