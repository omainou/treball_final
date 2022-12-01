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

    <section id="formulari_inici_sessio">
      <div class="container">

        <?php
          if (!isset($_SESSION['id_usuari_sessio'])) {
            ?>
              <h3>Iniciar sessió a AILLED</h3>

              <?php
                if (isset($_POST['enviar'])) {
                  $email = htmlentities(addslashes($_POST['email'])); // email posat al form
                  $password = htmlentities(addslashes($_POST['password'])); // contrasenya posada al form

                  $contador = 0;

                  $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $sql = "SELECT * FROM usuari WHERE email=:email"; // si existeix aquest mail a la BBDD
                  $resultat_inici_sessio = $connexio_PDO->prepare($sql);
                  $resultat_inici_sessio->execute(array(
                    ":email" => $email
                  ));

                  while ($registre = $resultat_inici_sessio->fetch(PDO::FETCH_ASSOC)) {
                    if (password_verify($password, $registre['contrasenya'])) { // verifiquem la contrsenya si és correcte
                      $contador++;
                      // Obrim la sessió i els hi dono dades
                      $_SESSION['id_usuari_sessio'] = $registre['id'];
                    }
                  }

                  if ($contador > 0) {
                    header ("Location: index.php");
                  } else {
                    echo "<div class='alert alert-danger' role='alert'>Error. Comprova que has escrit bé el correu i la contrasenya.</div>";
                  }
                }
              ?>

              <div class="py-2">
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
            <?php

          } else {
            header ("Location: perfil.php");
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
