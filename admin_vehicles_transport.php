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
          ?>
          <h3>Vehicles de transport</h3>

          <?php
          if (isset($_POST["eliminar_vehicle_taula"])) {
            $id_transport = $_POST["id_vehicle_taula"];

            $sql_delete = "DELETE FROM vehicles_transport WHERE id=?";
            $resultat_delete = $connexio_PDO->prepare($sql_delete);
            $resultat_delete->execute([ $id_transport ]);

            echo "<div class='alert alert-success' role='alert'>Vehícle eliminat correctament.</div>";
          }

          if (isset($_POST["afegir_vehicle_taula"])) {
            $transport = ucfirst($_POST["transport"]); // converteix el primer caracter a majuscula

            $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexio_PDO->exec("SET CHARACTER SET utf8");

            $sql_afegir = "INSERT INTO vehicles_transport (vehicle) VALUES (:vehicle)";
            $resultat = $connexio_PDO->prepare($sql_afegir);

            $resultat->execute(array(
              ":vehicle" => $transport
            )
          );

          echo "<div class='alert alert-success' role='alert'>Vehícle afegit correctament.</div>";
        }
        ?>

        <div class="py-4">
          <form class="row g-3" method="post" action="admin_vehicles_transport.php">
            <label for="transport" class="form-label">
              Afegeix transport:
            </label>
            <div class="col-md-3">
              <input type="text" class="form-control" id="transport" name="transport" required autofocus>
            </div>

            <div class="col-3">
              <input type="submit" class="btn boto_marro" value="Afegir" name="afegir_vehicle_taula">
            </div>
          </form>
        </div>

        <div class="row" id="transport_vehicles">
          <div class="table-responsive">
            <table class="table" style="font-size: 15px">
              <thead>
                <tr>
                  <th scope="col">-</th>
                  <th scope="col">Vehicle de transport</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>

                <?php

                $sql = "SELECT * FROM vehicles_transport ORDER BY id ASC";
                $result = $connexio->query($sql);

                if ($result->num_rows > 0) {
                  $contador = 1;

                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";

                      echo "<td>" . $contador . "</td>";
                      $contador++;

                      echo "<td>" . $row["vehicle"] . "</td>";

                      echo "<td>";
                        echo "<form method='post' action='admin_vehicles_transport.php'>";
                          echo "<input type='hidden' class='form-control' name='id_vehicle_taula' value='" . $row['id'] . "'>";
                          echo "<input type='submit' class='btn btn-danger' value='Eliminar' name='eliminar_vehicle_taula'>";
                        echo "</form>";
                      echo "</td>";

                    echo "</tr>";
                  }

                } else {
                  echo "<tr>";
                    echo "<td colspan='4'><h6 class='text-center'>Cap vehicle registrat.</h6></td>";
                  echo "</tr>";
                }

                ?>
              </tbody>
            </table>
          </div>
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
