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
        <h3>Administrar pàgina "Qui som?"</h3>
        <p>Aquí es mostra el text que es visualitza a la pàgina "Qui som?".</p>

        <?php
          if (isset($_POST["submit"])) {
            $quisom = $_POST["quisom"];
            $sessions = $_SESSION['id_usuari_sessio'];

            $sql_update = "UPDATE qui_som SET text=?, id_persona=? WHERE id=1";
            $resultat_update = $connexio_PDO->prepare($sql_update);

            $resultat_update->execute([ $quisom , $sessions ]);

            echo "<div class='alert alert-success' role='alert'>Editat correctament.</div>";
          }
        ?>

        <form action="admin_qui_som.php" method="post" class="row g-3">
          <div class="col-12">
            <label for="quisom" class="form-label">
              Descripció
              <span class="text-muted" id="max_paraules">[Màxim de lletres: 650]</span>
            </label>

            <?php
            $sql_qui_som = "SELECT * FROM qui_som";
            $resultat_qui_som = $connexio->query($sql_qui_som);

            if ($resultat_qui_som->num_rows > 0) {
              while ($row_qui_som = $resultat_qui_som->fetch_assoc()) {
                ?>
                <textarea name="quisom" rows="8" class="form-control" maxlength="650" required><?php echo $row_qui_som["text"]; ?></textarea>
                <?php

                $sql_usuari = "SELECT * FROM usuari WHERE id = " . $row_qui_som["id_persona"];
                $resultat_usuari = $connexio->query($sql_usuari);

                while ($row_usuari = $resultat_usuari->fetch_assoc()) {
                  echo "<p class='text-muted'>Últim usuari que va editar la pàgina: " . $row_usuari["nom"] . "</p>";
                }
              }
            }
            ?>
          </div>

          <div class="col-12">
            <input type="submit" class="btn boto_marro" value="Editar" name="submit">
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
