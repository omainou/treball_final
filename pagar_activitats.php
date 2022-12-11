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
          <h3>Pagar les activitats</h3>
          <p>Llista d'activitats on t'has apuntat i pots pagar a través d'AILLED.</p>
          <p>Encara que el preu total sigui '0€' selecciona el botó 'Pagar' per validar l'activitat.</p>

          <?php
          if (isset($_POST["pagar_activitat"])) {
            $id_pagar = $_POST["id_pagar"];
            $pagat = 1;

            $sql_update = "UPDATE participants_apuntats SET ha_pagat=? WHERE id=?";
            $resultat_update = $connexio_PDO->prepare($sql_update);

            $resultat_update->execute([ $pagat, $id_pagar ]);

            echo "<div class='alert alert-success' role='alert'>Activitat pagada correctament.</div>";
          }
          ?>

          <div class="table-responsive">
            <table class="table" style="font-size: 15px">
              <thead>
                <tr>
                  <th scope="col">Nom activitat</th>
                  <th scope="col">Dia i hora</th>
                  <th scope="col">Apuntades</th>
                  <th scope="col">Total</th>
                  <th scope="col">Pagar</th>
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
                        echo "<td>";
                          while ($row_activitat = $resultat_activitat->fetch_assoc()) {
                            echo "<a href='detall_activitat.php?id=" . $row_activitat["id"] . "'>" . $row_activitat["nom"] . "</a>";
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
                          $resultat_preu = $connexio->query($sql_activitat);
                          while ($row_preu_activitat = $resultat_preu->fetch_assoc()) {
                            $total = $row_preu_activitat["preu"] * $row['numero_participants'];
                            echo $total . "€";
                          }

                        echo "</td>";

                        echo "<td>";
                          if ($row['ha_pagat'] > 0) {
                            echo "Pagada.";
                          } else {
                            echo "<form method='post' action='pagar_activitats.php'>";
                              echo "<input type='hidden' class='form-control' name='id_pagar' value='" . $row['id'] . "'>";
                              echo "<input type='submit' class='boto_marro btn' value='Pagar' name='pagar_activitat'>";
                            echo "</form>";
                          }
                        echo "</td>";

                      }
                    echo "</tr>";
                  }
                } else {
                  echo "<tr>";
                    echo "<td colspan='7'>No s'ha apuntat a cap activitat.</td>";
                  echo "</tr>";
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
