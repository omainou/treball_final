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
    <section id="activitats_apuntades">
      <div class="container">
        <?php
        if (isset($_SESSION["id_usuari_sessio"])) {
          ?>
          <h3>Activitats apuntades</h3>

          <p>Llista d'activitats on t'has apuntat.</p>
          <p class="text-muted">Fes click sobre el nom de l'activitat per conèixer més.</p>

          <?php
          // ELIMINACIÓ DE L'ACTIVITAT APUNTADA PER PART DE L'USUARI
          if (isset($_POST["eliminar_activitat_apuntada"])) {
            $id_eliminar = $_POST["id_eliminar"];
            $numero_participants_eliminar = $_POST["numero_participants_eliminar"];
            $id_activitat_apuntada_eliminar = $_POST["id_activitat_apuntada_eliminar"];

            // ELIMINEM AL PARTICIPANT APUNTAT

            $sql_delete = "DELETE FROM participants_apuntats WHERE id = ?";
            $resultat_delete = $connexio_PDO->prepare($sql_delete);

            $resultat_delete->execute([ $id_eliminar ]);

            // ELIMINEM SI TENIA TRANSPORT AFEGIT

            $sql_delete2 = "DELETE FROM transport WHERE id_activitat = ?";
            $resultat_delete2 = $connexio_PDO->prepare($sql_delete2);

            $resultat_delete2->execute([ $id_activitat_apuntada_eliminar ]);

            // CERCAR ELS PARTICIPANTS DISPONIBLES ACTUALS PER SUMAR-LI ELS PARTICIPANTS ELIMINATS

            $sql_select = "SELECT * FROM activitat WHERE id = " . $id_activitat_apuntada_eliminar;
            $resultat_select = $connexio->query($sql_select);

            while ($row_select = $resultat_select->fetch_assoc()) {
              $sumar_particip_disp = $row_select["participants_disponibles"] + $numero_participants_eliminar;

              // UPDATE DELS PARTICIPANTS DISPONIBLES

              $sql_update = "UPDATE activitat SET participants_disponibles=? WHERE id=?";
              $resultat_update = $connexio_PDO->prepare($sql_update);

              $resultat_update->execute([ $sumar_particip_disp, $id_activitat_apuntada_eliminar ]);
            }

            echo "<div class='alert alert-success' role='alert'>T'has eliminat de l'activitat correctament.</div>";

          }

          ?>

          <div class="table-responsive">
            <table class="table" style="font-size: 15px">
              <thead>
                <tr>
                  <th scope="col">-</th>
                  <th scope="col">Nom activitat</th>
                  <th scope="col">Ubicació activitat</th>
                  <th scope="col">Dia i hora</th>
                  <th scope="col">Apuntades</th>
                  <th scope="col">Vol transport?</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM participants_apuntats WHERE id_usuari = " . $_SESSION['id_usuari_sessio'];
                $result = $connexio->query($sql);

                if ($result->num_rows > 0) {
                  $contador = 1;

                  while ($row = $result->fetch_assoc()) {
                    $dia_ara = date("Y-m-d");
                    $sql_activitat = "SELECT * FROM activitat WHERE dia >= '$dia_ara' AND id = " . $row['id_activitat'];

                    $resultat_activitat = $connexio->query($sql_activitat);

                    echo "<tr>";
                      if ($resultat_activitat->num_rows > 0) {
                        echo "<td>" . ($contador++) . "</td>";

                        echo "<td>";
                          while ($row_activitat = $resultat_activitat->fetch_assoc()) {
                            echo "<a href='detall_activitat.php?id=" . $row_activitat["id"] . "'>" . $row_activitat["nom"] . "</a>";
                          }
                        echo "</td>";

                        echo "<td>";
                          $resultat_ubi = $connexio->query($sql_activitat);

                          while ($row_ubi = $resultat_ubi->fetch_assoc()) {
                            echo $row_ubi["ubicacio"];
                          }
                        echo "</td>";

                        echo "<td>";
                          $resultat_data = $connexio->query($sql_activitat);

                          while ($row_data = $resultat_data->fetch_assoc()) {
                            $data_convertida = date("d-m-Y", strtotime($row_data["dia"]));
                            $hora_convertida = date("g:ia", strtotime($row_data["hora"]));
                            echo $data_convertida . " " . $hora_convertida;
                          }
                        echo "</td>";

                        echo "<td>";
                          echo $row['numero_participants'] . " participants";
                        echo "</td>";

                        echo "<td>";
                          $sql_transport = "SELECT * FROM transport WHERE id_activitat = " . $row['id_activitat'];
                          $resultat_transport = $connexio->query($sql_transport);

                          if ($resultat_transport->num_rows > 0) {
                            echo "Sí";
                          } else {
                            echo "No";
                          }
                        echo "</td>";

                        echo "<td>";
                          echo "<form method='post' action='activitats_apuntades.php'>";
                            echo "<input type='hidden' class='form-control' name='id_eliminar' value='" . $row['id'] . "'>";
                            echo "<input type='hidden' class='form-control' name='id_activitat_apuntada_eliminar' value='" . $row['id_activitat'] . "'>";
                            echo "<input type='hidden' class='form-control' name='numero_participants_eliminar' value='" . $row['numero_participants'] . "'>";
                            echo "<input type='submit' class='btn btn-danger' value='Eliminar' name='eliminar_activitat_apuntada'>";
                          echo "</form>";
                        echo "</td>";

                      }
                    echo "</tr>";
                  }

                }
                ?>
              </tbody>
            </table>
          </div>
          <?php

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
