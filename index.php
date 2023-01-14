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
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Activitat 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Activitat 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Activitat 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Activitat 4"></button>
      </div>
      <div id="carruselImatges" class="carousel-inner">
        <div class="carousel-item active">
          <img src="imatges/portada/imatge_1.jpg" class="d-block w-100" alt="Activitat 1">
        </div>
        <?php
          for ($i = 2; $i <= 4 ; $i++) {
            echo "<div class='carousel-item'>";
              echo "<img src='imatges/portada/imatge_$i.jpg' class='d-block w-100' alt='Imatge $i'>";
            echo "</div>";
          }
        ?>
      </div>
    </div>

    <section id="contingut_pagina">
      <div class="container">
        <h3>Pròximes activitats disponibles</h3>

        <div class="row" id="caselles_activitats">
          <?php
          $dia_ara = date("Y-m-d");
          $sql = "SELECT * FROM activitat WHERE dia >= '$dia_ara' AND esta_acceptada = 1 
                    AND participants_disponibles > 0 ORDER BY dia ASC LIMIT 6";
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

    <section id="newsletter">
      <div class="container">
        <h3>Vols conèixer més sobre AILLED?</h3>
        <p>Informa't a través del nostre newsletter.</p>
        <p>Introdueix el teu correu electrònic i t'enviarem el nostre fulletó.</p>

        <?php
        if (isset($_POST["newsletter"])) {
          $email = $_POST["email"];

          $afegir_usuari = "INSERT INTO newsletter (email, enviat) VALUES (:email, 0)";
          $execucio = $connexio_PDO->prepare($afegir_usuari);
          $execucio->execute(array(
            ":email" => $email
          )
        );

        ?>
        <div class="container py-2">
          <div class='alert alert-success' role='alert'>En els propers dies rebràs el nostre newsletter al teu correu introduït.</div>
        </div>
        <?php
      }

      ?>

      <form class="row g-2" method="post" action="index.php">
        <div class="col-md-4">
          <input type="email" class="form-control" name="email" required>
        </div>

        <div class="col-4">
          <input type="submit" class="btn boto_marro" value="Enviar" name="newsletter">
        </div>
      </form>

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
