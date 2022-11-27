
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
    <section id="activitats_apuntades">
      <div class="container">

        <h3>Activitats apuntades</h3>

        <p>Llista d'activitats on t'has apuntat.</p>

        <p class="text-muted">Fes click sobre el nom de l'activitat per conèixer més.</p>

        <div class="table-responsive">
          <table class="table" style="font-size: 15px">
            <thead>
              <tr>
                <th scope="col">-</th>
                <th scope="col">Nom activitat</th>
                <th scope="col">Ubicació activitat</th>
                <th scope="col">Dia i hora</th>
                <th scope="col">Apuntades</th>
                <th scope="col">Vol transport?</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><a href="#">Sortida a Montserrat</a></td>
                <td>Montserrat</td>
                <td>15/01/2023 10:00</td>
                <td>23</td>
                <td>Sí</td>
                <td>
                  <button type="button" name="button" class="btn btn-danger">Eliminar</button>
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
