<?php
//session_start();
/*
if (empty($_SESSION["idColaborador"])) {
    header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/../login.php');
    exit();
}
*/
?>
<?php require_once __DIR__ . '/../topPartner.php'; ?>

<!-- INICIO -->

<!-- Muestra la lista de colaboradores utilizando Bootstrap -->
<div class="container">
    <h2 class="text-center p-2">Lista de Visitas</h2>
    <table id="visitPartnerTable" class="table">
        <thead>
            <tr>
                <th>ID Visita</th>
                <th>Colaborador</th>
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
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitGuestName" class="col-sm-2 col-form-label">Visitante</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" id="inputEditVisitGuestName" name="inputEditVisitGuestName" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitSubject" class="col-sm-2 col-form-label">Asunto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEditVisitSubject" name="inputEditVisitSubject" placeholder="Escriba el asunto" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitNote" class="col-sm-2 col-form-label">Comentario</label>
                        <div class="col-sm-10">
                            <textarea id="inputEditVisitNote" name="inputEditVisitNote" class="form-control" rows="3" placeholder="Escriba el comentario"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEditVisitNumber" class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputEditVisitNumber" name="inputEditVisitNumber" placeholder="Escriba la cantidad" required readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btnUpdatePartnerVisit">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- FIN -->

<?php require_once __DIR__ . '/../bottomPartner.php'; ?>