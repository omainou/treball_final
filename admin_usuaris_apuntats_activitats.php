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

        <h3>Usuaris registrats a les activitats</h3>
        <p>En aquesta pàgina es mostren tots els usuaris apuntats/voluntaris a les activitats.</p>

        <div class="row" id="usuaris_apuntats_activitats">
          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="imatges/activitats/bcn.jpg" alt="Imatge" class="card-img-top" height="250">
              <div class="card-body">
                <h5 class="card-title">
                  Barcelona des de l'aire
                </h5>
                <p class="card-text">
                  Dia: 15/11/2024 10:15
                </p>
                <p class="card-text">
                  Participants disponibles: 81
                </p>

                <hr>

                <p class="card-text">Participants apuntats:</p>
                <li>Oriol Mainou</li>
                <li>Oriol Mainou</li>
                <li>Oriol Mainou</li>
                <li>Oriol Mainou</li>

                <hr>

                <p class="card-text">Voluntaris apuntats:</p>
                <li>Oriol Mainou</li>
                <li>Oriol Mainou</li>

                <hr>

                <a href="detall_activitat.php?id=<?php echo $row["id"]?>" class="boto_marro btn">Veure més</a>
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
