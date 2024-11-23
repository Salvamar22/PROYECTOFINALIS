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
                    <a class="nav-link" href="#">Nosotros</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="views/login.php">Ingresar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Cont&aacute;ctanos</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <section class="carrusel">
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://picsum.photos/id/786/1920/500" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Primera diapositiva</h5>
              <p>Texto de la primera diapositiva.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://picsum.photos/id/662/1920/500" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Segunda diapositiva</h5>
              <p>Texto de la segunda diapositiva.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://picsum.photos/id/447/1920/500" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Tercera diapositiva</h5>
              <p>Texto de la tercera diapositiva.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    <section class="nosotros my-5">
      <h2 class="text-center my-5">¿Qui&eacute;nes somos?</h2>
      <div class="container">
        <div class="row">
          <div class="col-6">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure fuga officiis sit eaque, autem quibusdam vel, consequatur nam doloribus corrupti earum laboriosam cum temporibus hic ipsa nesciunt sunt omnis repellat.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus accusantium est, voluptas incidunt expedita veritatis non vero beatae et assumenda velit doloremque molestiae explicabo obcaecati unde dolorem veniam deserunt? Dolore!</p>
          </div>
          <div class="col-6">
            <img class="img-fluid" src="https://picsum.photos/id/815/600/300" alt="">
          </div>
        </div>
      </div>
    </section>

    <section class="nosotros my-5">
      <h2 class="text-center my-5">Nuestros Servicios</h2>
      <div class="container">
        <div class="row">
          <div class="col-4">
            <div class="card text-center">
              <img src="https://picsum.photos/id/832/500/300" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Servicio 1</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Ver m&aacute;s</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card text-center">
              <img src="https://picsum.photos/id/822/500/300" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Servicio 2</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Ver m&aacute;s</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card text-center">
              <img src="https://picsum.photos/id/823/500/300" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Servicio 3</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Ver m&aacute;s</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="contactanos py-5">
      <div class="row">
        <div class="col col-lg-2">
            <img src="" alt="">
        </div>
        <div class="col col-lg-2">

        </div>
      </div>
    </section>

    <footer class="text-center py-3">
      &copy; Todos los derechos reservados 2024
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>