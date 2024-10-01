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
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <th><strong>Acciones</strong></th>
                    </tr>
                </thead>

                <tbody id="tablaContenido">
                    <!-- Aquí se agregarán dinámicamente los datos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para editar producto -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición dentro del modal -->
                <form id="editarProductoForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editCampo1" class="form-label">Id</label>
                            <input type="text" class="form-control" id="editCampo1" name="campo1" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo2" class="form-label">Fecha de Venta</label>
                            <input type="date" class="form-control" id="editCampo2" name="campo2" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo3" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editCampo3" name="campo3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo4" class="form-label">Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="editCampo4" name="campo4" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo5" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="editCampo5" name="campo5" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo6" class="form-label">Proveedor</label>
                            <input type="text" class="form-control" id="editCampo6" name="campo6" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo7" class="form-label">Categoría</label>
                            <input type="text" class="form-control" id="editCampo7" name="campo7" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo8" class="form-label">Almacén</label>
                            <input type="text" class="form-control" id="editCampo8" name="campo8" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo9" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="editCampo9" name="campo9" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editCampo10" class="form-label">Tipo de Producto</label>
                            <input type="text" class="form-control" id="editCampo10" name="campo10" required>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnActualizar">Actualizar</button>
            </div>
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
                // Mostrar alerta de éxito con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Datos guardados',
                    text: response,
                    confirmButtonText: 'OK'
                });
                
                // Reiniciar el formulario
                $('#productoForm')[0].reset();

                // Recargar la tabla inmediatamente después de guardar los datos
                cargarTabla();
            },
            error: function() {
                // Mostrar alerta de error con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al enviar los datos.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

// Función para cargar la tabla
function cargarTabla() {
    $.ajax({
        url: 'leer_datos.php',
        type: 'GET',
        dataType: 'json',
        success: function(datos) {
            $('#tablaContenido').empty();
            var filas = '';
            for (var i = 0; i < datos.length; i++) {
                filas += '<tr>';
                for (var j = 0; j < datos[i].length; j++) {
                    filas += '<td>' + datos[i][j] + '</td>';
                }
                filas += '<td><button class="btn btn-warning btn-editar" data-id="' + datos[i][0] + '">Editar</button>';
                filas += ' <button class="btn btn-danger btn-eliminar" data-id="' + datos[i][0] + '">Eliminar</button></td>';
                filas += '</tr>';
            }
            $('#tablaContenido').append(filas);
        },
        error: function() {
            // Mostrar alerta de error con SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al leer los datos.',
                confirmButtonText: 'OK'
            });
        }
    });
}

// Editar producto
$(document).on('click', '.btn-editar', function() {
    var id = $(this).data('id');
    $.ajax({
        url: 'leer_datos.php',
        type: 'GET',
        dataType: 'json',
        success: function(datos) {
            for (var i = 0; i < datos.length; i++) {
                if (datos[i][0] == id) {
                    // Llenar el formulario con los datos del producto
                    $('#editCampo1').val(datos[i][0]);
                    $('#editCampo2').val(datos[i][1]);
                    $('#editCampo3').val(datos[i][2]);
                    $('#editCampo4').val(datos[i][3]);
                    $('#editCampo5').val(datos[i][4]);
                    $('#editCampo6').val(datos[i][5]);
                    $('#editCampo7').val(datos[i][6]);
                    $('#editCampo8').val(datos[i][7]);
                    $('#editCampo9').val(datos[i][8]);
                    $('#editCampo10').val(datos[i][9]);

                    // Mostrar el modal
                    $('#editarProductoModal').modal('show');
                    break;
                }
            }
        },
        error: function() {
            // Mostrar alerta de error con SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al leer los datos.',
                confirmButtonText: 'OK'
            });
        }
    });
});

// Manejar el botón "Actualizar" en el modal
$('#btnActualizar').on('click', function() {
    $.ajax({
        url: 'actualizar_datos.php',
        type: 'POST',
        data: $('#editarProductoForm').serialize(),
        success: function(response) {
            // Mostrar alerta de éxito con SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Producto actualizado',
                text: response,
                confirmButtonText: 'OK'
            });
            $('#editarProductoModal').modal('hide');
            cargarTabla();
        },
        error: function() {
            // Mostrar alerta de error con SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar los datos.',
                confirmButtonText: 'OK'
            });
        }
    });
});

// Eliminar producto
$(document).on('click', '.btn-eliminar', function() {
    var id = $(this).data('id');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'eliminar_datos.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    // Mostrar alerta de éxito con SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto eliminado',
                        text: response,
                        confirmButtonText: 'OK'
                    });
                    cargarTabla();
                },
                error: function() {
                    // Mostrar alerta de error con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar el producto.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});

// Mostrar la tabla
$('#mostrarTablaBtn').on('click', function() {
    $('#tablaCard').show();
    cargarTabla();
    $('#mostrarTablaBtn').hide();
    $('#ocultarTablaBtn').show();
});

// Ocultar la tabla
$('#ocultarTablaBtn').on('click', function() {
    $('#tablaCard').hide();
    $('#mostrarTablaBtn').show();
    $('#ocultarTablaBtn').hide();
});
</script>

</body>
</html>