<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: /public_html/views/login.php');
} elseif (isset($_SESSION['loggedin']) && $_SESSION['tipoColaborador'] === "Administrador") {
    header('Location: /public_html/views/admin.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Telet&oacute;n Panel</title>
    <!-- Incluir jQuery -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Librerias para exportar a Excel -->
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
    <link href="/public_html/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public_html/css/style.css" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand -->
        <a class="navbar-brand ps-3">Telet&oacute;n</a> <!-- href="admin.php" -->
        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!--<div class="input-group">-->
            <!--<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />-->
            <!--<button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>-->
            <!--</div>-->
        </form>
        <!-- Navbar -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item">
                            <button id="logoutButton" style="border: none; background: none; padding: 0; margin: 0; color: black;" class="nav-link" type="button">Cerrar sesi&oacute;n</button>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Cabecera 1 -->
                        <div class="sb-sidenav-menu-heading">Principal</div>
                        <!-- Acceso directo al Panel -->
                        <a class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar"></i></div>
                            <button id="partnerPanel" style="border: none; background: none; padding: 0; margin: 0;" class="nav-link" type="button">Panel</button>
                        </a>
                        <!-- Cabecera 2 -->
                        <div class="sb-sidenav-menu-heading">P&aacute;ginas</div>
                        <!-- Lista de Visitantes -->
                        <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseGuests" aria-expanded="false" aria-controls="collapseGuests">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                            Visitantes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseGuests" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link">
                                    <button id="formPartnerGuest" style="border: none; background: none; padding: 0; margin: 0;" class="nav-link" type="button">Registrar visitante</button>
                                </a>
                                <a class="nav-link">
                                    <button id="listPartnerGuest" style="border: none; background: none; padding: 0; margin: 0;" class="nav-link" type="button">Ver visitantes</button>
                                </a>
                            </nav>
                        </div>
                        <!-- Lista de Visitas -->
                        <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseVisits" aria-expanded="false" aria-controls="collapseVisits">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                            Visitas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVisits" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link">
                                    <button id="formPartnerVisit" style="border: none; background: none; padding: 0; margin: 0;" class="nav-link" type="button">Registrar visita</button>
                                </a>
                                <a class="nav-link">
                                    <button id="listPartnerVisit" style="border: none; background: none; padding: 0; margin: 0;" class="nav-link" type="button">Ver visitas</button>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Sesi&oacute;n de:</div>
                    <?php
                    echo $_SESSION['username'];
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>