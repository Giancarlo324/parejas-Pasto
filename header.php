<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
   <a class="navbar-brand" href="/final_seminario">Inicio</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
         <?php
         if (!isset($_SESSION['username'])) :
         ?>
            <a class="nav-item nav-link active" href="/final_seminario/login.php">Iniciar Sesión</a>
            <a class="nav-item nav-link active" href="/final_seminario/register.php">Registrarse</a>
         <?php
         endif;
         if (isset($_SESSION['username'])) :
         ?>
            <a class="nav-item nav-link active" href="/final_seminario/encuentra_pareja.php">Encontrar pareja</a>
            <a class="nav-item nav-link active" href="/final_seminario/a_quien_le_gusto.php">A quien le gusto</a>
            <a class="nav-item nav-link active" href="/final_seminario/perfil.php">Ver mi perfil</a>
            <a class="nav-item nav-link active" href="modificarPerfil.php?id=<?php echo $_SESSION['id']; ?>">Actualizar mis datos</a>
            <a class="nav-item nav-link active" href="logout.php">Cerrar sesión</a>
         <?php
         endif;
         ?>
      </div>
   </div>
</nav>