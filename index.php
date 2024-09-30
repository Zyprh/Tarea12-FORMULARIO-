<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <!-- CDN de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-center mb-4">Formulario de Producto</h1>

    <!-- Formulario de entrada (sin cambios) -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Complete los datos del producto</h2>
        </div>
        <div class="card-body">
        <form id="productoForm" class="row g-3" method="POST">
                <div class="col-md-6">
                    <label for="campo1" class="form-label">Id</label>
                    <input type="text" class="form-control" name="campo1" required>
                </div>
                <div class="col-md-6">
                    <label for="campo2" class="form-label">Fecha de Venta</label>
                    <input type="date" class="form-control" name="campo2" required>
                </div>
                <div class="col-md-6">
                    <label for="campo3" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="campo3" required>
                </div>
                <div class="col-md-6">
                    <label for="campo4" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="form-control" name="campo4" required>
                </div>
                <div class="col-md-6">
                    <label for="campo5" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="campo5" step="0.01" required>
                </div>
                <div class="col-md-6">
                    <label for="campo6" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" name="campo6" required>
                </div>
                <div class="col-md-6">
                    <label for="campo7" class="form-label">Categoría</label>
                    <input type="text" class="form-control" name="campo7" required>
                </div>
                <div class="col-md-6">
                    <label for="campo8" class="form-label">Almacén</label>
                    <input type="text" class="form-control" name="campo8" required>
                </div>
                <div class="col-md-6">
                    <label for="campo9" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="campo9" required>
                </div>
                <div class="col-md-6">
                    <label for="campo10" class="form-label">Tipo de Producto</label>
                    <input type="text" class="form-control" name="campo10" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Botones de Mostrar/Ocultar Tabla -->
    <div class="text-center mt-4">
        <button type="button" id="mostrarTablaBtn" class="btn btn-success">Mostrar Tabla</button>
        <button type="button" id="ocultarTablaBtn" class="btn btn-danger" style="display:none;">Ocultar Tabla</button>
    </div>

    <!-- Tabla para los datos recuperados -->
    <div class="card mt-5 shadow-sm" id="tablaCard" style="display: none;">
        <div class="card-header bg-secondary text-white">
            <h2 class="h4 mb-0">Datos Recuperados</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><strong>Id</strong></th>
                    <th><strong>Fecha Venta</strong></th>
                    <th><strong>Nombre</strong></th>
                    <th><strong>Fecha Vencimiento</strong></th>
                    <th><strong>Precio</strong></th>
                    <th><strong>Proveedor</strong></th>
                    <th><strong>Categoría</strong></th>
                    <th><strong>Almacén</strong></th>
                    <th><strong>Stock</strong></th>
                    <th><strong>Tipo Producto</strong></th>
                </tr>
            </thead>

                <tbody id="tablaContenido">
                    <!-- Aquí se agregarán dinámicamente los datos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#productoForm').on('submit', function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del formulario

        // Enviar los datos del formulario usando AJAX
        $.ajax({
            url: 'guardar_datos.php',
            type: 'POST', // Cambiar a POST
            data: $('#productoForm').serialize(), // Serializa los datos del formulario
            success: function(response) {
                alert(response); // Mostrar el mensaje de éxito del servidor
                
                // Reiniciar el formulario
                $('#productoForm')[0].reset();
            },
            error: function() {
                alert('Error al enviar los datos.');
            }
        });
    });
});

        // Mostrar tabla al hacer clic en "Mostrar Tabla"
        $('#mostrarTablaBtn').on('click', function() {
            $.ajax({
                url: 'leer_datos.php',
                type: 'GET',
                dataType: 'json',
                success: function(datos) {
                    $('#tablaContenido').empty();
                    if (datos[0] && typeof datos[0] === 'string' && datos[0].includes("Error")) {
                        alert(datos[0]);
                        return;
                    }
                    var filas = '';
                    for (var i = 0; i < datos.length; i++) {
                        filas += '<tr>';
                        for (var j = 0; j < datos[i].length; j++) {
                            filas += '<td>' + datos[i][j] + '</td>';
                        }
                        filas += '</tr>';
                    }
                    $('#tablaContenido').append(filas);
                    $('#tablaCard').show();
                    $('#mostrarTablaBtn').hide();
                    $('#ocultarTablaBtn').show();
                },
                error: function() {
                    alert('Error al leer los datos.');
                }
            });
        });

        // Ocultar la tabla al hacer clic en "Ocultar Tabla"
        $('#ocultarTablaBtn').on('click', function() {
            $('#tablaCard').hide();
            $('#tablaContenido').empty();
            $('#mostrarTablaBtn').show();
            $('#ocultarTablaBtn').hide();
        });
</script>


</body>
</html>
