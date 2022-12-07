<?php

  function menu_navegacio() {
    ?>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a id="ailled" href="index.php">Ailled</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_menu_navegacio">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav_menu_navegacio">
          <ul class="navbar-nav ms-md-auto" id="menu_principal">
            <li class="nav-item">
              <a class="nav-link active" href="quisom.php">Qui som?</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">Activitats</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="activitats.php">Activitats d'AILLED</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item" href="crear_activitat.php">Crear activitats</a>
                </li>
                <li>
                  <a class="dropdown-item" href="activitats_apuntades.php">Activitats apuntades</a>
                </li>
                <li>
                  <a class="dropdown-item" href="meves_activitats.php">Les meves activitats</a>
                </li>
                <li>
                  <a class="dropdown-item" href="voluntariat.php">Voluntariat</a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link active" href="articles_opinions.php">Opinions</a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" href="contacte.php">Contacte</a>
            </li>

            <?php
            if (!isset($_SESSION['id_usuari_sessio'])) {

              ?>
              <li class="nav-item">
                <a class="nav-link active" href="iniciar_sessio_usuari.php">Iniciar sessió</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="registrar_usuari.php">Registrar-me</a>
              </li>
              <?php

            } else {

              ?>
              <li class="nav-item dropdown">
                <a style="font-weight: bold;" class="nav-link active dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php
                  $connexio = new mysqli("localhost", "root", "", "bbdd_ailled");
                  $connexio->set_charset("utf8");

                  $sql = "SELECT * FROM usuari WHERE id = " . $_SESSION['id_usuari_sessio'] ;
                  $result = $connexio->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo $row["nom"];
                    }
                  }
                  ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" id="menu_secundari" aria-labelledby="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="perfil.php">El meu perfil</a>
                  </li>

                  <li>
                    <hr class="dropdown-divider">
                  </li>

                  <?php
                  if (isset($_SESSION["id_usuari_sessio"])) {
                    $sql2 = "SELECT * FROM usuari WHERE id = " . $_SESSION['id_usuari_sessio'];
                    $resultat2 = $connexio->query($sql2);

                    while ($row2 = $resultat2->fetch_assoc()) {
                      if ($row2["es_admin"] > 0) {
                        ?>
                        <li>
                          <a class="dropdown-item" href="admin_qui_som.php">Administrar "Qui som?"</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="admin_usuaris_registrats.php">Usuaris registrats</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="admin_acceptar_activitats.php">Acceptar activitats</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="admin_usuaris_apuntats_activitats.php">Usuaris apuntats</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="admin_activitats_assistides_usuaris.php">Activitats assistides</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="admin_vehicles_transport.php">Vehicles de transport</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="admin_newsletter.php">Newsletter</a>
                        </li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <?php
                      }
                    }
                  }
                  ?>

                  <li>
                    <form action="servidor/tancar_sessio.php" method="post">
                      <input class="dropdown-item" type="submit" name="logout" value="Tancar sessió">
                    </form>

                  </li>
                </ul>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <?php
  }

?>
