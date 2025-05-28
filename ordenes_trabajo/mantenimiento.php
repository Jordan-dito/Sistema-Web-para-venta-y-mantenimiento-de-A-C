<?php

include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


include('../app/controllers/clientes/listado_de_clientes.php');
// Consulta SQL para obtener los técnicos y sus horarios
$query = "SELECT ht.ID_HorarioTecnico, ht.ID_Usuario, ht.Dia_Inicio_Semana, ht.Dia_Fin_Semana, ht.Horario_Inicio, ht.Horario_Fin, u.nombres, u.apellidos 
          FROM horariostecnicos ht 
          INNER JOIN tb_usuarios u ON ht.ID_Usuario = u.ID_Usuario";

try {
    // Ejecutar la consulta y obtener los resultados
    $resultadoConsulta = $pdo->query($query);
    $tecnicos = $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit();
}



// Consulta para obtener el último número de factura
$sql = "SELECT numero_factura FROM ordenes_instalacion ORDER BY numero_factura DESC LIMIT 1";
$stmt = $pdo->query($sql);
$ultima_factura = $stmt->fetch(PDO::FETCH_ASSOC);

// Determinar el siguiente número de factura
if ($ultima_factura) {
    // Incrementar el último número de factura y agregar ceros a la izquierda
    $nuevo_numero_factura = str_pad((int)$ultima_factura['numero_factura'] + 1, 3, '0', STR_PAD_LEFT);
} else {
    // Si no hay facturas, empezar desde 001
    $nuevo_numero_factura = '001';
}




// Consulta para obtener productos activos de la categoría "repuestos"
$sqlProductos = "SELECT a.id_producto, a.codigo, a.nombre, a.id_categoria, a.imagen, a.precio_venta, a.estado, a.descripcion, c.nombre_categoria
                 FROM tb_almacen a
                 INNER JOIN tb_categorias c ON a.id_categoria = c.id_categoria
                 WHERE LOWER(c.nombre_categoria) = 'repuestos'
                   AND a.estado = 'activo'";
$stmtProductos = $pdo->query($sqlProductos);
$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Mantenimiento</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">

                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ordenes de trabajo Mantenimiento </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <!-- Campo Fecha de Orden -->
                            <div class="form-group">
                                <label for="fecha_orden">Fecha de Orden:</label>
                                <input type="date" id="fecha_orden" name="fecha_orden" class="form-control" required>
                            </div>

                            <!-- Botón para Seleccionar Factura y Modal -->
                            <!-- Botón para Seleccionar Factura y Modal -->
                            <div class="form-group">
                                <label for="numero_factura">Número de Factura:</label>
                                <div class="input-group">
                                    <!-- El valor del número de factura se obtiene de PHP -->
                                    <input type="text" id="numero_factura" name="numero_factura" class="form-control" value="<?php echo $nuevo_numero_factura; ?>" readonly>

                                </div>
                            </div>

                            <!-- Campos de Cliente -->
                            <div class="form-group">
                                <label for="cedula">Cédula:</label>
                                <input type="text" id="cedula" name="cedula" class="form-control" onkeyup="verificarCedula()" required />
                            </div>



                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="email" id="correo" name="correo" class="form-control" required readonly>
                            </div>

                            <!-- Botón para seleccionar Técnico y Modal -->
                            <div class="form-group">
                                <label for="tecnico">Técnico:</label>
                                <div class="input-group">
                                    <input type="text" id="tecnico" name="tecnico" class="form-control" readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTecnico">
                                            Seleccionar Técnico
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para seleccionar técnico -->
                            <div class="modal fade" id="modalTecnico" tabindex="-1" role="dialog" aria-labelledby="modalTecnicoLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTecnicoLabel">Seleccionar Técnico</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Aquí va la lista de técnicos generada dinámicamente con PHP -->
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID Técnico</th>
                                                        <th>Nombre</th>
                                                        <th>Horario</th>
                                                        <th>Seleccionar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Mostrar la tabla con los técnicos y sus horarios
                                                    foreach ($tecnicos as $tecnico) {
                                                        $nombreCompleto = $tecnico['nombres'] . " " . $tecnico['apellidos'];
                                                        $horario = "{$tecnico['Dia_Inicio_Semana']} a {$tecnico['Dia_Fin_Semana']}, de {$tecnico['Horario_Inicio']} a {$tecnico['Horario_Fin']}";
                                                        echo "<tr>
                                <td>{$tecnico['ID_HorarioTecnico']}</td>
                                <td>{$nombreCompleto}</td>
                                <td>{$horario}</td>
                                <td><button type='button' class='btn btn-success' onclick='seleccionarTecnico(\"{$nombreCompleto}\", \"{$tecnico['ID_HorarioTecnico']}\")'>Seleccionar</button></td>
                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campo de Fecha y Hora -->
                            <div class="form-group">
                                <label for="fecha_hora">Fecha y Hora de Mantenimiento:</label>
                                <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control" required min="<?php echo date('Y-m-d\TH:i'); ?>">
                            </div>

                            <!-- Campo Instalación o Mantenimiento -->
                            <!-- Campo Tipo de Servicio -->
                            <div class="form-group">
                                <label for="tipo_servicio">Tipo de Servicio:</label>
                                <select id="tipo_servicio" class="form-control" required>
                                    <option value="">Seleccione...</option>
                                    <option value="mantenimiento">Mantenimiento</option>
                                    <option value="reparacion">Reparación</option>
                                </select>
                            </div>




                            <!-- Separador -->
                            <hr>

                            <!-- Botón para seleccionar Repuesto y Modal -->
                            <div class="form-group">
                                <label for="repuesto">A/C COMPRADOS POR EL CLIENTE :</label>
                                <div class="input-group">
                                    <input type="text" id="repuesto" name="repuesto" class="form-control" readonly>
                                    <input type="hidden" id="cantidad_ac" name="cantidad_ac" value="0">


                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRepuesto">
                                            Seleccionar A/C
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="costo_servicio">Costo del servicio ($)</label>
                                <input type="number" id="costo_servicio" class="form-control" value="0" step="0.01">
                            </div>




                            <!-- Modal para seleccionar repuesto -->
                            <!-- Modal para seleccionar repuesto -->
                            <!-- Modal para seleccionar repuesto -->
                            <!-- Modal para seleccionar A/C comprado por el cliente -->
                            <div class="modal fade" id="modalRepuesto" tabindex="-1" role="dialog" aria-labelledby="modalRepuestoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalRepuestoLabel">Seleccionar A/C Comprado</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered" id="tabla-productos">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Descripción</th>
                                                        <th>Precio Venta</th>
                                                        <th>Cantidad</th>
                                                        <th>Seleccionar</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody> <!-- Aquí se insertan dinámicamente -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <!-- Espacio en blanco para mostrar datos -->
                            <!-- Área para mostrar el resumen (precio venta, adicional y total) -->
                            <div class="form-group">
                                <label for="datos_extra">Resumen del Repuesto:</label>
                                <!-- Este div actuará como contenedor estilizado para el resumen -->



                                <div id="datos_extra" class="card card-body bg-light" style="white-space: pre-wrap; border: 1px solid #ddd;"></div>

                                <!-- Campo para seleccionar IVA -->
                                <div class="form-group">
                                    <label for="iva_repuesto">IVA (%)</label>
                                    <input type="number" id="iva_repuesto" class="form-control" value="15" min="0" max="100" step="0.01">
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="guardarOrden()">Guardar Orden</button>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <!-- Tarjeta: Mantenimientos Programados -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            Mantenimientos Programados
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Factura</th>

                                         <th>Tipo Servicio</th>
                                        <th>Fecha Mantenimiento</th>
                                        <th>Próximo Mantenimiento</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-mantenimientos">
                                    <!-- Datos dinámicos -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tarjeta: Actualizar Mantenimiento -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Actualizar Mantenimiento
                        </div>
                        <div class="card-body">
                            <form id="formActualizar">
                                <input type="hidden" id="id_mantenimiento">

                                <div class="form-group">
                                    <label for="fecha_mantenimiento">Fecha de Mantenimiento:</label>
                                    <input type="datetime-local" id="fecha_mantenimiento" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="fecha_proximo_mantenimiento">Próximo Mantenimiento:</label>
                                    <input type="datetime-local" id="fecha_proximo_mantenimiento" class="form-control" readonly>
                                </div>

                                <button type="button" class="btn btn-success mt-3" onclick="actualizarMantenimiento()">
                                    Guardar Cambios
                                </button>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

</div>
<!-- /.content-wrapper -->

<!-- Script para seleccionar Factura, Técnico, Repuesto -->
<script>
    let ultimoProductoSeleccionado = {
        nombre: '',
        descripcion: '',
        cantidad: 0
    };

    function seleccionarFactura(numero) {
        document.getElementById('numero_factura').value = numero;
        $('#modalFactura').modal('hide');
    }

    function seleccionarTecnico(nombre, id) {
        document.getElementById('tecnico').value = nombre;
        document.getElementById('tecnico').dataset.idTecnico = id;
        $('#modalTecnico').modal('hide');
    }

    function verificarCedula() {
        const cedulaValor = document.getElementById('cedula').value.trim();

        if (cedulaValor.length === 10) {
            // Buscar cliente
            const urlCliente = `../app/controllers/ordenes_trabajo/buscar_cliente.php?cedula=${cedulaValor}`;
            fetch(urlCliente)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('correo').value = data.correo;
                        console.log("Cliente encontrado:", data);

                        // Cargar productos comprados por cédula
                        cargarProductosPorCedula(cedulaValor);
                    } else {
                        document.getElementById('nombre').value = "";
                        document.getElementById('correo').value = "";
                        Swal.fire({
                            icon: 'error',
                            title: 'No encontrado',
                            text: 'No se encontró un cliente con esa cédula.'
                        });
                    }
                })
                .catch(error => {
                    console.error("Error al buscar cliente:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al buscar el cliente.'
                    });
                });
        } else {
            document.getElementById('nombre').value = "";
            document.getElementById('correo').value = "";
            console.log("Cédula inválida:", cedulaValor);
        }
    }

    function cargarProductosPorCedula(cedula) {
        const url = `../app/controllers/ventas/buscar_ventas_por_cedula.php?cedula=${cedula}`;
        fetch(url)
            .then(res => res.json())
            .then(data => {
                const tbody = document.querySelector("#tabla-productos tbody");
                tbody.innerHTML = "";

                if (data.success && data.productos.length > 0) {
                    data.productos.forEach(prod => {
                        const fila = `
                        <tr>
    <td>${prod.nombre}</td>
    <td>${prod.descripcion}</td>
    <td>$${parseFloat(prod.precio_venta).toFixed(2)}</td>
    <td>${prod.cantidad_total}</td>
    <td>
        <button class="btn btn-success btn-sm" 
          onclick="seleccionarRepuesto('${prod.nombre}', '${prod.descripcion}', '${prod.precio_venta}', '${prod.cantidad_total}', '${prod.id_producto}')"

            Seleccionar
        </button>
    </td>
</tr>`;
                        tbody.innerHTML += fila;
                    });
                    $('#modalRepuesto').modal('show');
                } else {
                    Swal.fire("Aviso", "No se encontraron productos comprados para esta cédula", "info");
                }
            })
            .catch(error => {
                console.error("Error al cargar productos:", error);
            });
    }

    function seleccionarRepuesto(nombre, descripcion, precio_venta, cantidad_total, id_producto) {
        document.getElementById('repuesto').value = nombre;
        document.getElementById('repuesto').dataset.idProducto = id_producto; // ← Aquí asignas el ID correctamente
        document.getElementById('cantidad_ac').value = cantidad_total;

        ultimoProductoSeleccionado = {
            nombre: nombre,
            descripcion: descripcion,
            cantidad: parseInt(cantidad_total)
        };

        actualizarResumen();
        $('#modalRepuesto').modal('hide');
    }


    document.getElementById('iva_repuesto').addEventListener('input', actualizarResumen);
    document.getElementById('costo_servicio').addEventListener('input', actualizarResumen);

    function actualizarResumen() {
        const nombre = ultimoProductoSeleccionado.nombre;
        const descripcion = ultimoProductoSeleccionado.descripcion;
        const cantidad = ultimoProductoSeleccionado.cantidad;

        if (!nombre || cantidad <= 0) return; // Evita mostrar si no hay producto

        const costoServicioUnitario = parseFloat(document.getElementById('costo_servicio').value) || 0;
        const ivaPorcentaje = parseFloat(document.getElementById('iva_repuesto').value) || 0;

        const totalServicio = costoServicioUnitario * cantidad;
        const iva = totalServicio * (ivaPorcentaje / 100);
        const totalFinal = totalServicio + iva;

        const resumen = `
Nombre: ${nombre}
Descripción: ${descripcion}
Cantidad seleccionada: ${cantidad}
Costo Servicio: $${totalServicio.toFixed(2)}
IVA (${ivaPorcentaje}%): $${iva.toFixed(2)}
Total Servicio + IVA: $${totalFinal.toFixed(2)}
    `;
        document.getElementById('datos_extra').textContent = resumen;
    }




    function guardarOrden() {
        const fechaHora = document.getElementById('fecha_hora').value;
        const tipoServicio = document.getElementById('tipo_servicio').value;
        const tecnico = document.getElementById('tecnico').dataset.idTecnico;
        const repuesto = document.getElementById('repuesto').dataset.idProducto;

        // Validaciones básicas
        if (!fechaHora) {
            Swal.fire("Campo requerido", "Debes seleccionar la fecha y hora de mantenimiento", "warning");
            return;
        }

        if (!tipoServicio) {
            Swal.fire("Campo requerido", "Debes seleccionar el tipo de servicio", "warning");
            return;
        }

        if (!tecnico) {
            Swal.fire("Campo requerido", "Debes seleccionar un técnico", "warning");
            return;
        }

        if (!repuesto) {
            Swal.fire("Campo requerido", "Debes seleccionar un producto A/C", "warning");
            return;
        }

        const cantidad = parseInt(document.getElementById('cantidad_ac').value) || 0;
        const costoUnitario = parseFloat(document.getElementById('costo_servicio').value) || 0;
        const ivaPorcentaje = parseFloat(document.getElementById('iva_repuesto').value) || 0;

        const costoTotal = cantidad * costoUnitario;
        const valorIva = costoTotal * (ivaPorcentaje / 100);
        const totalConIva = costoTotal + valorIva;

        const datos = {
            fecha_orden: document.getElementById('fecha_orden').value,
            numero_factura: document.getElementById('numero_factura').value,
            cedula: document.getElementById('cedula').value,
            nombre_cliente: document.getElementById('nombre').value,
            correo_cliente: document.getElementById('correo').value,
            id_horario_tecnico: tecnico,
            fecha_mantenimiento: fechaHora,
            id_producto: repuesto,
            cantidad: cantidad,
            costo_servicio: costoTotal.toFixed(2),
            iva_porcentaje: ivaPorcentaje,
            valor_iva: valorIva.toFixed(2),
            total_con_iva: totalConIva.toFixed(2),
            datos_extras: document.getElementById('datos_extra').textContent,
            tipo_servicio: tipoServicio
        };

        fetch('../app/controllers/ordenes_trabajo/guardar_orden.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Éxito", "Orden guardada correctamente", "success").then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire("Error", data.message || "Ocurrió un error al guardar", "error");
                }
            })
            .catch(error => {
                console.error("Error en AJAX:", error);
                Swal.fire("Error", "No se pudo guardar la orden", "error");
            });
    }
</script>


<script>
    function cargarMantenimientos() {
        fetch('../app/controllers/ordenes_trabajo/listar_mantenimientos.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('tabla-mantenimientos');
                tbody.innerHTML = "";

                data.forEach(mantenimiento => {
                    const estado = (new Date(mantenimiento.fecha_mantenimiento) < new Date()) ? "<span class='badge bg-danger'>Pendiente</span>" :
                        (new Date(mantenimiento.fecha_mantenimiento).toDateString() === new Date().toDateString()) ? "<span class='badge bg-warning'>Hoy</span>" :
                        "<span class='badge bg-success'>Programado</span>";

                    const fila = `
                            <tr>
                                <td>${mantenimiento.numero_factura}</td>
                                <td>${mantenimiento.tipo_servicio}</td> 
                                <td>${mantenimiento.fecha_mantenimiento}</td>
                                <td>${mantenimiento.fecha_proximo_mantenimiento ?? 'No programado'}</td>
                                <td>${estado}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="abrirModal('${mantenimiento.id_mantenimiento}', '${mantenimiento.fecha_mantenimiento}', '${mantenimiento.fecha_proximo_mantenimiento}')">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        `;
                    tbody.innerHTML += fila;
                });
            })
            .catch(error => console.error("Error al cargar mantenimientos:", error));
    }

    function abrirModal(id, fechaMantenimiento, fechaProximo) {
        document.getElementById('id_mantenimiento').value = id;
        document.getElementById('fecha_mantenimiento').value = fechaMantenimiento;

        // Si la fecha está en null, se asigna hoy
        if (fechaProximo === "No programado" || fechaProximo === null) {
            const hoy = new Date().toISOString().slice(0, 16); // Formato correcto para el input
            document.getElementById('fecha_proximo_mantenimiento').value = hoy;
        } else {
            document.getElementById('fecha_proximo_mantenimiento').value = fechaProximo;
        }
    }

    function actualizarMantenimiento() {
        const datos = {
            id_mantenimiento: document.getElementById('id_mantenimiento').value,
            fecha_mantenimiento: document.getElementById('fecha_mantenimiento').value
        };

        fetch('../app/controllers/ordenes_trabajo/actualizar_mantenimiento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Éxito", "Próximo mantenimiento programado para: " + data.proximo_mantenimiento, "success");
                    document.getElementById('fecha_proximo_mantenimiento').value = data.proximo_mantenimiento;
                    cargarMantenimientos();
                } else {
                    Swal.fire("Error", data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error en AJAX:", error);
                Swal.fire("Error", "No se pudo actualizar el mantenimiento", "error");
            });
    }

    // Cargar los mantenimientos al iniciar la página
    cargarMantenimientos();
</script>


<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>