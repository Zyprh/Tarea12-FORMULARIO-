<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];
    $campo3 = $_POST['campo3'];
    $campo4 = $_POST['campo4'];
    $campo5 = $_POST['campo5'];
    $campo6 = $_POST['campo6'];
    $campo7 = $_POST['campo7'];
    $campo8 = $_POST['campo8'];
    $campo9 = $_POST['campo9'];
    $campo10 = $_POST['campo10'];

    // Verificar si todos los campos están presentes
    if (empty($campo1) || empty($campo2) || empty($campo3) || empty($campo4) || empty($campo5) || empty($campo6) || empty($campo7) || empty($campo8) || empty($campo9) || empty($campo10)) {
        echo "Error: Todos los campos son requeridos.";
        exit;
    }

    // Formato CSV: concatenar los campos separados por comas
    $linea = "$campo1,$campo2,$campo3,$campo4,$campo5,$campo6,$campo7,$campo8,$campo9,$campo10\n";

    // Nombre del archivo
    $archivo = 'datos_producto.txt';

    // Verificar si el archivo ya existe
    if (!file_exists($archivo)) {
        // Si el archivo no existe, agregar la cabecera antes de los datos
        $cabecera = "Id,FechaVenta,Nombre,FechaVencimiento,Precio,Proveedor,Categoria,Almacen,Stock,TipoProducto\n";
        // Escribir la cabecera
        file_put_contents($archivo, $cabecera, FILE_APPEND);
    } else {
        // Si el archivo existe, asegurarse de que termine con un salto de línea
        $contenido_actual = file_get_contents($archivo);
        if (substr($contenido_actual, -1) !== "\n") {
            // Si el archivo no termina con un salto de línea, agregarlo
            file_put_contents($archivo, "\n", FILE_APPEND);
        }
    }

    // Agregar los datos al archivo
    file_put_contents($archivo, $linea, FILE_APPEND);

    // Retornar éxito
    echo "Datos guardados correctamente";
} else {
    echo "Error: Solo se permiten solicitudes POST.";
}
?>
