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

<div class="container-fluid">
    <h2 class="text-center p-2">Registrar usuario</h2>
</div>

<div class="container">

    <form id="userForm" method="POST" autocomplete="off">
        <input type="hidden" name="action" value="register_user">

        <div class="row mb-2">
            <label for="userPartnerInput" class="col-sm-2 col-form-label">Colaborador:</label>
            <div class="col-sm-10">
                <select name="userPartnerInput" class="form-select" id="userPartnerInput" required>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <label for="userNameInput" class="col-sm-2 col-form-label">Usuario</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="userNameInput" name="userNameInput" placeholder="Escriba el usuario" required>
                <p id="userNameMsg" class="error-message"></p>
            </div>
        </div>

        <div class="row mb-2">
            <label for="userPassInput" class="col-sm-2 col-form-label">Contrase&ntilde;a</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="userPassInput" name="userPassInput" placeholder="Escriba la contraseña" required>
                <p id="userPassMsg" class="error-message"></p>
            </div>
        </div>

        <div class="row mb-2">
            <label for="userTypeInput" class="col-sm-2 col-form-label">Tipo</label>
            <div class="col-sm-10">
                <select name="userTypeInput" class="form-select" id="userTypeInput" required>
                    <option value="Colaborador" selected>Colaborador</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>
        </div>

        <div class="mb-2">
            <button type="button" class="btn btn-primary" id="saveUser">Guardar</button>
            <button type="button" class="btn btn-secondary" id="resetUserForm">Restablecer</button>
        </div>
    </form>

    <div id="userSuccessMessage" class="mensaje-exito"></div>

</div>

<!-- FIN -->

<?php require_once __DIR__ . "/../bottom.php"; ?>