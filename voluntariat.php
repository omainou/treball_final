
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
    <section id="voluntariats">
      <div class="container">
        <h3>Voluntariat</h3>

        <p>Vols fer voluntariat a AILLED? Escull l'activitat que més desitgi.</p>
        <p>A continuació, es mostren totes les activitats a AILLED dels quals aquest compte no és creador i hi ha places de voluntariat.</p>

        <div class="table-responsive py-3">
          <table class="table" style="font-size: 15px">
            <thead>
              <tr>
                <th scope="col">Nom de l'activitat</th>
                <th scope="col">Ubicació activitat</th>
                <th scope="col">Dia i hora</th>
                <th scope="col">  </th>
                <th scope="col">  </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <a href="#">Montserrat excursió</a>
                </td>
                <td>Montserrat</td>
                <td>14/11/2024</td>
                <td>
                  <button type="button" name="button" class="btn btn-success">Apuntar-me</button>
                </td>
                <td>
                  <button type="button" name="button" class="btn btn-danger">Desapuntar-me</button>
                </td>
              </tr>

            </tbody>
          </table>
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
