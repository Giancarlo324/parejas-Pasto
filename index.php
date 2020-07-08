<?php
include('sesion.php');
?>
<!DOCTYPE html>
<html>

<head>
   <?php
   include "head.html";
   ?>
</head>

<body class="homepage is-preload">
   <div id="page-wrapper">
      <?php
      include "header.php";
      ?>
      <!-- Banner -->
      <section id="banner">
         <div class="container">
            <p>Diviértete <strong>conociendo personas</strong>.<br />
               Y posiblemente... Encontrando el amor!</p>
         </div>
      </section>
      <!-- Main -->
      <section id="main">
         <div class="container">
            <div class="row">
               <article class="box post">
                  <img src="images/pasos.png" class="responsive" />
               </article>

               <!-- Content -->
               <div id="content" class="col-8 col-12-medium">

                  <!-- Post -->
                  <article class="box post">
                     <header>
                        <h2><strong>¿</strong>Cómo funciona la búsqueda de pareja<strong>?</strong><br />
                        </h2>
                     </header>
                     <img src="images/pic05.jpg" alt="" class="responsive" />
                     <h3>¡Cuenta quién eres!</h3>
                     <p>Habla sobre ti. actua con naturalidad, sinceridad y espontaneidad.
                        Unas cuantas líneas son suficientes para causar una buena impresión.
                        ¿Por qué no añadir también un toque de humor?

                        Comparte tres de tus fotos. Crea un álbum que refleje tu personalidad.</p>
                  </article>

                  <!-- Post -->
                  <article class="box post">
                     <header>
                        <img src="images/pic052.jpg" alt="" class="responsive" />
                        <h2>Encuentra a la persona que estás <strong>buscando</strong></h2>
                     </header>
                     <h3>Conoce como son las personas</h3>
                     <p>Encuentra a la persona realmente adecuada para ti gracias a la búsqueda detallada.

                        ¡Conoce a otros/as solteros/as en nuestro gran sitio!
                        Encontrarás a personas de acuerdo a tu interés.
                     </p>
                  </article>

                  <!-- Post -->
                  <article class="box post">
                     <header>
                        <img src="images/pic053.jpg" alt="" class="responsive" />
                        <h2><strong>Contacta</strong></h2>
                     </header>
                     <h3>¿No sabes cómo empezar una conversación?</h3>
                     <p>¿No sabes cómo empezar una conversación?

                        Una buena forma de romper el hielo es hablar sobre los detalles que te atrajeron
                        de su perfil o de cosas que tengas en común.

                        O compartir un enlace de una canción o un GIF. ¡Atrevete!
                     </p>
                  </article>

               </div>

            </div>
         </div>
      </section>
      <?php
      include "footer_content.html";
      include "footer.php";
      ?>
   </div>
</body>

</html>