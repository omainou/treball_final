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
        <h3>Vehicles de transport</h3>

        <div class="py-4">
          <form class="row g-3" method="post" action="#">
            <label for="transport" class="form-label">
              Afegeix transport:
            </label>
            <div class="col-md-3">
              <input type="text" class="form-control" id="transport" name="transport" required autofocus>
            </div>

            <div class="col-3">
              <input type="submit" class="btn boto_marro" value="Afegir" name="afegir_vehicle_taula">
            </div>
          </form>
        </div>

        <div class="row" id="transport_vehicles">
          <div class="table-responsive">
            <table class="table" style="font-size: 15px">
              <thead>
                <tr>
                  <th scope="col">-</th>
                  <th scope="col">Vehicle de transport</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Cotxe</td>
                  <td>
                    <button type="button" name="button" class="btn btn-danger">Eliminar</button>
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
