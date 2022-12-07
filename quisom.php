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
    <section id="quisom">
      <div class="container">
        <h3>Qui som?</h3>

        <article>
          <?php
          $sql_qui_som = "SELECT * FROM qui_som";
          $resultat_qui_som = $connexio->query($sql_qui_som);

          if ($resultat_qui_som->num_rows > 0) {
            while ($row_qui_som = $resultat_qui_som->fetch_assoc()) {
              echo "<p>" . $row_qui_som["text"] . "</p>";
            }
          }
          ?>
        </article>

        <hr>

        <article>
          <div class="row row-cols-1 row-cols-md-2 g-4" id="imatges">
            <?php
              $sqlImg = "SELECT imatge FROM activitat order by RAND() LIMIT 2";
              $resultatImg = $connexio->query($sqlImg);

              if ($resultatImg->num_rows > 0) {
                while($rowImg = $resultatImg->fetch_assoc()) {
                  echo "<div class='col'>";
                    echo "<img src='imatges/activitats/" . $rowImg["imatge"] . "' class='card-img-top' alt='Imatge activitats'>";
                  echo "</div>";
                }
              }
            ?>
          </div>
        </article>
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
