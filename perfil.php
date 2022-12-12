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

        <?php
          if (isset($_POST["id_usuari_sessio"])) {
            ?>
            <h3>El meu perfil</h3>
            <h6 class=" text-danger">* Camps obligatoris</h6>

            <?php
            $sessions = $_SESSION['id_usuari_sessio'];

            if (isset($_POST["update"])) {
              // UPDATE MOBIL
              $mobil = $_POST["mobil"];

              $sql_update_mobil = "UPDATE usuari SET telefon=? WHERE id=?";
              $resultat_update_mobil = $connexio_PDO->prepare($sql_update_mobil);

              $resultat_update_mobil->execute([ $mobil, $sessions ]);

              // UPDATE IMG DE PERFIL
              $arxiu = $_FILES['fotos']['name'];

              if ($_FILES['fotos']["error"] > 0) { // si la img ens dona error

                ?>
                <div class="alert alert-danger" role="alert">
                  Error al pujar la imatge de perfil al servidor web.
                </div>
                <?php

              } else {

                $img_nova = rand(0, 10000) . "_" . $arxiu;
                move_uploaded_file($_FILES['fotos']['tmp_name'], "imatges/fotos_usuaris/" . $img_nova);

                $update_img = "UPDATE usuari SET imatge = '$img_nova' WHERE id = " . $_SESSION['id_usuari_sessio'];

                if ($connexio->query($update_img) === TRUE) {

                  ?>
                  <div class="alert alert-success" role="alert">
                    Imatge afegida correctament.
                  </div>
                  <?php

                } else {

                  ?>
                  <div class="alert alert-danger" role="alert">
                    Error al pujar la imatge de perfil al servidor web.
                  </div>
                  <?php

                }

              }

              echo "<div class='alert alert-success' role='alert'>Dades actualitzades correctament.</div>";

            }

            // UPDATE CONTRASENYA
            if (isset($_POST["canviar_contrasenya"])) {
              $contrasenya = $_POST["contrasenya1"];
              $contrasenya2 = $_POST["contrasenya2"];

              if ($contrasenya == $contrasenya2) {

                $contrasenya_xifrada = password_hash($contrasenya, PASSWORD_DEFAULT, array( "cost" => 12 ));
                $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connexio_PDO->exec("SET CHARACTER SET utf8");

                $sql_update_pwd = "UPDATE usuari SET contrasenya=? WHERE id=?";
                $resultat_update_pwd = $connexio_PDO->prepare($sql_update_pwd);

                $resultat_update_pwd->execute([ $contrasenya_xifrada, $sessions ]);

                echo "<div class='alert alert-success' role='alert'>Contrasenya canviada correctament.</div>";

              } else {
                echo "<div class='alert alert-danger' role='alert'>Contrasenyes diferents. Torna-ho a provar.</div>";
              }
            }
            ?>

            <div class="row justify-content-center pt-4">
              <div class="col-md-8" id="info_perfil">
                <div class="card w-80">
                  <?php
                  $sql = "SELECT * FROM usuari WHERE id = " . $_SESSION['id_usuari_sessio'];
                  $result = $connexio->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      if ($row["imatge"] == "-") {
                        ?>
                        <img src='imatges/fotos_usuaris/icono.png' alt='Imatge de perfil'>
                        <?php
                      } else {
                        ?>
                        <img src='imatges/fotos_usuaris/<?php echo $row["imatge"] ?>' alt='Imatge de perfil'>
                        <?php
                      }
                      ?>

                      <div class='card-body'>
                        <form method="post" class="row g-3" action="perfil.php" enctype="multipart/form-data">
                          <div class="col-md-6">
                            <label for="nom" class="form-label">
                              Nom i cognoms
                              <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nom" name="nom" readonly value="<?php echo $row["nom"] ?>">
                          </div>

                          <div class="col-md-6">
                            <label for="email" class="form-label">
                              Correu electrònic
                              <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email" readonly value="<?php echo $row["email"] ?>">
                          </div>

                          <div class="col-md-6">
                            <label for="mobil" class="form-label">
                              Telèfon mòbil
                              <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" id="mobil" name="mobil" required value="<?php echo $row["telefon"] ?>">
                          </div>

                          <div class="col-md-6">
                            <label for="foto" class="form-label">
                              Foto de perfil
                              <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="foto" name="fotos" required>
                          </div>

                          <div class="col-12">
                            <input type="submit" name="update" class='btn boto_marro' value="Actualitzar">
                          </div>
                        </form>

                        <hr class="p-3">

                        <form class="row g-3" action="perfil.php" method="post">
                          <div class="col-md-6">
                            <label for="contrasenya" class="form-label">Nova contrasenya</label>
                            <input type="password" class="form-control" id="contrasenya" name="contrasenya1" minlength="8">
                          </div>

                          <div class="col-md-6">
                            <label for="contrasenya" class="form-label">Repeteix la contrasenya</label>
                            <input type="password" class="form-control" id="contrasenya" name="contrasenya2" minlength="8">
                          </div>

                          <div class="col-12">
                            <input type="submit" name="canviar_contrasenya" class='btn boto_marro' value="Canviar">
                          </div>
                        </form>

                      </div>
                      <?php
                    }
                  }
                  ?>

                </div>
              </div>
            </div>
            <?php
          } else {
            header ("Location: index.php");
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
