<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/roles/listado_de_roles.php');





?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo usuario</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="registroUsuarioForm">
                                        <div class="form-group">
                                            <label for="cedula">Cédula</label>
                                            <input type="number" name="cedula" id="cedula" class="form-control" placeholder="Escriba aquí el número de cédula del nuevo empleado" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nombres">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" placeholder="Escriba aquí el nombre del nuevo empleado" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" placeholder="Escriba aquí el apellido del nuevo empleado" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="rol">Rol del usuario</label>
                                            <select name="rol" class="form-control" required>
                                                <?php foreach ($roles_datos as $roles_dato) { ?>
                                                    <option value="<?php echo $roles_dato['id_rol']; ?>"><?php echo $roles_dato['rol']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="telefono_empl">Teléfono</label>
                                            <input type="number" name="telefono_empl" class="form-control" placeholder="Escriba aquí el número de teléfono del nuevo empleado" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Escriba aquí el correo del nuevo usuario..." required>
                                        </div>

                                        <div class="form-group">
                                            <label for="direccion_emple">Dirección</label>
                                            <input type="text" name="direccion_emple" class="form-control" placeholder="Escriba aquí la dirección del nuevo empleado" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_user">Contraseña</label>
                                            <input type="password" name="password_user" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_repeat">Repita la Contraseña</label>
                                            <input type="password" name="password_repeat" class="form-control" required>
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>

                                    <!-- Incluir SweetAlert2 -->
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                    <script>
        document.getElementById("registroUsuarioForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            let formData = new FormData(this); // Captura los datos del formulario

            // Convertir FormData a objeto para imprimir en consola
            let formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            console.log("📤 Datos enviados:", formObject); // Imprimir datos en consola

            fetch("../app/controllers/usuarios/create.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    console.log("🔄 Estado de la respuesta:", response.status); // Estado HTTP
                    return response.json();
                })
                .then(data => {
                    console.log("📩 Respuesta del servidor:", data); // Imprimir respuesta en consola
                    if (data.status === "success") {
                        Swal.fire({
                            title: "¡Usuario Registrado!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "Aceptar"
                        });

                        // Limpiar el formulario después del registro
                        document.getElementById("registroUsuarioForm").reset();
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "Aceptar"
                        });
                    }
                })
                .catch(error => {
                    console.error("❌ Error en la petición:", error);
                    Swal.fire({
                        title: "Error",
                        text: "Ocurrió un error al registrar el usuario.",
                        icon: "error",
                        confirmButtonText: "Aceptar"
                    });
                });
        });
    </script>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Agrega esto al final de tu archivo create.php -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Función para validar la cédula usando AJAX
    function validarCedula() {
        var cedula = document.getElementById('cedula').value;

        // Realiza la petición AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../app/controllers/usuarios/validar_cedula.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                // Muestra el SweetAlert2 con el resultado de la validación
                Swal.fire({
                    title: response.title,
                    text: response.message,
                    icon: response.icon
                });
            }
        };

        // Envía la cédula al servidor
        xhr.send('cedula=' + cedula);
    }
</script>

<?php
include('../layout/parte2.php');
?>