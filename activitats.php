
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
    <section id="contingut_pagina">
      <div class="container">
        <h3>Activitats d'AILLED</h3>

        <div id="cercadors">
          <form class="row g-3 py-2" action="activitats.php" method="post">
            <label for="dia" class="form-label">Cercar activitat per dia:</label>
            <div class="col-md-4">
              <input type="date" class="form-control" id="dia" name="inputdia" required min="<?php echo date("Y-m-d")?>">
            </div>
            <div class="col-md-8">
              <input type="submit" value="Buscar" class="boto_marro btn" name="buscardata">
            </div>
          </form>

          <form class="row g-3 py-2" action="activitats.php" method="post">
            <label for="nom" class="form-label">Cercar activitat per nom:</label>
            <div class="col-md-4">
              <input type="text" class="form-control" id="nom" name="inputnom" placeholder="Cercador per nom" required>
            </div>
            <div class="col-md-8">
              <input type="submit" value="Buscar" class="boto_marro btn" name="buscarnom">
            </div>
          </form>
        </div>

        <hr>

        <div class="row" id="caselles_activitats">

          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="imatges/activitats/bcn.jpg" alt="Imatge" class="card-img-top" height="250">

              <div class="card-body">
                <h5 class="card-title">
                  Activitat 1
                </h5>
                <p class="card-text">
                  Creada per: Oriol Mainou
                </p>
                <p class="card-text">
                  Ubicació: Manresa
                </p>
                <p class="card-text">
                  Places disponibles: 320
                </p>
                <p class="card-text">
                  Dia i hora: 25/05/2024
                </p>
                <p class="card-text">
                  Preu: 5€
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
