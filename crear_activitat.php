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
    <section id="formulari_crear_activitat">
      <?php
      if (isset($_SESSION["id_usuari_sessio"])) {
        ?>
        <div class="container">
          <?php
          if (isset($_POST["submit"])) {
            $nom = $_POST["nom"];
            $ubicacio = $_POST["ubicacio"];
            $descripcio = $_POST["descripcio"];
            $arxiu = $_FILES['img']['name'];
            $participants = $_POST["participants"];
            $dia = $_POST["dia"];
            $hora = $_POST["hora"];
            $preu = $_POST["preu"];
            $voluntaris = $_POST["voluntaris"];
            $transport = $_POST["transport"];
            $transport_sortida = $_POST["transport_sortida"];
            $vehicle_transport = $_POST["vehicle_transport"];
            $id_usuari_sessio = $_SESSION["id_usuari_sessio"];

            if ($_FILES['img']["error"] > 0) {
              ?>
              <div class="alert alert-danger" role="alert">
                Error a l'omplir el formulari. Prova-ho de nou.
              </div>
              <?php
            } else {
              $img_nova = rand(0, 10000) . "_" . $arxiu;
              move_uploaded_file($_FILES['img']['tmp_name'], "imatges/activitats/" . $img_nova);

              $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $connexio_PDO->exec("SET CHARACTER SET utf8");

              $sql_afegir_activitat = "INSERT INTO activitat (nom, id_usuari, ubicacio, descripcio, participants, participants_disponibles, dia, hora, preu, imatge, transport, lloc_sortida_transport, id_vehicle_transport, voluntaris, voluntaris_disponibles, esta_acceptada)
                                          VALUES (:nom, :id_usuari, :ubicacio, :descripcio, :participants, :participants_disponibles, :dia, :hora, :preu, :imatge, :transport, :lloc_sortida_transport, :vehicle_transport, :voluntaris, :voluntaris_disponibles, 0)";
              $resultat = $connexio_PDO->prepare($sql_afegir_activitat);

              $resultat->execute(array(
                ":nom" => $nom,
                ":id_usuari" => $id_usuari_sessio,
                ":ubicacio" => $ubicacio,
                ":descripcio" => $descripcio,
                ":participants" => $participants,
                ":participants_disponibles" => $participants,
                ":dia" => $dia,
                ":hora" => $hora,
                ":preu" => $preu,
                ":imatge" => $img_nova,
                ":transport" => $transport,
                ":lloc_sortida_transport" => $transport_sortida,
                ":vehicle_transport" => $vehicle_transport,
                ":voluntaris" => $voluntaris,
                ":voluntaris_disponibles" => $voluntaris
              )
            );

            echo "<div class='alert alert-success'  role='alert'>Activitat creada correctament. Ara l'administrador l'ha de validar.</div>";
          }
        }
        ?>

        <h3>Crear activitat</h3>
        <h6 class=" text-danger">* Camps obligatoris</h6>

        <div class="py-4">
          <form class="row g-3" method="post" action="crear_activitat.php" enctype="multipart/form-data">
            <div class="col-md-6">
              <label for="nom_activitat" class="form-label">
                Nom de l'activitat
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="nom_activitat" name="nom" required>
            </div>
            <div class="col-md-6">
              <label for="ubi" class="form-label">
                Ubicació
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="ubi" name="ubicacio" required>
            </div>
            <div class="col-12">
              <label for="descripcio" class="form-label">
                Descripció
                <span class="text-muted" id="max_paraules">[Màxim de lletres: 300]</span>
                <span class="text-danger">*</span>
              </label>
              <textarea name="descripcio" id="descripcio" rows="5" class="form-control" maxlength="300" required></textarea>
            </div>
            <div class="col-md-6">
              <label for="img" class="form-label">
                Imatge de l'activitat
                <span class="text-danger">*</span>
              </label>
              <input type="file" class="form-control" id="img" name="img" required>
            </div>
            <div class="col-md-6">
              <label for="participants" class="form-label">
                Participants
                <span class="text-danger">*</span>
              </label>
              <input type="number" class="form-control" id="participants" name="participants" min="1" required>
            </div>
            <div class="col-md-6">
              <?php $dia_actual = date("Y-m-d"); ?>
              <label for="dia" class="form-label">
                Dia de l'activitat
                <span class="text-danger">*</span>
              </label>
              <input type="date" class="form-control" id="dia" name="dia" required min="<?php echo $dia_actual ?>">
            </div>
            <div class="col-md-6">
              <label for="hora" class="form-label">
                Hora programada
                <span class="text-danger">*</span>
              </label>
              <input type="time" class="form-control" id="hora" name="hora" required>
            </div>
            <div class="col-md-6">
              <label for="preu" class="form-label">
                Preu de l'activitat
                <span class="text-danger">*</span>
              </label>
              <input type="number" class="form-control" id="preu" name="preu" min="0" required>
            </div>
            <div class="col-md-6">
              <label for="voluntaris" class="form-label">
                Nombre de voluntaris necessaris
                <span class="text-danger">*</span>
              </label>
              <input type="number" class="form-control" id="voluntaris" required min="0" name="voluntaris">
            </div>
            <div class="col-md-4">
              <label for="transport" class="form-label">
                L'activitat té transport?
                <span class="text-danger">*</span>
              </label>
              <select class="form-select" id="transport" name="transport" required>
                <option value="1">Sí.</option>
                <option value="0">No.</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="transport_sortida" class="form-label">En cas afirmatiu, des d'on surt?</label>
              <input type="text" class="form-control" id="transport_sortida" name="transport_sortida">
            </div>
            <div class="col-md-4">
              <label for="vehicles" class="form-label">Vehicle a disposició</label>
              <select class="form-select" id="vehicles" name="vehicle_transport">
                <option value="-">-</option>
                <?php
                $sql_vehicles = "SELECT * FROM vehicles_transport ORDER BY vehicle DESC";
                $result_vehicles = $connexio->query($sql_vehicles);

                while ($row_vehicles = $result_vehicles->fetch_assoc()) {
                  echo "<option value='" . $row_vehicles["id"] . "'>" . $row_vehicles["vehicle"] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="accepto" name="accepto" required>
                <label class="form-check-label" for="accepto">
                  Crear activitat amb les dades afegides
                  <span class="text-danger">*</span>
                </label>
              </div>
            </div>
            <div class="col-12">
              <input type="submit" class="btn boto_marro" value="Crear activitat" name="submit">
            </div>
          </form>
        </div>
      </div>
      <?php

    } else {
      no_ha_iniciat_sessio();
    }
    ?>
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
