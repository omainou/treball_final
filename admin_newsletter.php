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
            <h3>Newsletters pendents</h3>

            <?php
            if (isset($_POST["eliminar"])) {
              $id_newsletter = $_POST["id_newsletter_taula"];

              $sql_delete = "DELETE FROM newsletter WHERE id=?";
              $resultat_delete = $connexio_PDO->prepare($sql_delete);
              $resultat_delete->execute([ $id_newsletter ]);

              echo "<div class='alert alert-success' role='alert'>Eliminat correctament.</div>";
            }

            if (isset($_POST["enviar"])) {
              $id_newsletter = $_POST["id_newsletter_taula"];

              $sql_enviar = "UPDATE newsletter SET enviat = 1 WHERE id=?";
              $resultat_enviar = $connexio_PDO->prepare($sql_enviar);
              $resultat_enviar->execute([ $id_newsletter ]);

              echo "<div class='alert alert-success' role='alert'>Afegit a la taula d'enviats.</div>";
            }
            ?>

            <div class="row" id="newsletters">
              <div class="table-responsive">
                <table class="table" style="font-size: 15px">
                  <thead>
                    <tr>
                      <th scope="col">-</th>
                      <th scope="col">Correu electrònic</th>
                      <th scope="col">Enviat</th>
                      <th scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $sql = "SELECT * FROM newsletter WHERE enviat = 0 ORDER BY id ASC";
                    $result = $connexio->query($sql);

                    if ($result->num_rows > 0) {
                      $contador = 1;

                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        echo "<td>" . $contador . "</td>";
                        $contador++;

                        echo "<td>" . $row["email"] . "</td>";

                        echo "<td>";
                          echo "<form method='post' action='admin_newsletter.php'>";
                            echo "<input type='hidden' class='form-control' name='id_newsletter_taula' value='" . $row['id'] . "'>";
                            echo "<input type='submit' class='btn boto_marro' value='Enviat' name='enviar'>";
                          echo "</form>";
                        echo "</td>";

                        echo "<td>";
                          echo "<form method='post' action='admin_newsletter.php'>";
                            echo "<input type='hidden' class='form-control' name='id_newsletter_taula' value='" . $row['id'] . "'>";
                            echo "<input type='submit' class='btn btn-danger' value='Eliminar' name='eliminar'>";
                          echo "</form>";
                        echo "</td>";

                        echo "</tr>";
                      }

                    } else {
                      echo "<tr>";
                        echo "<td colspan='4'><h6 class='text-center'>Cap newsletter per enviar.</h6></td>";
                      echo "</tr>";
                    }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <hr>

            <h3>Newsletters enviats</h3>

            <div class="row" id="newsletters">
              <div class="table-responsive">
                <table class="table" style="font-size: 15px">
                  <thead>
                    <tr>
                      <th scope="col">-</th>
                      <th scope="col">Correu electrònic</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $sql = "SELECT * FROM newsletter WHERE enviat > 0 ORDER BY id DESC";
                    $result = $connexio->query($sql);

                    if ($result->num_rows > 0) {
                      $contador = 1;

                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        echo "<td>" . $contador . "</td>";
                        $contador++;

                        echo "<td>" . $row["email"] . "</td>";

                        echo "</tr>";
                      }

                    } else {
                      echo "<tr>";
                        echo "<td colspan='4'><h6 class='text-center'>Cap newsletter enviat.</h6></td>";
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
