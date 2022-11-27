
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
    <section id="meves_activitats">
      <div class="container">

        <h3>Les meves activitats</h3>
        <p>Les activitats disponibles es mostren a continuació.</p>

        <div class="row" id="caselles_activitats">
          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="imatges/activitats/bcn.jpg" alt="Activitat" class="card-img-top" height="250">
              <div class="card-body">
                <h5 class="card-title">
                  Visita a Barcelona
                </h5>
                <p class="card-text">
                  Ubicació: Barcelona
                </p>
                <p class="card-text">
                  Places disponibles: 19
                </p>
                <p class="card-text">
                  Dia i hora: 22/12/2022 10:00
                </p>

                <hr>

                <div class="veuremes">
                  <a href="#" class="boto_marro btn">Veure més</a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <hr>

        <h3>Activitats ja realitzades</h3>

        <div class="row" id="caselles_activitats">

          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="imatges/activitats/bcn.jpg" alt="Activitat" class="card-img-top" height="250">
              <div class="card-body">
                <h5 class="card-title">
                  Visita a la ciutat de Barcelona
                </h5>
                <p class="card-text">
                  Ubicació: Barcelona
                </p>
                <p class="card-text">
                  Places disponibles: 83
                </p>
                <p class="card-text">
                  Dia i hora: 14/01/2023 10:45
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
