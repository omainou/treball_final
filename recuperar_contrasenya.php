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
    <section id="formulari_registrarse">
      <div class="container">
        <?php
          if (!isset($_SESSION['id_usuari_sessio'])) {

            if (isset($_POST["recuperar_contrasenya"])) {
              $email = $_POST["email"];
              $contrasenya = $_POST["contrasenya"];
              $contrasenya2 = $_POST["contrasenya2"];

              if ($contrasenya == $contrasenya2) {
                $sql_usuari = "SELECT * FROM usuari WHERE email='$email'";
                $resultat_usuari = $connexio->query($sql_usuari);

                if ($resultat_usuari->num_rows > 0) {
                  $contrasenya_xifrada = password_hash($contrasenya, PASSWORD_DEFAULT, array( "cost" => 12 ));

                  $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $connexio_PDO->exec("SET CHARACTER SET utf8");

                  $sql_update_pwd = "UPDATE usuari SET contrasenya=:contrasenya WHERE email=:email";
                  $resultat_update_pwd = $connexio_PDO->prepare($sql_update_pwd);

                  $resultat_update_pwd->execute(array(
                      ":email" => $email,
                      ":contrasenya" => $contrasenya_xifrada
                    )
                  );

                  echo "<div class='alert alert-success' role='alert'>Contrasenya canviada correctament.</div>";

                } else {
                  echo "<div class='alert alert-danger' role='alert'>Usuari desconegut.</div>";
                }
              }
            }

            ?>
            <h3>Recuperar contrasenya</h3>
            <h6 class=" text-danger">* Camps obligatoris</h6>

            <div class="py-2">
              <form class="row g-3" method="post" action="recuperar_contrasenya.php">
                <div class="col-md-12">
                  <label for="email" class="form-label">
                    Correu electrònic
                    <span class="text-danger">*</span>
                  </label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-12">
                  <label for="contrasenya" class="form-label">
                    Nova contrasenya
                    <span class="text-danger">*</span>
                  </label>
                  <input type="password" class="form-control" id="contrasenya" name="contrasenya" minlength="8" required>
                </div>
                <div class="col-md-12">
                  <label for="repetir_contrasenya" class="form-label">
                    Repeteix la nova contrasenya
                    <span class="text-danger">*</span>
                  </label>
                  <input type="password" class="form-control" id="repetir_contrasenya" name="contrasenya2" minlength="8" required>
                </div>

                <div class="col-12">
                  <input type="submit" class="btn boto_marro" value="Recuperar" name="recuperar_contrasenya">
                </div>
              </form>
            </div>
            <?php

          } else {
            ?>
            <h2>Ha iniciat sessió</h2>
            <p>Torna a la pàgina principal.</p>
            <a class="boto_marro btn" href="index.php">Pàgina inicial</a>
            <?php
          }
          ?>
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
