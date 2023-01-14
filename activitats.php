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
        <h3>Activitats d'AILLED</h3>

        <div id="cercadors">
          <form class="row g-3 py-2" action="activitats.php" method="post">
            <label for="dia" class="form-label">Cercar activitat per dia:</label>
            <div class="col-md-4">
              <input type="date" class="form-control" id="dia" name="inputdia" required min="<?php echo date("Y-m-d")?>">
            </div>
            <div class="col-md-8">
              <input type="submit" value="Buscar" class="boto_marro btn" name="buscardata">
            </div>
          </form>

          <form class="row g-3 py-2" action="activitats.php" method="post">
            <label for="nom" class="form-label">Cercar activitat per nom:</label>
            <div class="col-md-4">
              <input type="text" class="form-control" id="nom" name="inputnom" placeholder="Cercador per nom" required>
            </div>
            <div class="col-md-8">
              <input type="submit" value="Buscar" class="boto_marro btn" name="buscarnom">
            </div>
          </form>
        </div>

        <div class="row">
          <?php

          if (isset($_POST["buscardata"])) {
            $dia_buscar = $_POST["inputdia"];
            $sql = "SELECT * FROM activitat WHERE dia = '$dia_buscar' AND esta_acceptada = 1 AND participants_disponibles > 0 ORDER BY hora ASC";
            $result = $connexio->query($sql);

            if ($result->num_rows > 0) {
              echo "<h4 class='py-2'>- Data cercada: " . date("d-m-Y", strtotime($dia_buscar)) . "</h4>";

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
                        } else {
                          echo "No.";
                        }
                        ?>
                      </p>

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
                <h5 class="alert-heading">Cap activitat amb aquesta data</h5>
              </div>
              <?php
            }
          }

          if (isset($_POST["buscarnom"])) {
            $nom_buscar = $_POST["inputnom"];
            $dia_ara = date("Y-m-d");

            $sql = "SELECT * FROM activitat WHERE nom LIKE '%" . $nom_buscar . "%' AND dia >= '$dia_ara' ORDER BY dia ASC";
            $result = $connexio->query($sql);

            if ($result->num_rows > 0) {
              echo "<h4 class='py-2'>- Nom cercat: " . $nom_buscar . "</h4>";

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
                        } else {
                          echo "No.";
                        }
                        ?>
                      </p>

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
                <h5 class="alert-heading">Cap activitat amb aquestes lletres en el nom</h5>
              </div>
              <?php
            }
          }

          ?>
        </div>

        <hr>

        <div class="row" id="caselles_activitats">

          <?php
          $dia_ara = date("Y-m-d");
          $sql = "SELECT * FROM activitat WHERE dia >= '$dia_ara' AND esta_acceptada = 1 AND participants_disponibles > 0 
                    ORDER BY dia ASC";
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
                      } else {
                        echo "No.";
                      }
                      ?>
                    </p>

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
