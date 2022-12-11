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
    <section id="detall_activitat">
      <div class="container">
        <?php
        if (isset($_SESSION["id_usuari_sessio"])) {

          if (isset($_POST["submit_assistencia"])) {
            $asistencia = $_POST["asistencia"];
            $ids = $_POST["ids"];

            $sql_update_pwd = "UPDATE participants_apuntats SET assistir=? WHERE id=?";
            $resultat_update_pwd = $connexio_PDO->prepare($sql_update_pwd);

            $resultat_update_pwd->execute([
              $asistencia,
              $ids
            ]);
          }

          $id_activitat_buscada = $_GET["id"];

          $sql = "SELECT * FROM activitat WHERE id = '$id_activitat_buscada'";
          $result = $connexio->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              if (isset($_SESSION['id_usuari_sessio'])) {

                if ($row["id_usuari"] == $_SESSION['id_usuari_sessio']) {
                  ?>
                  <h4>Participants apuntats a l'activitat</h4>

                  <div class="table-responsive py-3">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nom de l'usuari</th>
                          <th scope="col">Nombre de participants</th>
                          <th scope="col">Vol transport?</th>
                          <th scope="col">Ha assistit?</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $sql_table = "SELECT * FROM participants_apuntats WHERE id_activitat = " . $id_activitat_buscada ;
                        $result_table = $connexio->query($sql_table);

                        if ($result_table->num_rows > 0) {
                          while ($row_table = $result_table->fetch_assoc()) {
                            echo "<tr>";

                              echo "<td>";
                                $sql2 = "SELECT * FROM usuari WHERE id = " . $row_table["id_usuari"] . " ORDER BY nom ASC";
                                $result2 = $connexio->query($sql2);

                                if ($result2->num_rows > 0) {
                                  while ($row2 = $result2->fetch_assoc()) {
                                    echo strtoupper($row2["nom"]);
                                  }
                                }
                              echo "</td>";

                              echo "<td>" . $row_table["numero_participants"] . " participant/s</td>";

                              echo "<td>";
                                $table = "SELECT * FROM transport WHERE id_activitat = " . $row_table["id_activitat"];
                                $resultat_table = $connexio->query($table);

                                if ($resultat_table->num_rows > 0) {
                                  echo "Sí.";
                                } else {
                                  echo "No.";
                                }
                              echo "</td>";

                              echo "<td>";
                                $dia_ara = date("Y-m-d");
                                $table = "SELECT * FROM activitat WHERE dia < '$dia_ara' AND id = " . $id_activitat_buscada;
                                $resultat_table = $connexio->query($table);

                                if ($resultat_table->num_rows > 0) {
                                  echo "<form method='post' class='row g-3' action='detall_activitat_participants_voluntaris.php?id=" . $row['id'] . "'>";
                                    echo "<div class='col-md-4'>";
                                      echo "<select class='form-select' name='asistencia'>";
                                        if ($row_table["assistir"] == 1) {
                                          echo "<option value='1'>Sí</option>";
                                          echo "<option value='0'>No</option>";
                                        } else {
                                          echo "<option value='0'>No</option>";
                                          echo "<option value='1'>Sí</option>";
                                        }
                                      echo "</select>";
                                    echo "</div>";

                                    echo "<input type='hidden' name='ids' value='" . $row_table["id"] . "'>";

                                    echo "<div class='col-4'>";
                                      echo "<input type='submit' class='btn boto_marro' value='Actualitzar' name='submit_assistencia'>";
                                    echo "</div>";
                                  echo "</form>";
                                } else {
                                  echo "Activitat no realitzada.";
                                }
                              echo "</td>";

                            echo "</tr>";
                          }
                        } else {
                          echo "<tr>";
                            echo "<td colspan='4'>No hi ha participants apuntats.</td>";
                          echo "</tr>";
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>

                  <!-- //////////////////////////////////// -->

                  <hr>

                  <h4>Voluntaris apuntats a l'activitat</h4>

                  <ul>
                    <?php
                    $sql_table = "SELECT * FROM voluntariat WHERE id_activitat = " . $id_activitat_buscada;
                    $result_table = $connexio->query($sql_table);

                    if ($result_table->num_rows > 0) {
                      while ($row_table = $result_table->fetch_assoc()) {
                        $sql2 = "SELECT * FROM usuari WHERE id = " . $row_table["id_usuari"] . " ORDER BY nom ASC";
                        $result2 = $connexio->query($sql2);

                        if ($result2->num_rows > 0) {
                          while ($row2 = $result2->fetch_assoc()) {
                            echo "<li>" . strtoupper($row2["nom"]) . ".</li>";
                          }
                        }
                      }
                    } else {
                      echo "- No hi ha voluntaris apuntats.";
                    }
                    ?>

                  </ul>

                  <?php

                } else {
                  ?>
                  <h2>No té permisos per visualitzar la pàgina</h2>
                  <p>Torna a la pàgina principal.</p>
                  <a class="boto_marro btn" href="index.php">Pàgina inicial</a>
                  <?php

                }

              }

            }

          } else {
            echo "<div class='alert alert-danger' role='alert'>No hi ha cap activitat amb aquesta id: " . $id_activitat_buscada . "</div>";
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
