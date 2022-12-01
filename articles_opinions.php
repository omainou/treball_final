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
    <section id="contingut_pagina">
      <div class="container">
        <h3>Articles d'opinions</h3>

        <a href="crear_article_opinio.php" class="boto_marro btn">Crear article</a>

        <div style="padding: 2% 0">

          <div class="card bg-light mb-4 py-2">
            <div class="card-body">

              <h5 class="card-title">
                Tornarem!!!!
              </h5>
              <p class="card-text">
                Usuàri/a: Oriol Mainou
              </p>
              <p class="card-text">
                Activitat realitzada: Montjuïc
              </p>
              <p class="card-text">
                - Lorem ipsum...
              </p>
              <p class="card-text">
                Dia: 14/11/2022
              </p>
              <p class="card-text">
                Valoració: (1 min / 5 max)
              </p>

              <input type="range" id="range" disabled value="5" min="1" max="5">

              <form action="articles_opinions.php" method="post" class="py-1">
                <input type="hidden" name="id_article" value="55">
                <input type="submit" value="Eliminar" class="btn btn-danger" name="eliminar_article">
              </form>

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
