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
            <h3>Usuaris apuntats a les activitats</h3>
            <p>En aquesta pàgina es mostren tots els usuaris apuntats/voluntaris a les activitats.</p>

            <div class="row" id="usuaris_apuntats_activitats">
              <?php
              $dia_ara = date("Y-m-d");

              $sql = "SELECT * FROM activitat WHERE dia >= '$dia_ara' AND esta_acceptada != 0 ORDER BY dia ASC";
              $result = $connexio->query($sql);

              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  ?>
                  <div class="col-lg-4 mb-4">
                    <div class="card">
                      <?php
                      echo "<img src='imatges/activitats/". $row["imatge"] ."' alt='". $row["nom"] ."' class='card-img-top' height='250'>";
                      ?>
                      <div class="card-body">
                        <h5 class="card-title">
                          <?php
                          echo $row["nom"];
                          ?>
                        </h5>
                        <p class="card-text">
                          Dia:
                          <?php
                          $data_convertida = date("d-m-Y", strtotime($row["dia"]));
                          echo $data_convertida;
                          ?>
                        </p>

                        <p class="card-text">Participants disponibles: <?php echo $row["participants_disponibles"] ?></p>

                        <hr>

                        <p class="card-text">Participants apuntats:</p>

                        <?php
                        $sql_participants = "SELECT * FROM participants_apuntats WHERE id_activitat = " . $row['id'];
                        $resultat_participants = $connexio->query($sql_participants);

                        if ($resultat_participants->num_rows > 0) {
                          while ($row_participants = $resultat_participants->fetch_assoc()) {
                            $sql_usuaris = "SELECT * FROM usuari WHERE id = " . $row_participants['id_usuari'];
                            $resultat_usuaris = $connexio->query($sql_usuaris);

                            while ($row_usuaris = $resultat_usuaris->fetch_assoc()) {
                              echo "<li>" . $row_usuaris["nom"] . " - " . $row_usuaris["email"] . "</li>";
                            }
                          }
                        } else {
                          echo "- Cap usuari registrat a l'activitat.";
                        }
                        ?>

                        <hr>

                        <p class="card-text">Voluntaris apuntats:</p>

                        <?php
                        $sql_participants = "SELECT * FROM participants_apuntats WHERE id_activitat = " . $row['id'];
                        $resultat_participants = $connexio->query($sql_participants);

                        if ($resultat_participants->num_rows > 0) {
                          while ($row_participants = $resultat_participants->fetch_assoc()) {
                            $sql_usuaris = "SELECT * FROM usuari WHERE id = " . $row_participants['id_usuari'];
                            $resultat_usuaris = $connexio->query($sql_usuaris);

                            while ($row_usuaris = $resultat_usuaris->fetch_assoc()) {
                              echo "<li>" . $row_usuaris["nom"] . " - " . $row_usuaris["email"] . "</li>";
                            }
                          }
                        } else {
                          echo "- Cap usuari registrat a l'activitat.";
                        }
                        ?>

                        <hr>

                        <div class="veuremes">
                          <a href="detall_activitat.php?id=<?php echo $row["id"]?>" class="boto_marro btn">Veure més</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              } else {
                ?>
                <div class="alert alert-success" role="alert">
                  <h6 class="alert-heading">Cap activitat disponible.</h6>
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
