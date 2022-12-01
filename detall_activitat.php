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
    <section id="detall_activitat">
      <div class="container">

        <div class="card mb-3">
          <img class="card-img-top" src="imatges/activitats/bcn.jpg" title="Montserrat" alt="Montserrat" height="400">
          <div class="card-body">
            <h3 class="card-title">
              Montserrat des de Manresa
            </h3>
            <p class="card-text">
              Creada per: Oriol Mainou
            </p>
            <p class="card-text">
              Ubicació de l'activitat: Montserrat
            </p>
            <p class="card-text">
              Descripció de l'activitat: <br> Pujada a Montserrat des de la ciutat de Manresa. T'hi apuntes?
            </p>
            <p class="card-text">
              Participants de l'activitat: 81
            </p>
            <p class="card-text">
              Participants disponibles: 55
            </p>
            <p class="card-text">
              Dia i hora: 28/10/2023
            </p>
            <p class="card-text">
              Preu: Activitat gratuïta
            </p>
            <p class="card-text">
              L'activitat té transport: sí
            </p>
            <p class="card-text">
              Voluntaris disponibles: 19
            </p>

            <hr>

            <form action="#" method="post" class="row g-3 py-4">
              <div class="col-md-2">
                <label for="participants" class="form-label">Participants a apuntar:</label>
                <input type="number" class="form-control" id="participants" name="participants_act_registrat" required>
              </div>

              <div class="col-md-12 ">
                <input class="form-check-input" type="checkbox" name="transport_act_registrat" id="transport" value="1">
                <label class="form-check-label" for="transport">
                  Sí necessito transport.
                </label>
              </div>

              <div class="col-md-12">
                <input type="submit" value="Apuntar" class="boto_marro btn" name="registrar_activitat">
              </div>
            </form>

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
