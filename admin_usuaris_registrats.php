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
        <?php
        if (isset($_SESSION["id_usuari_sessio"])) {
          $sessio = $_SESSION["id_usuari_sessio"];
          $sql_admin = "SELECT * FROM usuari WHERE es_admin > 0 AND id = '$sessio'";
          $resultat_admin = $connexio->query($sql_admin);

          if ($resultat_admin->num_rows > 0) {
            ?>
            <h3>Usuaris registrats a AILLED</h3>
            <p>Usuaris i administradors ordenats alfabèticament.</p>

            <?php
            if (isset($_POST["eliminar_admin"])) {
              $id_eliminar_admin = $_POST["id_eliminar_admin"];
              $nom_eliminar_admin = strtoupper($_POST["nom_eliminar_admin"]);

              $sql_update_admin = "UPDATE usuari SET es_admin = 0 WHERE id = " . $id_eliminar_admin;
              $resultat_update_admin = $connexio_PDO->prepare($sql_update_admin);
              $resultat_update_admin->execute();

              echo "<div class='alert alert-success' role='alert'>S'ha eliminat a " . $nom_eliminar_admin . " com administrador.</div>";
            }

            if (isset($_POST["afegir_admin"])) {
              $id_afegir_admin = $_POST["id_afegir_admin"];
              $nom_afegir_admin = strtoupper($_POST["nom_afegir_admin"]);

              $sql_update_admin = "UPDATE usuari SET es_admin = 1 WHERE id = " . $id_afegir_admin;
              $resultat_update_admin = $connexio_PDO->prepare($sql_update_admin);
              $resultat_update_admin->execute();

              echo "<div class='alert alert-success' role='alert'>Has afegit a " . $nom_afegir_admin . " com administrador.</div>";
            }
            ?>

            <div class="row" id="usuaris_registrats_ailled">
              <div class="table-responsive">
                <table class="table" style="font-size: 15px">
                  <thead>
                    <tr>
                      <th scope="col">-</th>
                      <th scope="col">Nom i cognoms</th>
                      <th scope="col">Email</th>
                      <th scope="col">Telèfon mòbil</th>
                      <th scope="col">Administrador</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM usuari WHERE es_admin = 0 ORDER BY nom ASC";
                    $result = $connexio->query($sql);

                    if ($result->num_rows > 0) {
                      $contador = 1;

                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                          echo "<td>" . $contador . "</td>";
                          $contador++;

                          echo "<td>" . $row["nom"] . "</td>";

                          echo "<td>" . $row["email"] . "</td>";

                          echo "<td>" . $row["telefon"] . "</td>";

                          echo "<td>";
                            echo "<form method='post' action='admin_usuaris_registrats.php'>";
                              echo "<input type='hidden' class='form-control' name='id_afegir_admin' value='" . $row['id'] . "'>";
                              echo "<input type='hidden' class='form-control' name='nom_afegir_admin' value='" . $row['nom'] . "'>";
                              echo "<input type='submit' class='btn boto_marro' value='Afegir admin' name='afegir_admin'>";
                            echo "</form>";
                          echo "</td>";

                        echo "</tr>";
                      }

                    } else {
                      echo "<tr>";
                        echo "<td colspan='4'><h6 class='text-center'>Cap usuari més registrat.</h6></td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <hr class="py-3">

            <h6>Usuaris administradors:</h6>

            <div class="row" id="usuaris_registrats_ailled">
              <div class="table-responsive">
                <table class="table" style="font-size: 15px">
                  <thead>
                    <tr>
                      <th scope="col">-</th>
                      <th scope="col">Nom i cognoms</th>
                      <th scope="col">Email</th>
                      <th scope="col">Telèfon mòbil</th>
                      <th scope="col">Treure admin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM usuari WHERE es_admin = 1 AND id != " . $_SESSION['id_usuari_sessio'] . " ORDER BY nom ASC";
                    $result = $connexio->query($sql);

                    if ($result->num_rows > 0) {
                      $contador = 1;

                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                          echo "<td>" . $contador . "</td>";
                          $contador++;

                          echo "<td>" . $row["nom"] . "</td>";

                          echo "<td>" . $row["email"] . "</td>";

                          echo "<td>" . $row["telefon"] . "</td>";

                          echo "<td>";
                            echo "<form method='post' action='admin_usuaris_registrats.php'>";
                              echo "<input type='hidden' class='form-control' name='id_eliminar_admin' value='" . $row['id'] . "'>";
                              echo "<input type='hidden' class='form-control' name='nom_eliminar_admin' value='" . $row['nom'] . "'>";
                              echo "<input type='submit' class='btn btn-danger' value='Treure admin' name='eliminar_admin'>";
                            echo "</form>";
                          echo "</td>";
                        echo "</tr>";
                      }

                    } else {
                      echo "<tr>";
                        echo "<td colspan='5'><h6 class='text-center'>Cap usuari més administrador.</h6></td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php

          } else {
            ?>
            <h2>No té permisos per visualitzar la pàgina</h2>
            <p>Torna a la pàgina principal.</p>
            <a class="boto_marro btn" href="index.php">Pàgina inicial</a>
            <?php
          }

        } else {
          no_ha_iniciat_sessio();
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
