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
    <section id="voluntariats">
      <div class="container">

        <?php
        if (isset($_SESSION["id_usuari_sessio"])) {
          ?>
          <h3>Voluntariat</h3>
          <p>Vols fer voluntariat a AILLED? Escull l'activitat que més desitgi.</p>
          <p>A continuació, es mostren totes les activitats a AILLED dels quals aquest compte no és creador i hi ha places de voluntariat.</p>

          <?php

          if (isset($_POST["submit"])) {
            $id_activitat = $_POST["id_activitat"];
            $id_usuari = $_SESSION['id_usuari_sessio'];

            $sql_voluntari = "INSERT INTO voluntariat (id_usuari, id_activitat) VALUES (:id_usuari, :id_activitat)";
            $result_voluntari = $connexio_PDO->prepare($sql_voluntari);

            $result_voluntari->execute(array(
              ":id_usuari" => $id_usuari,
              ":id_activitat" => $id_activitat
            )
          );

          echo "<div class='alert alert-success' role='alert'>Moltes gràcies per afegir-te de voluntàri/a.</div>";

          $sql_update_voluntari = "UPDATE activitat SET voluntaris_disponibles=(voluntaris_disponibles-1) WHERE id = $id_activitat";
          $result_update_voluntari = $connexio_PDO->prepare($sql_update_voluntari);

          $result_update_voluntari->execute();
        }

        if (isset($_POST["submitdelete"])) {
          $id_activitat = $_POST["id_activitat"];
          $id_usuari = $_SESSION['id_usuari_sessio'];

          $sql_voluntari = "DELETE FROM voluntariat WHERE id_activitat = " . $id_activitat;
          $result_voluntari = $connexio_PDO->prepare($sql_voluntari);

          $result_voluntari->execute();

          echo "<div class='alert alert-success' role='alert'>T'has desapuntat com a voluntari.</div>";

          $sql_update_voluntari = "UPDATE activitat SET voluntaris_disponibles=(voluntaris_disponibles + 1) WHERE id = $id_activitat";
          $result_update_voluntari = $connexio_PDO->prepare($sql_update_voluntari);

          $result_update_voluntari->execute();
        }

        ?>

        <div class="table-responsive py-3">
          <table class="table" style="font-size: 15px">
            <thead>
              <tr>
                <th scope="col">Nom de l'activitat</th>
                <th scope="col">Ubicació activitat</th>
                <th scope="col">Dia i hora</th>
                <th scope="col">  </th>
                <th scope="col">  </th>
              </tr>
            </thead>
            <tbody>

              <?php
              $dia_ara = date("Y-m-d");

              $sql = "SELECT * FROM activitat WHERE dia >= '$dia_ara' AND esta_acceptada > 0 AND voluntaris_disponibles >= 0 AND id_usuari != " . $_SESSION['id_usuari_sessio'] . " ORDER BY dia ASC";
              $result = $connexio->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";

                    echo "<td><a href='detall_activitat.php?id=" . $row["id"] . "'>" . $row["nom"] . "</a></td>";

                    echo "<td>" . $row["ubicacio"] . "</td>";

                    echo "<td>";
                      $data_convertida = date("d-m-Y", strtotime($row["dia"]));
                      $hora_convertida = date("g:ia", strtotime($row["hora"]));
                      echo $data_convertida . " " . $hora_convertida;
                    echo "</td>";

                    echo "<td>";
                      $sql2 = "SELECT * FROM voluntariat WHERE id_usuari = " . $_SESSION['id_usuari_sessio'] . " AND id_activitat = " . $row["id"];
                      $result2 = $connexio->query($sql2);

                      if ($result2->num_rows > 0) {
                        echo "---";
                      } else {
                        if ($row["voluntaris_disponibles"] > 0) {
                          echo "<form action='voluntariat.php' method='post'>";
                          echo "<input type='hidden' name='id_activitat' value='" . $row["id"] . "'>";
                          echo "<input type='submit' value='Apuntar-me' name='submit' class='boto_marro btn btn-sm'>";
                          echo "</form>";
                        } else {
                          echo "---";
                        }
                      }
                    echo "</td>";

                    echo "<td>";
                      $sql2 = "SELECT * FROM voluntariat WHERE id_usuari = " . $_SESSION['id_usuari_sessio'] . " AND id_activitat = " . $row["id"];
                      $result2 = $connexio->query($sql2);

                      if ($result2->num_rows > 0) {
                        echo "<form action='voluntariat.php' method='post'>";
                        echo "<input type='hidden' name='id_activitat' value='" . $row["id"] . "'>";
                        echo "<input type='submit' value='Desapuntar-me' name='submitdelete' class='btn btn-danger btn-sm'>";
                        echo "</form>";
                      } else {
                        echo "---";
                      }
                    echo "</td>";

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
