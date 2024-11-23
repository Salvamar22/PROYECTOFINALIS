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

<div class="container-fluid">
    <h2 class="text-center p-2">Registrar Colaborador</h2>
</div>
<div class="container">

  <!-- <form action="../../routes/router.php" method="POST" autocomplete="off"> -->
  <form id="partnerForm" method="POST" autocomplete="off">
    <input type="hidden" name="action" value="register_partner">

    <div class="row mb-3">
      <label for="inputNamePartner" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputNamePartner" name="inputNamePartner" placeholder="Escriba el nombre" required>
        <p id="partnerNameMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputLastNamePartner" class="col-sm-2 col-form-label">Apellido</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputLastNamePartner" name="inputLastNamePartner" placeholder="Escriba el apellido" required>
        <p id="partnerLastNameMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputDuiPartner" class="col-sm-2 col-form-label">DUI</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputDuiPartner" name="inputDuiPartner" placeholder="Escriba el DUI" required>
        <p id="partnerDuiMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputAddressPartner" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
      <div class="col-sm-10">
        <textarea id="inputAddressPartner" name="inputAddressPartner" class="form-control" rows="2" placeholder="Escriba la direccion" required></textarea>
        <p id="partnerAddressMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputEmailPartner" class="col-sm-2 col-form-label">Correo</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmailPartner" name="inputEmailPartner" placeholder="Escriba el correo" required>
        <p id="partnerEmailMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPhonePartner" class="col-sm-2 col-form-label">Celular</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPhonePartner" name="inputPhonePartner" placeholder="Escriba el celular" required>
        <p id="partnerPhoneMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputDateBirthPartner" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="inputDateBirthPartner" name="inputDateBirthPartner" required>
        <p id="partnerDateMsg" class="hide-element"></p>
      </div>
    </div>

    <div class="mb-3">
      <button type="button" class="btn btn-primary" id="savePartner">Guardar</button>
      <button type="button" class="btn btn-secondary" id="resetPartnerForm">Restablecer</button>
    </div>
  </form>

  <div id="mensajeExito" class="mensaje-exito"></div>

</div>

<!-- FIN -->

<?php require_once __DIR__ . '/../bottom.php'; ?>