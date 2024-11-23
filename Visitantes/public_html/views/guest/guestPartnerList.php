
<?php require_once __DIR__ . '/../topPartner.php'; ?>

<!-- INICIO -->

<!-- Muestra la lista de visitantes utilizando Bootstrap -->
<div class="container">
    <h2 class="text-center p-2">Lista de Visitantes</h2>
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
                    <input type="radio" class="btn-check" name="guest-options" id="radioGuestName" value="name" data-column="1" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="radioGuestName"><strong>Nombre</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="guest-options" id="radioGuestMail" value="mail" data-column="2" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioGuestMail"><strong>Correo</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="guest-options" id="radioGuestAddress" value="subject" data-column="3" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioGuestAddress"><strong>Asunto</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="guest-options" id="radioGuestNote" value="note" data-column="4" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioGuestNote"><strong>Comentario</strong></label>
                </div>
            </div>
            <div class="col p-2">
                <div class="d-grid">
                    <input type="radio" class="btn-check" name="guest-options" id="radioGuestDate" value="date" data-column="5" autocomplete="off">
                    <label class="btn btn-outline-dark" for="radioGuestDate"><strong>Fecha</strong></label>
                </div>
            </div>
        </div>
    </div>
    <!-- Buscador y botón para descargar archivo Excel -->
    <div class="container">
        <div class="row mt-2 mb-3 align-items-center">
            <div class="col-8">
                <div class="row">
                    <label for="inputPartnerGuestSearch" class="col-sm-3 col-form-label">Buscador:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPartnerGuestSearch" placeholder="Escriba aquí para buscar" aria-label="Escriba aquí para buscar">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-grid">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#guestExportConfirm">
                        Exportar Excel <i class="bi bi-file-earmark-excel"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: Confirmar descarga -->
    <div class="modal fade" id="guestExportConfirm" tabindex="-1" aria-labelledby="guestExportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="guestExportModalLabel">Confirmar descarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás segura/o que deseas exportar el archivo con la información actual?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnPartnerGuestExport" class="btn btn-success">Descargar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla: Encabezados y registros cargados desde script.js -->
    <div class="container">
        <div class="table-responsive">
            <table id="guestTable" class="table align-middle table-hover table-bordered">
                <thead class="table-dark">
                    <tr class="align-middle">
                        <th class="d-none">ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Asunto</th>
                        <th>Comentario</th>
                        <th>Fecha registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos de los visitantes se cargarán aquí a través de AJAX -->
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal para editar visitante -->
<div class="modal fade" id="editGuestModal" tabindex="-1" aria-labelledby="editGuestModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editGuestModal">Editar colaborador</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="partnerUpdateForm" method="POST" autocomplete="off">
                    <input type="hidden" name="inputEditIdGuest" id="inputEditIdGuest" value="">
                    <div class="row mb-3">
                        <label for="inputEditNameGuest" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditNameGuest" name="inputEditNameGuest" placeholder="Escriba el nombre" required>
                            <p id="editNameGuestMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditEmailGuest" class="col-sm-2 col-form-label">Correo</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEditEmailGuest" name="inputEditEmailGuest" placeholder="Escriba el correo" required>
                            <p id="editEmailGuestMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditSubjectGuest" class="col-sm-2 col-form-label">Asunto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditSubjectGuest" name="inputEditSubjectGuest" placeholder="Escriba el asunto" required>
                            <p id="editSubjectGuestMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditNoteGuest" class="col-sm-2 col-form-label">Comentario</label>
                        <div class="col-sm-10">
                            <textarea id="inputEditNoteGuest" name="inputEditNoteGuest" class="form-control" rows="3" placeholder="Escriba el comentario"></textarea>
                            <p id="editNoteGuestMsg" class="hide-element"></p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btnUpdateGuest">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Visitante -->
    <!-- Modal -->
    <div class="modal fade" id="deleteGuestModal" tabindex="-1" aria-labelledby="deleteGuestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- modal-lg -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteGuestModalLabel">Eliminar Visitante</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás segura/o de eliminar a este Visitante?</p>
                    <input type="hidden" id="deleteGuestID" value="">
                    <div class="row">
                        <label for="deleteGuestName" class="col-sm-3 col-form-label fw-bold">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteGuestName" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteGuestEmail" class="col-sm-3 col-form-label fw-bold">Correo</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteGuestEmail" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteGuestSubject" class="col-sm-3 col-form-label fw-bold">Asunto</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteGuestSubject" value="">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteGuestNote" class="col-sm-3 col-form-label fw-bold">Comentario</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" rows="3" id="deleteGuestNote" value=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label for="deleteGuestDate" class="col-sm-3 col-form-label fw-bold">Fecha registro</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="deleteGuestDate" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteGuest">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

<!-- FIN -->

<?php require_once __DIR__ . '/../bottomPartner.php'; ?>