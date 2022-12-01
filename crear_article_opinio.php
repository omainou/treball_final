<?php include "servidor/connexio.php"; ?>

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

    <section id="formulari_crear_activitat">
      <div class="container">
        <h3>Crear article d'opinió</h3>
        <p>A través d'aquest formulari pots valorar l'activitat realitzada.</p>
        <h6 class=" text-danger">* Camps obligatoris</h6>

        <div class="py-4">
          <form class="row g-3" method="post" action="crear_article_opinio.php" enctype="multipart/form-data">
            <div class="col-md-12">
              <label for="titol_article" class="form-label">
                Títol de l'article
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="titol_article" name="titol_article" required>
            </div>

            <div class="col-12">
              <label for="descripcio" class="form-label">
                Descripció
                <span class="text-muted" id="max_paraules">[Màxim de paraules: 300]</span>
                <span class="text-danger">*</span>
              </label>
              <textarea name="descripcio_article" id="descripcio" rows="5" class="form-control" maxlength="300" required></textarea>
            </div>

            <div class="col-md-6">
              <label for="activitat" class="form-label">
                Activitat a valorar
                <span class="text-danger">*</span>
              </label>
              <select id="activitat" name="activitat_article" class="form-select">
                <option value="1">ABCDE</option>
                <option value="2">FGHIJ</option>
                <option value="3">KLMNO</option>
                <option value="4">PQRST</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="valorar" class="form-label">
                Valoració de l'article (1 min / 5 màx)
                <span class="text-danger">*</span>
              </label>
              <input type="range" class="form-range" id="valorar" name="valorar_article" min="1" max="5" required>
            </div>

            <div class="col-12">
              <input type="submit" class="btn boto_marro" value="Crear activitat" name="submit_article">
            </div>
          </form>
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
