<?php
//session_start();
/*
// Iniciar sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (empty($_SESSION["idColaborador"])) {
    header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/../login.php');
    exit();
}
*/
?>
<?php require_once __DIR__ . '/../top.php'; ?>

<!-- INICIO -->

<!-- Muestra la lista de colaboradores utilizando Bootstrap -->
<div class="container">
    <h2 class="text-center p-2">Lista de Colaboradores</h2>
    <!-- Filtros para realizar búsqueda -->
    <div class="container text-center">
        <div class="row row-cols-2 row-cols-md-4">
            <div class="col p-2">
                <div class="d-grid">
                    <label class="col-form-label">Selecciona filtro:</label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerName" value="name" data-column="1" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="radioPartnerName"><strong>Nombres</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerLastName" value="lastName" data-column="2" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioPartnerLastName"><strong>Apellidos</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerDUI" value="dui" data-column="3" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioPartnerDUI"><strong>DUI</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerAddress" value="address" data-column="4" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioPartnerAddress"><strong>Dirección</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerMail" value="mail" data-column="5" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioPartnerMail"><strong>Correo</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerPhone" value="phone" data-column="6" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioPartnerPhone"><strong>Celular</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="partner-options" id="radioPartnerDate" value="date" data-column="7" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioPartnerDate"><strong>Fecha Nac.</strong></label>
                </div>
            </div>
        </div>
    </div>
    <!-- Buscador y botón para descargar archivo Excel -->
    <div class="container">
        <div class="row mt-2 mb-3 align-items-center">
            <div class="col-8">
                <div class="row">
                    <label for="inputPartnerSearch" class="col-sm-3 col-form-label">Buscador:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPartnerSearch" placeholder="Escriba aquí para buscar" aria-label="Escriba aquí para buscar">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-grid">
                    <!-- <button type="button" class="btn btn-success" id="btnPartnerExport">Exportar Excel <i class="bi bi-file-earmark-excel"></i></button> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#partnerExportConfirm">
                        Exportar Excel <i class="bi bi-file-earmark-excel"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: Confirmar descarga -->
    <div class="modal fade" id="partnerExportConfirm" tabindex="-1" aria-labelledby="partnerExportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                    <button type="button" id="btnPartnerExport" class="btn btn-success">Descargar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla: Encabezados y registros cargados desde script.js -->
    <div class="container">
        <div class="table-responsive">
            <table id="partnerTable" class="table align-middle table-hover table-bordered">
                <thead class="table-dark">
                    <tr class="align-middle">
                        <th class="d-none">ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DUI</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Fecha de Nacimiento</th>
                        <!-- <th>Fecha de Contratación</th> -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> <!-- class="table-group-divider" -->
                    <!-- Los datos de los colaboradores se cargarán aquí a través de AJAX -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal para Actualizar/Editar Colaborador -->
    <div class="modal fade" id="editPartnerModal" tabindex="-1" aria-labelledby="editPartnerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPartnerModalLabel">Editar Colaborador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="partnerUpdateForm" method="POST" autocomplete="off">
                        <input type="hidden" name="inputEditIdPartner" id="inputEditIdPartner" value="">
                        <div class="row mb-3">
                            <label for="inputEditNamePartner" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEditNamePartner" name="inputEditNamePartner" placeholder="Escriba el nombre" value="" required>
                                <p id="editNamePartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEditLastNamePartner" class="col-sm-2 col-form-label">Apellido</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEditLastNamePartner" name="inputEditLastNamePartner" placeholder="Escriba el apellido" required>
                                <p id="editLastNamePartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEditDuiPartner" class="col-sm-2 col-form-label">DUI</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEditDuiPartner" name="inputEditDuiPartner" placeholder="Escriba el DUI" required>
                                <p id="editDuiPartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEditAddressPartner" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
                            <div class="col-sm-10">
                                <textarea id="inputEditAddressPartner" name="inputEditAddressPartner" class="form-control" rows="2" placeholder="Escriba la direccion" required></textarea>
                                <p id="editAddressPartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEditEmailPartner" class="col-sm-2 col-form-label">Correo</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEditEmailPartner" name="inputEditEmailPartner" placeholder="Escriba el correo" required>
                                <p id="editEmailPartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEditPhonePartner" class="col-sm-2 col-form-label">Celular</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEditPhonePartner" name="inputEditPhonePartner" placeholder="Escriba el celular" required>
                                <p id="editPhonePartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEditDateBirthPartner" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="inputEditDateBirthPartner" name="inputEditDateBirthPartner" required>
                                <p id="editDateBirthPartnerMsg" class="hide-element"></p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="btnUpdatePartner">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para Eliminar Colaborador -->
    <!-- Modal -->
    <div class="modal fade" id="deletePartnerModal" tabindex="-1" aria-labelledby="deletePartnerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePartnerModalLabel">Eliminar Colaborador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás segura/o de eliminar a este Colaborador?</p>
                    <input type="hidden" id="deletePartnerID" value="">
                    <div class="row">
                        <label for="deletePartnerName" class="col-sm-2 col-form-label fw-bold">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="deletePartnerName" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deletePartnerDUI" class="col-sm-2 col-form-label fw-bold">DUI</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="deletePartnerDUI" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deletePartnerAddress" class="col-sm-2 col-form-label fw-bold">Dirección</label>
                        <div class="col-sm-10">
                            <!-- <input type="text" readonly class="form-control-plaintext" id="deletePartnerAddress" value=""> -->
                            <textarea type="text" readonly class="form-control-plaintext" id="deletePartnerAddress" value=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label for="deletePartnerMail" class="col-sm-2 col-form-label fw-bold">Correo</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="deletePartnerMail" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deletePartnerPhone" class="col-sm-2 col-form-label fw-bold">Celular</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="deletePartnerPhone" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deletePartnerDate" class="col-sm-2 col-form-label fw-bold">DUI</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="deletePartnerDate" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btnDeletePartner">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN -->

    <?php require_once __DIR__ . '/../bottom.php'; ?>