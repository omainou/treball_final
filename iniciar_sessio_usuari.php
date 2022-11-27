
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

    <section id="formulari_inici_sessio">
      <div class="container">

        <h3>Iniciar sessió a AILLED</h3>

        <div class="py-4">
          <form method="post" class="row g-3" action="iniciar_sessio_usuari.php">
            <div class="col-md-12">
              <label for="email" class="form-label">Correu electrònic</label>
              <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            
            <div class="col-md-12">
              <label for="contrasenya" class="form-label">Contrasenya</label>
              <input type="password" class="form-control" id="contrasenya" name="password" required>
            </div>

            <div class="col-12">
              <input type="submit" class="btn boto_marro" value="Entrar" name="enviar">
            </div>
          </form>
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
