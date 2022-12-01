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
        <h3>Activitats assistides de cada usuari</h3>
        <p>Cercador de totes les activitats assistides de cada usuari.</p>

        <form class="row g-3" method="post" action="#">
          <label for="nom" class="form-label">
            Nom de l'usuari:
          </label>
          <div class="col-md-6">
            <select name="usuari" id="nom" required class="form-select">
              <option value="-1">-</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>

          <div class="col-md-6">
            <input type="submit" class="btn boto_marro" value="Buscar" name="submit">
          </div>
        </form>

        <hr>

        <h5>Usuari cercat: Oriol Mainou</h5>

        <div class="table-responsive">
          <table class="table" style="font-size: 15px">
            <thead>
              <tr>
                <th scope="col">-</th>
                <th scope="col">Nom activitat</th>
                <th scope="col">Ubicació activitat</th>
                <th scope="col">Dia</th>
                <th scope="col">Apuntades</th>
                <th scope="col">Usuari/a creador/a</th>
                <th scope="col">S'ha assistit?</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>
                  <a href="#">Montjuïc des de l'aire</a>
                </td>
                <td>Montjuïc</td>
                <td>14/11/2023 17:00</td>
                <td>15</td>
                <td>Oriol Mainou</td>
                <td>Sí</td>
              </tr>
            </tbody>
          </table>

        </div>

        <div id="total_activitats">
          <p>Ha assistit: 81 activitats.</p>
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
