<!-- Header -->
<section id="header">
   <div class="container">

      <!-- Logo -->
      <h1 id="logo"><a href="/final_seminario">Encuentra Pareja Pasto</a></h1>
      <p>Si estás solo, si estás de visita, ten un encuentro casual y disfruta del momento...</p>

      <!-- Nav -->
      <nav id="nav">
         <ul>
            <?php
            if (!isset($_SESSION['username'])) :
            ?>
               <li><a class="icon solid fa-sign-in-alt" href="login.php"><span>Iniciar Sesión</span></a></li>
               <li><a class="icon solid fa-user-plus" href="register.php"><span>Registrarse</span></a></li>
            <?php
            endif;
            if (isset($_SESSION['username'])) :
            ?>
               <li><a class="icon solid fa-heart" href="encuentra_pareja.php"><span>Encontrar pareja</span></a></li>
               <li><a class="icon solid fa-grin-hearts" href="quien_me_gusta.php"><span>Mis gustos</span></a></li>
               <li><a class="icon solid fa-fire" href="a_quien_le_gusto.php"><span>A quien le gusto</span></a></li>
               <li><a class="icon solid fa-database" href="modificarPerfil.php?id=<?php echo $_SESSION['id']; ?>"><span>Actualizar datos</span></a></li>
               <li><a class="icon solid fa-sign-out-alt" href="logout.php"><span>Cerrar sesión</span></a></li>
            <?php
            endif;
            ?>
         </ul>
      </nav>
   </div>
</section>