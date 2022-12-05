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
    <section id="meves_activitats">
      <div class="container">
        <?php
        if (isset($_SESSION["id_usuari_sessio"])) {
          ?>
          <h3>Les meves activitats</h3>
          <p>Les activitats disponibles es mostren a continuació.</p>

          <div class="row" id="caselles_activitats">
            <?php
            $dia_ara = date("Y-m-d");
            $sql = "SELECT * FROM activitat WHERE dia >= '$dia_ara' AND id_usuari =" . $_SESSION['id_usuari_sessio'] . " ORDER BY dia ASC";
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
                        Ubicació:
                        <?php
                        echo $row["ubicacio"] . ".";
                        ?>
                      </p>
                      <p class="card-text">
                        Places disponibles:
                        <?php
                        echo $row["participants_disponibles"] . ".";
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
              <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Cap activitat disponible!</h4>
                <hr>
                <p class="mb-0">Crea una activitat i poder coneixer gent.</p> <br>
                <a href="crear_activitat.php" class="btn btn-outline-danger">Crear activitat</a>
              </div>
              <?php
            }
            ?>
          </div>

          <hr>

          <h3>Activitats ja realitzades</h3>

          <div class="row" id="caselles_activitats">
            <?php
            $dia_ara = date("Y-m-d");
            $sql = "SELECT * FROM activitat WHERE dia < '$dia_ara' AND id_usuari =" . $_SESSION['id_usuari_sessio'] . " ORDER BY dia DESC";
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
                        Ubicació:
                        <?php
                        echo $row["ubicacio"] . ".";
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
              <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Cap activitat realitzada fins a l'actualitat.</h4>
              </div>
              <?php
            }
            ?>
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
