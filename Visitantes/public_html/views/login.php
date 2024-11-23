<?php
/*
//session_start();
//var_dump($_SESSION);
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
} elseif (isset($_SESSION['loggedin']) && $_SESSION['tipoColaborador'] === "Administrador") {
    header('Location: admin.php');
    exit();
} elseif (isset($_SESSION['loggedin']) && $_SESSION['tipoColaborador'] === "Colaborador") {
    header('Location: partner.php');
    exit();
}
*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teleton</title>
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="../img/LOGO_White2.png" width="100px" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="count.php">Conteo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page">Ingresar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2 class="text-center p-2">Iniciar sesi&oacute;n</h2>
        <form id="loginForm" method="POST" autocomplete="off"> <!-- action="../routes/router.php" -->
            <!-- <input type="hidden" name="action" value="login"> -->
            <div class="mb-3">
                <label for="usernameLoginInput" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usernameLoginInput" name="usernameLoginInput" placeholder="Escribe el nombre de usuario">
                <p id="userLoginMsg" class="hide-element"></p>
            </div>
            <div class="mb-3">
                <label for="passwordLoginInput" class="form-label">Contrase&ntilde;a</label>
                <input type="password" class="form-control" id="passwordLoginInput" name="passwordLoginInput" placeholder="Escribe la contraseña">
                <p id="passLoginMsg" class="hide-element"></p>
            </div>
            <!-- <button id="loginButton" type="button" class="btn btn-primary">Iniciar sesi&oacute;n</button> -->
            <button type="submit" class="btn btn-primary">Iniciar sesi&oacute;n</button>
        </form>

        <div id="errorMessage" class="mensaje-error"></div>

        <!-- Mensajes de éxito o error -->
        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger mt-2" role="alert">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center py-3">
        &copy; Todos los derechos reservados 2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/public_html/js/scripts.js"></script>
    <script src="/public_html/js/session.js"></script>
</body>

</html>