<?php
//session_start();
/*
if (empty($_SESSION["idColaborador"])) {
    header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/../login.php');
    exit();
}
*/
?>
<?php require_once __DIR__ . '/../top.php'; ?>

<!-- INICIO -->

<!-- Muestra la lista de usuarios utilizando Bootstrap -->
<div class="container">
    <h2 class="text-center p-2">Lista de Usuarios</h2>
    <!-- Filtros para realizar búsqueda -->
    <div class="container text-center">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6">
            <div class="col p-2">
                <div class="d-grid">
                    <label class="col-form-label">Selecciona filtro:</label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="user-options" id="radioUserName" value="name" data-column="2" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="radioUserName"><strong>Nombre</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="user-options" id="radioUserMail" value="mail" data-column="3" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioUserMail"><strong>Correo</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="user-options" id="radioUserUsername" value="user" data-column="4" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioUserUsername"><strong>Usuario</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="user-options" id="radioUserType" value="address" data-column="6" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioUserType"><strong>Tipo</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="user-options" id="radioUserDate" value="date" data-column="7" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioUserDate"><strong>Fecha Cont.</strong></label>
                </div>
            </div>
        </div>
    </div>
    <!-- Buscador y botón para descargar archivo Excel -->
    <div class="container">
        <div class="row mt-2 mb-3 align-items-center">
            <div class="col-8">
                <div class="row">
                    <label for="inputUserSearch" class="col-sm-3 col-form-label">Buscador:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputUserSearch" placeholder="Escriba aquí para buscar" aria-label="Escriba aquí para buscar">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-grid">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userExportConfirm">
                        Exportar Excel <i class="bi bi-file-earmark-excel"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: Confirmar descarga -->
    <div class="modal fade" id="userExportConfirm" tabindex="-1" aria-labelledby="userExportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="partnerExportModalLabel">Confirmar descarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás segura/o que deseas exportar el archivo con la información actual?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnUserExport" class="btn btn-success">Descargar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla: Encabezados y registros cargados desde script.js -->
    <div class="table-responsive">
        <table id="userTable" class="table align-middle table-hover table-bordered">
            <thead class="table-dark">
                <tr class="align-middle">
                    <th class="d-none">ID Usuario</th>
                    <th class="d-none">ID Colaborador</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Fecha Contratación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos de los usuarios se cargarán aquí a través de AJAX -->
            </tbody>
        </table>
    </div>
</div>


<!-- Modal para editar datos de usuario -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userEditModalLabel">Editar usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userUpdateForm" method="POST" autocomplete="off">
                    <!-- <input type="hidden" name="action" value="edit_user"> -->
                    <input type="hidden" id="userIdInput" name="userIdInput" value="">

                    <div class="row mb-3">
                        <label for="userNameInput" class="col-sm-2 col-form-label">Usuario</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userNameInput" name="userNameInput" placeholder="Escriba el nombre" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="userTypeInput" class="col-sm-2 col-form-label">Tipo</label>
                        <div class="col-sm-10">
                            <select name="userTypeInput" class="form-control" id="userTypeInput" required>
                                <!-- Los tipos de usuarios se cargarán aquí a través de AJAX -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btnUpdateUser">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar contraseña de usuario -->
<div class="modal fade" id="userPassEditModal" tabindex="-1" aria-labelledby="userPassEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userPassEditModalLabel">Editar contraseña usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userUpdateForm" method="POST" autocomplete="off">
                    <!-- <input type="hidden" name="action" value="edit_user_pass"> -->
                    <input type="hidden" id="editUserPassIdInput" name="editUserPassIdInput" value="">

                    <div class="row mb-3">
                        <label for="editUserPassInput" class="col-sm-2 col-form-label">Contrase&ntilde;a</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="editUserPassInput" name="editUserPassInput" placeholder="Escriba la contraseña" required>
                            <p id="editUserPassMsg" class="error-message"></p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btnUpdatePass">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- FIN -->

<?php require_once __DIR__ . "/../bottom.php"; ?>