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
          if (isset($_POST["submit_article"])) {
            $titol_article = $_POST["titol_article"];
            $descripcio_article = $_POST["descripcio_article"];
            $activitat_article = $_POST["activitat_article"];
            $valorar_article = $_POST["valorar_article"];

            $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexio_PDO->exec("SET CHARACTER SET utf8");

            $sql_afegir_article = "INSERT INTO opinio (id_usuari, id_activitat, titol, descripcio, valoracio, dia)
                                    VALUES (:id_usuari, :activitat_article, :titol_article, :descripcio_article, :valorar_article, :dia)";
            $resultat_afegir_article = $connexio_PDO->prepare($sql_afegir_article);

            $resultat_afegir_article->execute(array(
              ":titol_article" => $titol_article,
              ":id_usuari" => $_SESSION['id_usuari_sessio'],
              ":descripcio_article" => $descripcio_article,
              ":activitat_article" => $activitat_article,
              ":valorar_article" => $valorar_article,
              ":dia" => date("Y-m-d")
            )
          );

          echo "<div class='alert alert-success'  role='alert'>Artícle creat correctament.</div>";
        }
        ?>

        <h3>Crear article d'opinió</h3>
        <p>A través d'aquest formulari pots valorar l'activitat realitzada.</p>
        <h6 class=" text-danger">* Camps obligatoris</h6>

        <div class="py-4">
          <form class="row g-3" method="post" action="crear_article_opinio.php" enctype="multipart/form-data">
            <div class="col-md-12">
              <label for="titol_article" class="form-label">
                Títol de l'article
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="titol_article" name="titol_article" required>
            </div>

            <div class="col-12">
              <label for="descripcio" class="form-label">
                Descripció
                <span class="text-muted" id="max_paraules">[Màxim de paraules: 300]</span>
                <span class="text-danger">*</span>
              </label>
              <textarea name="descripcio_article" id="descripcio" rows="5" class="form-control" maxlength="300" required></textarea>
            </div>

            <div class="col-md-6">
              <label for="activitat" class="form-label">
                Activitat a valorar
                <span class="text-danger">*</span>
              </label>
              <select id="activitat" name="activitat_article" class="form-select">
                <?php
                $dia_avui = date("Y-m-d");

                $sql_select_act = "SELECT * FROM activitat WHERE dia <= '$dia_avui' ORDER BY nom ASC";
                $result_select_act = $connexio->query($sql_select_act);

                while ($row_select_opinio = $result_select_act->fetch_assoc()) {
                  $dia = date("d-m-Y", strtotime($row_select_opinio["dia"]));
                  echo "<option value='" . $row_select_opinio["id"] . "'>" . $row_select_opinio["nom"] . " (" . $dia . ")</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="valorar" class="form-label">
                Valoració de l'article (1 min / 5 màx)
                <span class="text-danger">*</span>
              </label>
              <input type="range" class="form-range" id="valorar" name="valorar_article" min="1" max="5" required>
            </div>

            <div class="col-12">
              <input type="submit" class="btn boto_marro" value="Crear opinió" name="submit_article">
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
