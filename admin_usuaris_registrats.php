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
        <h3>Usuaris registrats a AILLED</h3>

        <p>Usuaris i administradors ordenats alfabèticament.</p>

        <div class="row" id="usuaris_registrats_ailled">
          <div class="table-responsive">
            <table class="table" style="font-size: 15px">
              <thead>
                <tr>
                  <th scope="col">-</th>
                  <th scope="col">Nom i cognoms</th>
                  <th scope="col">Email</th>
                  <th scope="col">Telèfon mòbil</th>
                  <th scope="col">Administrador</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Oriol Mainou</td>
                  <td>omainou@uoc.edu</td>
                  <td>666666999</td>
                  <td>
                    <form action="#" method="post">
                      <input type="submit" name="eliminar" value="Eliminar" class="btn boto_marro">
                    </form>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>

        <hr class="py-3">

        <h6>Usuaris administradors:</h6>

        <div class="row" id="usuaris_registrats_ailled">
          <div class="table-responsive">
            <table class="table" style="font-size: 15px">
              <thead>
                <tr>
                  <th scope="col">-</th>
                  <th scope="col">Nom i cognoms</th>
                  <th scope="col">Email</th>
                  <th scope="col">Telèfon mòbil</th>
                  <th scope="col">Treure admin</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Oriol Mainou i Cunillera</td>
                  <td>omainou@uoc.edu</td>
                  <td>610014444</td>
                  <td>
                    <form action="#" method="post">
                      <input type="submit" name="eliminar" value="Eliminar" class="btn boto_marro">
                    </form>
                  </td>
                </tr>

              </tbody>
            </table>
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
