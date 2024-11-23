<?php
//session_start();
/*
// Iniciar sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (empty($_SESSION["idColaborador"])) {
    header('Location: ' . dirname($_SERVER['PHP_SELF']) . '/../login.php');
    exit();
}
*/
?>
<?php require_once __DIR__ . '/../top.php'; ?>

<!-- INICIO -->

<div class="container-fluid">
  <h2 class="text-center p-2">Registrar visitante</h2>
</div>

<div class="container">

  <form id="guestForm" method="POST" autocomplete="off">
    <input type="hidden" name="action" value="register_guest">
    <div class="row mb-3">
      <label for="guestNameInput" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="guestNameInput" name="guestNameInput" placeholder="Escriba el nombre" required>
        <p id="guestNameMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="guestEmailInput" class="col-sm-2 col-form-label">Correo</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="guestEmailInput" name="guestEmailInput" placeholder="Escriba el correo" required>
        <p id="guestEmailMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="guestSubjectInput" class="col-sm-2 col-form-label">Asunto</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="guestSubjectInput" name="guestSubjectInput" placeholder="Escriba el asunto" required>
        <p id="guestSubjectMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="guestNoteInput" class="col-sm-2 col-form-label">Comentario</label>
      <div class="col-sm-10">
        <textarea id="guestNoteInput" name="guestNoteInput" class="form-control" rows="3" placeholder="Escriba el comentario"></textarea>
      </div>
    </div>

    <div class="mb-3">
      <button type="button" class="btn btn-primary" id="saveGuest">Guardar</button>
      <button type="button" class="btn btn-secondary" id="resetGuestForm">Restablecer</button>
    </div>
  </form>

  <div id="guestSuccessMessage" class="mensaje-exito"></div>

</div>

<!-- FIN -->

<?php require_once __DIR__ . '/../bottom.php'; ?>