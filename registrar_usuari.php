
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

    <section id="formulari_registrarse">
      <div class="container">

        <h3>Registrar-me a AILLED</h3>

        <h6 class=" text-danger">* Camps obligatoris</h6>

        <div class="py-4">
          <form class="row g-3" method="post" action="registrar_usuari.php">
            <div class="col-md-6">
              <label for="nom" class="form-label">
                Nom i cognoms
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="nom" name="nom" required autofocus>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">
                Correu electrònic
                <span class="text-danger">*</span>
              </label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6">
              <label for="contrasenya" class="form-label">
                Contrasenya
                <span class="text-danger">*</span>
              </label>
              <input type="password" class="form-control" id="contrasenya" name="contrasenya" minlength="8" required>
            </div>
            <div class="col-md-6">
              <label for="repetir_contrasenya" class="form-label">
                Repeteix la contrasenya
                <span class="text-danger">*</span>
              </label>
              <input type="password" class="form-control" id="repetir_contrasenya" name="contrasenya2" minlength="8" required>
            </div>
            <div class="col-md-6">
              <label for="telefon" class="form-label">
                Telèfon de contacte
                <span class="text-danger">*</span>
              </label>
              <input type="number" class="form-control" id="telefon" name="mobil" min="1" required>
            </div>

            <div class="col-12">
              <input type="submit" class="btn boto_marro" value="Registrar-me" name="enviar">
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
