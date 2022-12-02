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
            <h3>Acceptar activitats dels usuaris</h3>

            <?php
            if (isset($_POST["acceptar_activitat"])) {
              $id_activitat = $_POST["id_activitat"];

              $sql_update = "UPDATE activitat SET esta_acceptada = 1 WHERE id = " . $id_activitat;
              $resultat_update = $connexio_PDO->prepare($sql_update);

              $resultat_update->execute();

              echo "<div class='alert alert-success'  role='alert'>Activitat acceptada.</div>";
            }

            ?>

            <div class="row py-3" id="acceptar_activitats">
              <?php
              $dia_ara = date("Y-m-d");
              $sql = "SELECT * FROM activitat WHERE esta_acceptada = 0 ORDER BY dia ASC";
              $result = $connexio->query($sql);

              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  ?>
                  <div class="col-lg-4 mb-4">
                    <div class="card">
                      <?php
                      echo "<img src='imatges/activitats/". $row["imatge"] ."' alt='". $row["id"] ."' class='card-img-top' height='250'>";
                      ?>
                      <div class="card-body">
                        <h5 class="card-title">
                          <?php
                          echo $row["nom"];
                          ?>
                        </h5>
                        <p class="card-text">
                          Creada per:
                          <?php
                          $sql_usuari = "SELECT nom FROM usuari WHERE id=" . $row["id_usuari"];
                          $resultat_usuari = $connexio->query($sql_usuari);

                          if ($resultat_usuari->num_rows > 0) {
                            while($row_usuari = $resultat_usuari->fetch_assoc()) {
                              echo $row_usuari["nom"] . ".";
                            }
                          } else {
                            echo "Usuari desconegut.";
                          }
                          ?>
                        </p>
                        <p class="card-text">
                          Descripció:
                          <?php
                          echo $row["descripcio"];
                          ?>
                        </p>
                        <p class="card-text">
                          Ubicació:
                          <?php
                          echo $row["ubicacio"] . ".";
                          ?>
                        </p>
                        <p class="card-text">
                          Participants:
                          <?php
                          echo $row["participants"] . ".";
                          ?>
                        </p>
                        <p class="card-text">
                          Dia i hora:
                          <?php
                          $data_convertida = date("d-m-Y", strtotime($row["dia"]));
                          $hora_convertida = date("g:ia", strtotime($row["hora"]));
                          echo $data_convertida . " " . $hora_convertida;
                          ?>
                        </p>
                        <p class="card-text">
                          Preu:
                          <?php
                          if($row["preu"] == 0) {
                            echo "Gratuïta.";
                          } else {
                            echo $row["preu"] . "€.";
                          }
                          ?>
                        </p>
                        <p class="card-text">
                          Conté transport l'activitat:
                          <?php
                          if($row["transport"] > 0) {
                            echo "Sí.";
                            echo "<p class='card-text'>Sortida: " . $row["lloc_sortida_transport"] . "</p>";
                          } else {
                            echo "No.";
                          }
                          ?>
                        </p>
                        <p class="card-text">
                          Voluntaris:
                          <?php
                          echo $row["voluntaris"] . ".";
                          ?>
                        </p>

                        <hr>

                        <form action="admin_acceptar_activitats.php" method="post">
                          <input type="hidden" name="id_activitat" value="<?php echo $row["id"]?>">
                          <input type="submit" value="Acceptar" name="acceptar_activitat" class="boto_marro btn">
                        </form>

                      </div>
                    </div>
                  </div>
                  <?php
                }
              } else {
                ?>
                <div class="alert alert-success" role="alert">
                  <h6 class="alert-heading">Cap activitat per acceptar.</h6>
                </div>
                <?php
              }
              ?>

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
