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
        <h3>Articles d'opinions</h3>

        <?php
        if (isset($_POST["eliminar_article"])) {
          $id_article = $_POST["id_article"];

          $sql_delete_article = "DELETE FROM opinio WHERE id=?";
          $resultat_delete_article = $connexio_PDO->prepare($sql_delete_article);
          $resultat_delete_article->execute([ $id_article ]);

          echo "<div class='alert alert-success' role='alert'>Article eliminat correctament.</div>";
        }

        // MITJA DE LES VALORACIONS DELS USUARIS
        $sql_mitja = "SELECT AVG(valoracio) FROM opinio";
        $resultat_mitja = $connexio->query($sql_mitja);

        while ($row_mitja = mysqli_fetch_array($resultat_mitja)) {
          echo "<h5>Valoracions dels usuaris: " . round($row_mitja["AVG(valoracio)"]) . " sobre 5.</h5>";
        }

        if (isset($_SESSION["id_usuari_sessio"])) {
          ?>
          <a href="crear_article_opinio.php" class="boto_marro btn">Crear article</a>
          <?php
        }
        ?>

        <div style="padding: 2% 0">
          <?php
          // OPINIONS DELS USUARIS
          $sql_opinio = "SELECT * FROM opinio ORDER BY dia";
          $resultat_opinio = $connexio->query($sql_opinio);

          if ($resultat_opinio->num_rows > 0) {
            while ($row_opinio = $resultat_opinio->fetch_assoc()) {
              ?>
              <div class="card bg-light mb-4 py-2">
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo $row_opinio["titol"] ?>
                  </h5>
                  <p class="card-text">
                    Usuàri/a:
                    <?php
                    $sql_usuari = "SELECT * FROM usuari WHERE id = " . $row_opinio["id_usuari"];
                    $resultat_usuari = $connexio->query($sql_usuari);

                    while ($row_usuari = $resultat_usuari->fetch_assoc()) {
                      echo $row_usuari["nom"];
                    }
                    ?>
                  </p>
                  <p class="card-text">
                    Activitat realitzada:
                    <?php
                    $sql_usuari = "SELECT * FROM activitat WHERE id = " . $row_opinio["id_activitat"];
                    $resultat_usuari = $connexio->query($sql_usuari);

                    while ($row_usuari = $resultat_usuari->fetch_assoc()) {
                      echo $row_usuari["nom"];
                    }
                    ?>
                  </p>
                  <p class="card-text">
                    - <?php echo $row_opinio["descripcio"] ?>
                  </p>
                  <p class="card-text">
                    Dia:
                    <?php
                    $data_convertida = date("d-m-Y", strtotime($row_opinio["dia"]));
                    echo $data_convertida;
                    ?>
                  </p>
                  <p class="card-text">
                    Valoració: (1 min / 5 max)
                  </p>
                  <input type="range" id="range" disabled value="<?php echo $row_opinio["valoracio"] ?>" min="1" max="5">

                  <?php
                  if (isset($_SESSION["id_usuari_sessio"])) {
                    if ($row_opinio["id_usuari"] == $_SESSION["id_usuari_sessio"]) {
                      ?>
                      <form action="articles_opinions.php" method="post" class="py-1">
                        <input type="hidden" name="id_article" value="<?php echo $row_opinio["id"] ?>">
                        <input type="submit" value="Eliminar" class="btn btn-danger" name="eliminar_article">
                      </form>
                      <?php
                    }
                  }
                  ?>
                </div>
              </div>
              <?php
            }
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
