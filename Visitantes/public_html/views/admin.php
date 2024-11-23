<?php

/*
if (empty($_SESSION["idColaborador"])) {
    header('Location: login.php');
}
*/
/*
session_start();
if (!isset($_SESSION['idColaborador'])) {
    var_dump($_SESSION['tipoColaborador']);
    //header('Location: login.php');
    //exit();
}
*/
?>
<?php require_once "top.php"; ?>

<!-- require_once "top.php"; -->

<!-- INICIO -->

<div class="container-fluid">
    <h2 class="text-center p-2">Administrador</h2>
</div>

<div class="container" id="adminDashboard">
    <!-- Los datos del dashboard se cargarán aquí a través de AJAX -->
</div>

<!-- FIN -->

<!-- require_once "bottom.php" -->

<?php require_once "bottom.php"; ?>