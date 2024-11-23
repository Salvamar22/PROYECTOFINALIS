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

<!-- Muestra la lista de colaboradores utilizando Bootstrap -->
<div class="container">
    <h2 class="text-center p-2">Lista de Visitas</h2>
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
                    <input type="radio" class="btn-check" name="visit-options" id="radioVisitName" value="name" data-column="2" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="radioVisitName"><strong>Visitante</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="visit-options" id="radioVisitSubject" value="subject" data-column="3" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioVisitSubject"><strong>Asunto</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="visit-options" id="radioVisitNote" value="note" data-column="4" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioVisitNote"><strong>Comentario</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="visit-options" id="radioVisitNumber" value="numer" data-column="5" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioVisitNumber"><strong>Cantidad</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="visit-options" id="radioVisitDate" value="date" data-column="6" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioVisitDate"><strong>Fecha</strong></label>
                </div>
            </div>
        </div>
    </div>
    <!-- Buscador y botón para descargar archivo Excel -->
    <div class="container">
        <div class="row mt-2 mb-3 align-items-center">
            <div class="col-8">
                <div class="row">
                    <label for="inputVisitSearch" class="col-sm-3 col-form-label">Buscador:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputVisitSearch" placeholder="Escriba aquí para buscar" aria-label="Escriba aquí para buscar">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-grid">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#visitExportConfirm">
                        Exportar Excel <i class="bi bi-file-earmark-excel"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: Confirmar descarga -->
    <div class="modal fade" id="visitExportConfirm" tabindex="-1" aria-labelledby="visitExportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="visitExportModalLabel">Confirmar descarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás segura/o que deseas exportar el archivo con la información actual?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnVisitExport" class="btn btn-success">Descargar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla: Encabezados y registros cargados desde script.js -->
    <table id="visitTable" class="table align-middle table-hover table-bordered">
        <thead class="table-dark">
            <tr class="align-middle">
                <th class="d-none">ID Visita</th>
                <th class="d-none">Colaborador</th>
                <th>Visitante</th>
                <th>Asunto</th>
                <th>Comentario</th>
                <th>Cantidad</th>
                <th>Fecha de visita</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos de los Visitantes se cargarán aquí a través de AJAX -->
        </tbody>
    </table>
</div>

<!-- Boton de Modal para editar visitante se encuentra en la funcion loadVisits del codigo AJAX -->

<!-- Modal para editar visitante -->
<div class="modal fade" id="editVisitModal" tabindex="-1" aria-labelledby="editVisitModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editVisitModal">Editar visita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" autocomplete="off">
                    <input type="hidden" name="action" value="edit_visit">
                    <input type="hidden" name="inputEditIdVisit" id="inputEditIdVisit" value="">

                    <div class="row mb-3">
                        <label for="inputEditVisitPartnerName" class="col-sm-2 col-form-label">Colaborador</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" id="inputEditVisitPartnerName" name="inputEditVisitPartnerName" readonly>
                            <p id="visitPartnerNameMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitGuestName" class="col-sm-2 col-form-label">Visitante</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" id="inputEditVisitGuestName" name="inputEditVisitGuestName" readonly>
                            <p id="visitGuestNameMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitSubject" class="col-sm-2 col-form-label">Asunto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditVisitSubject" name="inputEditVisitSubject" placeholder="Escriba el asunto" required>
                            <p id="visitSubjectMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitNote" class="col-sm-2 col-form-label">Comentario</label>
                        <div class="col-sm-10">
                            <textarea id="inputEditVisitNote" name="inputEditVisitNote" class="form-control" rows="3" placeholder="Escriba el comentario"></textarea>
                            <p id="visitNoteMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitNumber" class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputEditVisitNumber" name="inputEditVisitNumber" placeholder="Escriba la cantidad" required>
                            <p id="visitNumberMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btnUpdateVisit">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Visitante -->
    <!-- Modal -->
    <div class="modal fade" id="deleteVisitModal" tabindex="-1" aria-labelledby="deleteVisitModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- modal-lg -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteVisitModalLabel">Eliminar Visita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás segura/o de eliminar esta Visita?</p>
                    <input type="hidden" id="deleteVisitID" value="">
                    <div class="row">
                        <label for="deleteVisitPartner" class="col-sm-3 col-form-label fw-bold">Colaborador</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteVisitPartner" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteVisitGuest" class="col-sm-3 col-form-label fw-bold">Visitante</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteVisitGuest" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteVisitSubject" class="col-sm-3 col-form-label fw-bold">Asunto</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteVisitSubject" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteVisitNumber" class="col-sm-3 col-form-label fw-bold">Cantidad</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteVisitNumber" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteVisitNote" class="col-sm-3 col-form-label fw-bold">Comentario</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" rows="3" id="deleteVisitNote" value=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteVisitDate" class="col-sm-3 col-form-label fw-bold">Fecha registro</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteVisitDate" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteVisit">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

<!-- FIN -->

<?php require_once __DIR__ . '/../bottom.php'; ?>