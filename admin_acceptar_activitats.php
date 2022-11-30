
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

        <h3>Acceptar activitats dels usuaris</h3>

        <div class="row" id="acceptar_activitats">

          <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="imatges/activitats/bcn.jpg" alt="Imatge" class="card-img-top" height="250">
              <div class="card-body">
                <h5 class="card-title">
                  Barcelona amb vistes
                </h5>
                <p class="card-text">
                  Creada per: Oriol Mainou
                </p>
                <p class="card-text">
                  Descripció: coneixem Barcelona a través de les seves vistes panoràmiques.
                </p>
                <p class="card-text">
                  Ubicació: Montjuïc
                </p>
                <p class="card-text">
                  Participants: 84
                </p>
                <p class="card-text">
                  Dia i hora: 14/11/2023 17:30
                </p>
                <p class="card-text">
                  Preu: 5€
                </p>
                <p class="card-text">
                  Conté transport l'activitat: no
                </p>
                <p class="card-text">
                  Voluntaris: 3
                </p>

                <hr>

                <form action="admin_acceptar_activitats.php" method="post">
                  <input type="submit" value="Acceptar" name="acceptar_activitat" class="boto_marro btn">
                </form>

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
