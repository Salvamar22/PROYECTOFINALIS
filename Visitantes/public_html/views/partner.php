<?php
//session_start();
/*
if (empty($_SESSION["idColaborador"])) {
    header('Location: /Project2/views/login.php');
}
*/
?>
<?php //require_once "C:/xampp/htdocs/Project2/views/topPartner.php"; 
?>
<?php require_once "topPartner.php"; ?>

<!-- INICIO -->

<!-- Muestra la lista de colaboradores utilizando Bootstrap -->
<div class="container">
    <h2 class="text-center p-2">Colaborador</h2>
</div>

<div class="container" id="partnerDashboard">
    <!-- Los datos del dashboard se cargarán aquí a través de AJAX -->
</div>

<!-- FIN -->

<?php //require_once "C:/xampp/htdocs/Project2/views/bottomPartner.php"; 
?>
<?php require_once "bottomPartner.php"; ?>