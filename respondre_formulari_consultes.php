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
        if (isset($_SESSION["id_usuari_sessio"])) {
          $sessio = $_SESSION["id_usuari_sessio"];
          $sql_admin = "SELECT * FROM usuari WHERE es_admin > 0 AND id = '$sessio'";
          $resultat_admin = $connexio->query($sql_admin);

          if ($resultat_admin->num_rows > 0) {
            ?>
            <h3>Respondre les consultes dels usuaris</h3>

            <?php
              if (isset($_POST["respondre"])) {
                $id_consulta = $_POST["id_consulta"];
                $consulta_usuari = $_POST["consulta_usuari"];
                $admin = $_SESSION['id_usuari_sessio'];
                $dia = date("Y-m-d");
                $hora = date('H:i:s');

                $sql_afegir = "INSERT INTO resposta_formulari_consultes (id_consulta, id_admin_resposta, resposta, dia, hora)
                                      VALUES (:id_consulta, :id_admin_resposta, :resposta, :dia, :hora)";
                $resultat = $connexio_PDO->prepare($sql_afegir);

                $resultat->execute(array(
                    ":id_consulta" => $id_consulta,
                    ":id_admin_resposta" => $admin,
                    ":resposta" => $consulta_usuari,
                    ":dia" => $dia,
                    ":hora" => $hora
                  )
                );

                echo "<div class='alert alert-success' role='alert'>Respost correctament.</div>";
              }
            ?>

            <div class="py-4">
              <?php
              $sql_consulta = "SELECT * FROM formulari_consultes ORDER BY dia DESC";
              $resultat_consulta = $connexio->query($sql_consulta);

              if ($resultat_consulta->num_rows > 0) {
                $num = 1;

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
                        $sql_usuari_consulta = "SELECT * FROM usuari WHERE id=" . $row_consulta["id_usuari"];
                        $resultat_usuari_consulta = $connexio->query($sql_usuari_consulta);

                        while ($row_usuari_consulta = $resultat_usuari_consulta->fetch_assoc()) {
                          echo "Usuàri/a: " . $row_usuari_consulta["nom"] . " (" . $row_usuari_consulta["email"] . ")";
                        }
                        ?>
                      </p>
                      <p class="card-text text-muted">
                        <?php
                        $data_convertida = date("d-m-Y", strtotime($row_consulta["dia"]));
                        $hora_convertida = date("g:ia", strtotime($row_consulta["hora"]));
                        echo "Dia i hora de la consulta: " . $data_convertida . " " . $hora_convertida;
                        ?>
                      </p>

                      <hr>

                      <p class="card-text">Resposta:</p>

                      <?php
                      $sql_resposta = "SELECT * FROM resposta_formulari_consultes WHERE id_consulta = " . $row_consulta["id"];
                      $resultat_resposta = $connexio->query($sql_resposta);

                      if ($resultat_resposta->num_rows > 0) {
                        while ($row_consulta = $resultat_resposta->fetch_assoc()) {
                          echo "<p class='card-text'>- " . $row_consulta["resposta"] . "</p>";

                          $data_convertida = date("d-m-Y", strtotime($row_consulta["dia"]));
                          $hora_convertida = date("g:ia", strtotime($row_consulta["hora"]));
                          echo "<p class='card-text text-muted'>Dia i hora de la resposta: " . $data_convertida . " " . $hora_convertida . "</p>";
                        }
                      } else {
                        ?>
                        <form class="row g-3" action="respondre_formulari_consultes.php" method="post">
                          <input type="hidden" name="id_consulta" value="<?php echo $row_consulta['id'] ?>">

                          <div class="col-md-12">
                            <label for="consulta" class="form-label">Escriu la resposta</label>
                            <textarea name="consulta_usuari" id="consulta" rows="3" required maxlength="350" class="form-control"></textarea>
                          </div>

                          <div class="col-12">
                            <input type="submit" class="btn boto_marro" value="Enviar" name="respondre">
                          </div>
                        </form>
                        <?php
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
            ?>
            <h2>No té permisos per visualitzar la pàgina</h2>
            <p>Torna a la pàgina principal.</p>
            <a class="boto_marro btn" href="index.php">Pàgina inicial</a>
            <?php
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
