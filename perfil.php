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
    <section id="meu_perfil">
      <div class="container">
        <h3>El meu perfil</h3>
        <h6 class=" text-danger">* Dades no modificables</h6>

        <div class="row justify-content-center pt-4">
          <div class="col-md-8" id="info_perfil">
            <div class="card w-80">
              <img src="imatges/fotos_usuaris/icono.png" alt="Foto de perfil">

              <div class='card-body'>
                <form method="post" class="row g-3" action="perfil.php" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <label for="nom" class="form-label">Nom i cognoms <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nom" name="nom" readonly value="Oriol Mainou">
                  </div>

                  <div class="col-md-6">
                    <label for="email" class="form-label">Correu electrònic <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" readonly value="omainou@uoc.edu">
                  </div>

                  <div class="col-md-6">
                    <label for="mobil" class="form-label">Telèfon mòbil</label>
                    <input type="number" class="form-control" id="mobil" name="mobil" value="654444741">
                  </div>

                  <div class="col-md-6">
                    <label for="foto" class="form-label">Foto de perfil</label>
                    <input type="file" class="form-control" id="foto" name="fotos">
                  </div>

                  <div class="col-md-6">
                    <label for="contrasenya" class="form-label">Nova contrasenya</label>
                    <input type="password" class="form-control" id="contrasenya" name="contrasenya" minlength="8">
                  </div>

                  <div class="col-md-6">
                    <label for="contrasenya2" class="form-label">Repeteix la contrasenya</label>
                    <input type="password" class="form-control" id="contrasenya2" name="contrasenya2" minlength="8">
                  </div>

                  <div class="col-12">
                    <input type="submit" name="update" class='btn boto_marro' value="Actualitzar">
                  </div>
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
