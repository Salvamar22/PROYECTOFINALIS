<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teleton</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="img/LOGO_White2.png" width="100px" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="views/count.php">Conteo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="enterBtn" href="views/login.php">Ingresar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <section class="carrusel">
    <div class="fluid-container">
      <img src="img/saludando.jpg" class="d-block w-100" alt="...">
    </div>
  </section>

  <section class="nosotros my-5">
    <h2 class="text-center my-5">¿Qui&eacute;nes somos?</h2>
    <div class="container">
      <div class="row gy-3">
          <div class="col-md-6">
          <img id="quienes" class="img-fluid" src="img/posando.jpg" alt="">
        </div>
        <div class="col-md-6">
          <p>Somos una institución sin fines de lucro con 42 años de experiencia, que se dedica a la rehabilitación integral de niños, niñas, adolescentes y adultos con discapacidad física (transitoria o permanente) a través de servicios clínicos especializados.</p>
          <p>Los Centros de Rehabilitación Teletón trabajan bajo un Modelo de Rehabilitación Integral que procura tanto la rehabilitación física, como también la inclusión a la vida social, familiar, educativa y laboral de las personas en situación de discapacidad, en el día a día.</p>
          <p>Todos nuestros servicios son 100% gratuitos para todas las personas que asisten a nuestros Centros Teletón.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="nosotros my-5">
    <h2 class="text-center my-5">Nuestros Servicios</h2>
    <div class="container">
      <div class="row gy-3">
        <div class="col-md-4">
          <div class="card h-100">
            <img src="img/jugando.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Rehabilitaci&oacute;n gratuita</h5>
              <p class="card-text">Brindamos servicios de rehabilitaci&oacute;n gratuita para personas con discapacidad f&iacute;sica.</p>
              <!-- <a href="#" class="btn btn-primary">Ver m&aacute;s</a> -->
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="img/riendo.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Apoyo y donaci&oacute;n</h5>
              <p class="card-text">Gracias a los fondos recaudados en el evento Teletón, cada año brindamos más de 100,000 atenciones gratuitas. Construyamos un país inclusivo. ¡Suma terapias gratuitas con tu aporte!.</p>
              <!-- <a href="#" class="btn btn-primary">Ver m&aacute;s</a> -->
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="img/pintando.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Programa de voluntariado</h5>
              <p class="card-text">Conoce nuestro programa de voluntariado, con tu ayuda podremos hacer de El Salvador un país en el que todos tengamos un lugar.</p>
              <!-- <a href="#" class="btn btn-primary">Ver m&aacute;s</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contactanos py-5">
    <div class="container text-center">
      <div class="row justify-content-md-center">
        <div class="col align-self-center">
          <!-- <img src="img/teleton_funter.png" alt="Teleton"> -->
          <img src="img/LOGO_White.png" width="400px" alt="Teleton">
        </div>
        <div class="col align-self-center">
          <!-- <img src="img/SOUCA.png" alt="Servicio Social UCA"> -->
          <img src="img/SOUCA.png" width="400px" height="400px" alt="Servicio Social UCA">
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-3">
    &copy; Todos los derechos reservados 2024
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="/public_html/js/session.js"></script>
</body>

</html>