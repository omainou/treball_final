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
          if (isset($_SESSION['id_usuari_sessio'])) {
            ?>
            <h3>Consultes personals dels usuaris</h3>

            <?php
              if (isset($_POST["enviar"])) {
                $consulta_usuari = $_POST["consulta_usuari"];
                $dia = date("Y-m-d");
                $hora = date('H:i:s');
                $id_persona = $_SESSION['id_usuari_sessio'];

                $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connexio_PDO->exec("SET CHARACTER SET utf8");

                $sql_afegir = "INSERT INTO formulari_consultes (id_usuari, pregunta, dia, hora)
                                        VALUES (:id_usuari, :pregunta, :dia, :hora)";
                $resultat = $connexio_PDO->prepare($sql_afegir);

                $resultat->execute(array(
                    ":id_usuari" => $id_persona,
                    ":pregunta" => $consulta_usuari,
                    ":dia" => $dia,
                    ":hora" => $hora
                  )
                );

                echo "<div class='alert alert-success' role='alert'>Consulta realitzada correctament.</div>";

              }
            ?>

            <div class="py-2">
              <form method="post" class="row g-3" action="formulari_consultes.php">
                <div class="col-md-12">
                  <label for="consulta" class="form-label">Escriu la consulta</label>
                  <textarea name="consulta_usuari" id="consulta" rows="4" autofocus required maxlength="300" class="form-control"></textarea>
                </div>

                <div class="col-12">
                  <input type="submit" class="btn boto_marro" value="Enviar" name="enviar">
                </div>
              </form>
            </div>

            <div class="py-2">
              <?php
              $usuari = $_SESSION['id_usuari_sessio'];
              $sql_consulta = "SELECT * FROM formulari_consultes WHERE id_usuari='$usuari' ORDER BY dia DESC";
              $resultat_consulta = $connexio->query($sql_consulta);

              if ($resultat_consulta->num_rows > 0) {
                $num = 1;
                echo "<hr>";

                while ($row_consulta = $resultat_consulta->fetch_assoc()) {
                  ?>
                  <div class="card text-bg-light mb-3">
                    <div class="card-body">
                      <h5 class="card-title">Consulta <?php echo $num; ?>:</h5>

                      <p class="card-text">
                        <?php echo $row_consulta["pregunta"]; ?>
                      </p>
                      <p class="card-text text-muted">
                        <?php
                        $data_convertida = date("d-m-Y", strtotime($row_consulta["dia"]));
                        $hora_convertida = date("g:ia", strtotime($row_consulta["hora"]));
                        echo "Dia i hora de la consulta: " . $data_convertida . " " . $hora_convertida;
                        ?>
                      </p>

                      <?php
                      $sql_resp_consulta = "SELECT * FROM resposta_formulari_consultes WHERE id_consulta=" . $row_consulta["id"];
                      $resultat_resp_consulta = $connexio->query($sql_resp_consulta);

                      if ($resultat_resp_consulta->num_rows > 0) {
                        echo "<hr>";

                        while ($row_resp_consulta = $resultat_resp_consulta->fetch_assoc()) {
                          echo "<p class='card-text'>Resposta:</p>";
                          echo "<p class='card-text'>- " . $row_resp_consulta["resposta"] . "</p>";
                          echo "<p class='card-text text-muted'>Dia i hora de la resposta: " . date("d-m-Y", strtotime($row_resp_consulta["dia"])) . " " . date("g:ia", strtotime($row_resp_consulta["hora"])) . " </p>";
                        }
                      }
                      ?>

                    </div>
                  </div>
                  <?php
                  $num++;

                }
              }
              ?>
            </div>
            
            <?php
          } else {
            header ("Location: index.php");
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
