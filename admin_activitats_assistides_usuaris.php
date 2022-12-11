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
            <h3>Activitats assistides de cada usuari</h3>
            <p>Cercador de totes les activitats assistides de cada usuari.</p>

            <form class="row g-3" method="post" action="admin_activitats_assistides_usuaris.php">
              <label for="nom" class="form-label">
                Nom de l'usuari:
              </label>
              <div class="col-md-6">
                <select name="usuari" id="nom" required class="form-select">
                  <?php
                  $sql = "SELECT * FROM usuari ORDER BY nom ASC";
                  $result = $connexio->query($sql);

                  if ($result->num_rows > 0) {
                    echo "<option value='-1'>-</option>";

                    while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row["id"] . "'>" . $row["nom"] . " - " . $row["email"] . "</option>";
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-6">
                <input type="submit" class="btn boto_marro" value="Buscar" name="submit">
              </div>
            </form>

            <?php
            if (isset($_POST["submit"])) {
              $usuari = $_POST["usuari"];
              $dia_avui = date("Y-m-d");

              echo "<hr>";

              if ($usuari > 0) {
                $sql_usuari = "SELECT * FROM usuari WHERE id = " . $usuari;
                $result_usuari = $connexio->query($sql_usuari);

                if ($result_usuari->num_rows > 0) {
                  while ($row_usuari = $result_usuari->fetch_assoc()) {
                    echo "<h5>Usuari cercat: " . $row_usuari["nom"] . "</h5>";
                  }
                }
                ?>

                <div class="table-responsive">
                  <table class="table" style="font-size: 15px">
                    <thead>
                      <tr>
                        <th scope="col">-</th>
                        <th scope="col">Nom activitat</th>
                        <th scope="col">Ubicació activitat</th>
                        <th scope="col">Dia</th>
                        <th scope="col">Apuntades</th>
                        <th scope="col">Usuari/a creador/a</th>
                        <th scope="col">S'ha assistit?</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql_participants_apuntats = "SELECT * FROM participants_apuntats WHERE id_usuari = " . $usuari;
                      $result_participants_apuntats = $connexio->query($sql_participants_apuntats);

                      if ($result_participants_apuntats->num_rows > 0) {
                        $contador = 1;

                        while ($row_participants_apuntats = $result_participants_apuntats->fetch_assoc()) {
                          echo "<tr>";

                          $sql_activitats = "SELECT * FROM activitat WHERE dia <= '$dia_avui' AND id = " . $row_participants_apuntats["id_activitat"];
                          $result_activitats = $connexio->query($sql_activitats);

                          if ($result_activitats->num_rows > 0) {
                            while ($row_activitats = $result_activitats->fetch_assoc()) {
                              echo "<td>" . ($contador++) . "</td>";

                              echo "<td>";
                                echo "<a href='detall_activitat.php?id=" . $row_activitats["id"] . "'>" . $row_activitats["nom"] . "</a>";
                              echo "</td>";

                              echo "<td>" . $row_activitats["ubicacio"] . "</td>";

                              echo "<td>" . date("d-m-Y", strtotime($row_activitats["dia"])) . "</td>";

                              echo "<td>" . $row_participants_apuntats["numero_participants"] . " persones</td>";

                              echo "<td>";
                                $sql_creador = "SELECT * FROM usuari WHERE id = " . $row_activitats["id_usuari"];
                                $result_creador = $connexio->query($sql_creador);

                                if ($result_creador->num_rows > 0) {
                                  while ($row_creador = $result_creador->fetch_assoc()) {
                                    echo $row_creador["nom"];
                                  }
                                }
                              echo "</td>";

                              echo "<td>";
                                if ($row_participants_apuntats["assistir"] > 0) {
                                  echo "Sí";
                                } else {
                                  echo "No";
                                }
                              echo "</td>";

                            }

                          } else {
                            echo "<td colspan='7'>Cap activitat realitzada anteriorment a data d'avui.</td>";   
                          }

                          echo "</tr>";
                        }
                      }
                      ?>

                    </tbody>
                  </table>

                </div>

                <div id="total_activitats">
                  <?php
                  $sql_total = "SELECT COUNT(assistir) FROM participants_apuntats WHERE assistir > 0 AND id_usuari= " . $usuari;
                  $result_total = $connexio->query($sql_total);

                  if ($result_total->num_rows > 0) {
                    while ($row_total = $result_total->fetch_assoc()) {
                      echo "<p>Ha assistit: " . $row_total["COUNT(assistir)"] . " activitat/s.</p>";
                    }
                  }
                  ?>
                </div>
                <?php

              } else {
                echo "<h5>Selecciona correctament un usuari.</h5>";
              }
            }

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
