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
              <a class="nav-link active" aria-current="page" href="count.php">Conteo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Ingresar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <section class="carrusel">
    <div class="fluid-container">
      <img src="../img/saludando.jpg" class="d-block w-100" alt="...">
    </div>
  </section>

  <section class="nosotros my-4">
    <h2 class="text-center">Conteo de Visitantes</h2>
    <div class="container">
      <div class="texto3d" id="texto3d">
        <h1 class="name-title" id="text-3d">0</h1>
      </div>
      <!-- <span class="text3d">TEXTO 3D</span> -->
    </div>
  </section>

  <section class="contactanos py-5">
    <div class="container text-center">
      <div class="row justify-content-md-center">
        <div class="col align-self-center">
          <img src="../img/LOGO_White.png" width="400px" alt="Teleton">
        </div>
        <div class="col align-self-center">
          <img src="../img/SOUCA.png" width="400px" height="400px" alt="Servicio Social UCA">
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-3">
    &copy; Todos los derechos reservados 2024
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="/public_html/js/scripts.js"></script>
</body>

</html>