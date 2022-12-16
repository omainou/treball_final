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
    <section id="detall_activitat">
      <div class="container">
        <?php
        if (isset($_SESSION["id_usuari_sessio"])) {

          if (isset($_POST["registrar_activitat"])) {
            $id_usuari = $_SESSION["id_usuari_sessio"];
            $id_activitat = $_POST["id_act_registrat"];
            $numero_participants = $_POST["participants_act_registrat"];

            $sql_num_participants = "SELECT * FROM activitat WHERE id = " . $id_activitat;
            $resultat_num_participants = $connexio->query($sql_num_participants);

            while ($row_num_participants = $resultat_num_participants->fetch_assoc()) {
              if ($row_num_participants["participants_disponibles"] >= $numero_participants) {
                $sql_afegir_participants = "INSERT INTO participants_apuntats (id_usuari, id_activitat, numero_participants, ha_pagat) VALUES (:id_usuari, :id_activitat, :numero_participants, 0)";
                $resultat_afegir_participants = $connexio_PDO->prepare($sql_afegir_participants);

                $resultat_afegir_participants->execute(array(
                  ":id_usuari" => $id_usuari,
                  ":id_activitat" => $id_activitat,
                  ":numero_participants" => $numero_participants
                )
              );

              if (isset($_POST["transport_act_registrat"]) && ($_POST["transport_act_registrat"] == '1')) {
                $sql_transport = "INSERT INTO transport (id_usuari, id_activitat, persones) VALUES (:id_usuari, :id_activitat, :persones)";
                $resultat_transport = $connexio_PDO->prepare($sql_transport);

                $resultat_transport->execute(array(
                  ":id_usuari" => $id_usuari,
                  ":id_activitat" => $id_activitat,
                  ":persones" => $numero_participants
                )
              );
            }

            echo "<div class='alert alert-success'  role='alert'>Activitat apuntada correctament.</div>";

            // UPDATE

            $p_disponibles = $row_num_participants["participants_disponibles"] - $numero_participants;
            $sql_update_particip_dispon = "UPDATE activitat SET participants_disponibles = :p_disponibles WHERE id = " . $_GET["id"];
            $resultat_update_particip_dispon = $connexio_PDO->prepare($sql_update_particip_dispon);

            $resultat_update_particip_dispon->execute(array(
              ":p_disponibles" => $p_disponibles
            )
          );

        } else {
          echo "<div class='alert alert-danger'  role='alert'>ERROR. Només queden " . $row_num_participants["participants_disponibles"] . " places disponibles.</div>";
        }

      }

    }

    if (isset($_POST["update_act"])) {
      $nom_activitat = $_POST["nom_activitat"];
      $ubicacio_activitat = $_POST["ubicacio_activitat"];
      $descripcio_activitat = $_POST["descripcio_activitat"];
      $dia_activitat = $_POST["dia_activitat"];
      $hora_activitat = $_POST["hora_activitat"];
      $preu_activitat = $_POST["preu_activitat"];
      $transport_activitat = $_POST["transport_activitat"];
      $lloc_sortida_transport = $_POST["lloc_sortida_transport"];
      $vehicle_transport = $_POST["vehicle_transport"];
      $arxiu = $_FILES['img_activitat']['name'];
      $id_activitat = $_GET["id"];

      if ($_FILES['img_activitat']["error"] > 0) {

        ?>
        <div class="alert alert-danger" role="alert">
          Error a l'omplir el formulari. Prova-ho de nou.
        </div>
        <?php

      } else {

        $img_nova = rand(0, 10000) . "_" . $arxiu;
        move_uploaded_file($_FILES['img_activitat']['tmp_name'], "imatges/activitats/" . $img_nova);

        $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexio_PDO->exec("SET CHARACTER SET utf8");

        $sql_update = "UPDATE activitat SET nom=?, ubicacio=?, descripcio=?, dia=?, hora=?, preu=?, imatge=?, transport=?, lloc_sortida_transport=?, id_vehicle_transport=? WHERE id=?";
        $resultat_update = $connexio_PDO->prepare($sql_update);

        $resultat_update->execute([
          $nom_activitat,
          $ubicacio_activitat,
          $descripcio_activitat,
          $dia_activitat,
          $hora_activitat,
          $preu_activitat,
          $img_nova,
          $transport_activitat,
          $lloc_sortida_transport,
          $vehicle_transport,
          $id_activitat
        ]);

        echo "<div class='alert alert-success'  role='alert'>Activitat editada correctament.</div>";

      }

    }

    /////////////////-------------------------------------------////////////////////

    $id_activitat_buscada = $_GET["id"];

    $sql = "SELECT * FROM activitat WHERE id = '$id_activitat_buscada'";
    $result = $connexio->query($sql);

    if ($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {

        if (isset($_SESSION['id_usuari_sessio'])) {

          if ($row["id_usuari"] == $_SESSION['id_usuari_sessio']) {

            ?>

            <form action="detall_activitat.php?id=<?php echo $row['id'] ?>" method="post" enctype="multipart/form-data">
              <div class="card mb-3">
                <img class="card-img-top" src="imatges/activitats/<?php echo $row['imatge'] ?>" title="<?php echo $row['nom'] ?>" alt="<?php echo $row['nom'] ?>" height="400" >
                <div class="card-body">
                  <div class="col-12 py-2">
                    <label for="nom" class="form-label">
                      Nom de l'activitat
                      <span class="text-danger">*</span>
                    </label>
                    <input value="<?php echo $row['nom'] ?>" type="text" class="form-control" maxlength="50" minlength="1" name="nom_activitat" id="nom" required>
                  </div>

                  <div class="col-12 py-2">
                    <label for="ubicacio" class="form-label">
                      Ubicació de l'activitat
                      <span class="text-danger">*</span>
                    </label>
                    <input value="<?php echo $row['ubicacio'] ?>" type="text" class="form-control" maxlength="50" minlength="1" name="ubicacio_activitat" id="ubicacio" required>
                  </div>

                  <div class="col-12 py-2">
                    <label for="descripcio" class="form-label">
                      Descripció de l'activitat
                      <span class="text-danger">*</span>
                    </label>
                    <textarea name="descripcio_activitat" id="descripcio" rows="5" class="form-control" maxlength="300" required><?php echo $row['descripcio'] ?></textarea>
                  </div>

                  <div class="col-12 py-2">
                    <label for="imatge" class="form-label">
                      Imatge de l'activitat
                      <span class="text-danger">*</span>
                      <span class="text-muted" id="max_paraules">[Torna a introduïr la imatge]</span>
                    </label>
                    <input type="file" class="form-control" name="img_activitat" id="imatge" required>
                  </div>

                  <div class="col-12 py-2">
                    <label for="dia" class="form-label">
                      Dia de l'activitat
                      <span class="text-danger">*</span>
                    </label>
                    <input value="<?php echo $row['dia'] ?>" type="date" class="form-control" name="dia_activitat" id="dia" required>
                  </div>

                  <div class="col-12 py-2">
                    <label for="hora" class="form-label">
                      Hora de l'activitat
                      <span class="text-danger">*</span>
                    </label>
                    <input value="<?php echo $row['hora'] ?>" type="time" class="form-control" name="hora_activitat" id="hora" required>
                  </div>

                  <div class="col-12 py-2">
                    <label for="preu" class="form-label">
                      Preu de l'activitat
                      <span class="text-danger">*</span>
                    </label>
                    <input value="<?php echo $row['preu'] ?>" type="number" class="form-control" name="preu_activitat" id="preu" min="0" required>
                  </div>

                  <div class="col-12 py-2">
                    <label for="transport" class="form-label">
                      L'activitat té transport?
                      <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" id="transport" name="transport_activitat">
                      <?php
                      if ($row["transport"] > 0) {
                        echo "<option value='1'>Sí.</option>";
                        echo "<option value='0'>No.</option>";
                      } else {
                        echo "<option value='0'>No.</option>";
                        echo "<option value='1'>Sí.</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-12 py-2">
                    <label for="lloc_sortida_transport" class="form-label">
                      En cas de tenir transport, quina és la ubicació de sortida
                    </label>
                    <?php
                    if ($row["lloc_sortida_transport"] != NULL) {
                      ?>
                      <input value="<?php echo $row['lloc_sortida_transport'] ?>" type="text" class="form-control" maxlength="50" minlength="1" name="lloc_sortida_transport" id="lloc_sortida_transport">
                      <?php
                    } else {
                      ?>
                      <input type="text" class="form-control" maxlength="50" minlength="1" name="lloc_sortida_transport" id="lloc_sortida_transport">
                      <?php
                    }
                    ?>
                  </div>

                  <div class="col-12 py-2">
                    <label for="vehicle_transport" class="form-label">
                      Vehicle a disposició
                    </label>
                    <select class="form-select" id="vehicle_transport" name="vehicle_transport">
                      <option value="0">-</option>
                      <?php
                      $sql_vehicles = "SELECT * FROM vehicles_transport ORDER BY vehicle DESC";
                      $result_vehicles = $connexio->query($sql_vehicles);

                      while ($row_vehicles = $result_vehicles->fetch_assoc()) {
                        echo "<option value='" . $row_vehicles["id"] . "'>" . $row_vehicles["vehicle"] . "</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-12 py-2">
                    <input type="submit" class="btn boto_marro" value="Editar activitat" name="update_act">
                  </div>

                </div>
              </div>
            </form>

            <p>
              Qui s'ha apuntat a l'activitat?
              <?php echo "<a href='detall_activitat_participants_voluntaris.php?id=" . $_GET["id"] . "'>Visualitza aquí.</a>"; ?>

            </p>

            <?php

          } else {

            ?>
            <div class="card mb-3">
              <img class="card-img-top" src="imatges/activitats/<?php echo $row['imatge'] ?>" title="<?php echo $row['nom'] ?>" alt="<?php echo $row['nom'] ?>" height="400" >
              <div class="card-body">
                <h3 class="card-title">
                  <?php echo $row['nom'] ?>
                </h3>
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
                  Ubicació de l'activitat: <?php echo $row['ubicacio'] . "."; ?>
                </p>
                <p class="card-text">
                  Descripció de l'activitat: <br><?php echo "- " . $row['descripcio']; ?>
                </p>
                <p class="card-text">
                  Participants de l'activitat: <?php echo $row['participants'] . "."; ?>
                </p>
                <p class="card-text">
                  Participants disponibles: <?php echo $row['participants_disponibles'] . "."; ?>
                </p>
                <p class="card-text">
                  Dia i hora: <?php echo $row['dia'] . " " . $row['hora'] . "."; ?>
                </p>
                <p class="card-text">
                  Preu:
                  <?php
                  if ($row['preu'] == 0) {
                    echo "Activitat gratuïta.";
                  } else {
                    echo $row['preu'] . "€.";
                  }
                  ?>
                </p>
                <p class="card-text">
                  L'activitat té transport:
                  <?php
                  if ($row['transport'] == 0) {
                    echo "No.";
                  } else {
                    echo "Sí.";
                    echo "<p>Lloc de sortida: " . $row["lloc_sortida_transport"] . "</p>";
                    $sql_id_vehicles = "SELECT * FROM vehicles_transport WHERE id = " . $row["id_vehicle_transport"];
                    $result_id_vehicles = $connexio->query($sql_id_vehicles);

                    while ($row_id_vehicles = $result_id_vehicles->fetch_assoc()) {
                      echo "<p>Transport: " . $row_id_vehicles["vehicle"] . ".</p>";
                    }
                  }
                  ?>
                </p>
                <p class="card-text">
                  Voluntaris disponibles: <?php echo $row['voluntaris_disponibles'] . "."; ?>
                </p>

                <?php
                $data_ara = date("Y-m-d"); // data d'ara mateix

                if ($row['dia'] >= $data_ara) { // si dia és més gran o igual que la data actual fa aquesta condició
                  $sql_buscar_si_existeix = "SELECT * FROM participants_apuntats WHERE id_usuari = " . $_SESSION['id_usuari_sessio'] . " AND id_activitat = " . $id_activitat_buscada;
                  $resultat_buscar_si_existeix = $connexio->query($sql_buscar_si_existeix);

                  if ($resultat_buscar_si_existeix->num_rows > 0) {
                    echo "<div style='background-color: #dbbba6'>";
                      echo "<h5 style='padding: 1%'>Ja t'has registrat a aquesta activitat.</h5>";
                    echo "</div>";

                  } else {

                    ?>
                    <hr>

                    <form action="detall_activitat.php?id=<?php echo $id_activitat_buscada ?>" method="post" class="row g-3 py-4">
                      <input type="hidden" name="id_act_registrat" value="<?php echo $id_activitat_buscada ?>">

                      <div class="col-md-2">
                        <label for="participants" class="form-label">Participants a apuntar:</label>
                        <input type="number" class="form-control" id="participants" name="participants_act_registrat" required min="1" max="<?php echo $row['participants_disponibles'] ?>">
                      </div>

                      <?php
                      if ($row["transport"] > 0) {
                        ?>
                        <div class="col-md-12 ">
                          <input class="form-check-input" type="checkbox" name="transport_act_registrat" id="transport" value="1">
                          <label class="form-check-label" for="transport">
                            Sí necessito transport.
                          </label>
                        </div>
                        <?php
                      }
                      ?>

                      <div class="col-md-12">
                        <input type="submit" value="Apuntar" class="boto_marro btn" name="registrar_activitat">
                      </div>
                    </form>
                    <?php

                  }

                } else {
                  ?>
                  <h5 class="card-text text-muted text-center">
                    No es pot apuntar a l'activitat. Ja ha vençut.
                  </h5>
                  <?php
                }

                ?>
              </div>
            </div>
            <?php

          }

        }

      }

    } else {
      echo "<div class='alert alert-danger' role='alert'>No hi ha cap activitat amb aquesta id: " . $id_activitat_buscada . "</div>";
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
