<!doctype html>
<html lang="es">
<head>
  <?php
    include "codi_repetit/head.php";
    head();
  ?>
</head>
<body>
  <header>
    <?php
      include "codi_repetit/menu_navegacio.php";
      menu_navegacio();
    ?>
  </header>

  <main>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Activitat 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Activitat 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Activitat 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Activitat 4"></button>
      </div>
      <div id="carruselImatges" class="carousel-inner">
        <div class="carousel-item active">
          <img src="imatges/portada/bcn.jpg" class="d-block w-100" alt="Activitat 1">
        </div>
        <div class="carousel-item">
          <img src="imatges/portada/bcn.jpg" class="d-block w-100" alt="Activitat 2">
        </div>
        <div class="carousel-item">
          <img src="imatges/portada/bcn.jpg" class="d-block w-100" alt="Activitat 3">
        </div>
        <div class="carousel-item">
          <img src="imatges/portada/bcn.jpg" class="d-block w-100" alt="Activitat 4">
        </div>
      </div>
    </div>

    <section id="contingut_pagina">
      <div class="container">
        <h3>Les activitats més pròximes</h3>

        <div class="row" id="caselles_activitats">

          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="imatges/activitats/bcn.jpg" alt="Imatges" class="card-img-top" height="250">

              <div class="card-body">
                <h5 class="card-title">
                  NOM
                </h5>
                <p class="card-text">
                  Creada per: Oriol Mainou
                </p>
                <p class="card-text">
                  Ubicació: Barcelona
                </p>
                <p class="card-text">
                  Places disponibles: 80
                </p>
                <p class="card-text">
                  Dia i hora: 15/11/2025
                </p>
                <p class="card-text">
                  Preu: 1€
                </p>
                <p class="card-text">
                  Conté transport l'activitat: Sí
                </p>

                <hr>

                <div class="veuremes">
                  <a href="#" class="boto_marro btn">Veure més</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="newsletter">
      <div class="container">
        <h3>Vols conèixer més sobre AILLED?</h3>
        <p>Informa't a través del nostre newsletter.</p>
        <p>Introdueix el teu correu electrònic i t'enviarem el nostre fulletó.</p>

        <form class="row g-2" method="post" action="index.php">
          <div class="col-md-4">
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="col-4">
            <input type="submit" class="btn boto_marro" value="Enviar" name="newsletter">
          </div>
        </form>

      </div>
    </section>

  </main>

  <footer>
    <?php
      include "codi_repetit/peu_pagina.php";
      footer();
    ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
