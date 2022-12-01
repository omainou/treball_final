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

    <section id="contacte">
      <div class="container">
        <h3>On estem ubicats?</h3>

        <div class="row pt-5">
          <div class="col-md-4">
            <p>AILLED</p>
            <p>Adreça: Av. Mare de Déu de Lorda, 40</p>
            <p>Localitat: 08034 Barcelona</p>
            <p>Número de contacte: 93444110</p>
            <p>Correu de contacte: info@ailled.cat</p>
          </div>

          <div class="col-md-4 ml-auto">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1496.444075667167!2d2.105171883524057!3d41.39823532011394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4984b3664115f%3A0xfd3238a51e4865db!2sAv.%20Mare%20de%20D%C3%A9u%20de%20Lorda%2C%2040%2C%2008034%20Barcelona!5e0!3m2!1ses!2ses!4v1651254694924!5m2!1ses!2ses" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
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
