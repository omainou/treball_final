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
        <h3>Administrar pàgina "Qui som?"</h3>
        <p>Aquí es mostra el text que es visualitza a la pàgina "Qui som?".</p>

        <form action="admin_qui_som.php" method="post" class="row g-3">
          <div class="col-12">
            <label for="quisom" class="form-label">
              Descripció
              <span class="text-muted" id="max_paraules">[Màxim de lletres: 650]</span>
            </label>
            <textarea name="quisom" id="quisom" rows="9" class="form-control" maxlength="650" required>...</textarea>
          </div>

          <div class="col-12">
            <input type="submit" class="btn boto_marro" value="Editar" name="submit">
          </div>
        </form>

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
