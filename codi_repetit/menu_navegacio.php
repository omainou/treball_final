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
                    <a class="dropdown-item" href="#">Voluntariat</a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="articles_opinions.php">Opinions</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="contacte.php">Contacte</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="iniciar_sessio_usuari.php">Iniciar sessió</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" href="registrar_usuari.php">Registrar-me</a>
              </li>

            </ul>

          </div>

        </div>

      </nav>
    <?php
  }

?>
