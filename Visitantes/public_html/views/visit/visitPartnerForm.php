<?php
//session_start();
?>
<?php require_once __DIR__ . '/../topPartner.php'; ?>

<!-- INICIO -->

<div class="container-fluid">
    <h2 class="text-center p-2">Registrar visita</h2>
</div>

<div class="container">

    <form id="partnerVisitForm" method="POST" autocomplete="off">
        <input type="hidden" name="action" value="register_partner_visit">

        <div class="row mb-3">
            <label for="visitPartnerGuestInput" class="col-sm-2 col-form-label">Visitante:</label>
            <div class="col-sm-10">
                <select name="visitPartnerGuestInput" class="form-control" id="visitPartnerGuestInput" required>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="visitSubjectInput" class="col-sm-2 col-form-label">Asunto</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="visitSubjectInput" name="visitSubjectInput" placeholder="Escriba el asunto" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="visitNoteInput" class="col-sm-2 col-form-label">Comentario</label>
            <div class="col-sm-10">
                <textarea id="visitNoteInput" name="visitNoteInput" class="form-control" rows="3" placeholder="Escriba el comentario"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="visitNumberInput" class="col-sm-2 col-form-label">Cantidad</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="visitNumberInput" name="visitNumberInput" placeholder="Escriba la cantidad" value="1" required readonly>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-primary" id="savePartnerVisit">Sumarme</button>
            <button type="button" class="btn btn-secondary" id="resetPartnerVisitForm">Restablecer</button>
        </div>
    </form>

    <div id="visitSuccessMessage" class="mensaje-exito"></div>

</div>

<!-- FIN -->

<?php require_once __DIR__ . '/../bottomPartner.php'; ?>