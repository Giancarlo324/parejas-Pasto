<?php
include('sesion.php');
if (!isset($_SESSION['id'])) {
   header('location: login.php');
}
?>
<!DOCTYPE html>
<html>

<?php
include "head.html";
?>

<body class="homepage is-preload">
   <?php
   include "header.php";
   ?>
   <div class="page-wrapper">
      <?php
      if ($conexion) {
         if (!$_GET) header('Location:index.php');
      ?>
         <?php
         $miId = $_SESSION['id'];
         if(isset($_GET['idGusta'])){
            $quienId = $_GET['idGusta'];
            // Verificar si a esta persona le ha dado me gusta.
            $misGutos2 = "SELECT Nombre, Apellido, foto1, foto2, foto3, Celular, email, Interes, Nacimiento, Escuela, Sobre_ti FROM usuario INNER JOIN megusta ON usuario.id = megusta.quien_gusta WHERE id_usuario = ? and quien_gusta = ? and quien_gusta is not NULL";
         }
         if(isset($_GET['idQuienGusta'])){
            $quienId = $_GET['idQuienGusta'];
            $misGutos2 = "SELECT Nombre, Apellido, foto1, foto2, foto3, Celular, email, Interes, Nacimiento, Escuela, Sobre_ti FROM usuario INNER JOIN megusta ON usuario.id = megusta.id_usuario WHERE quien_gusta = ? and quien_gusta = ? and quien_gusta is not NULL";
         }
         $sqlVerificar = $conexion->prepare($misGutos2);
         $sqlVerificar->bind_param('ii', $miId, $quienId);
         $sqlVerificar->execute();
         $resulta = $sqlVerificar->get_result();

         if ($sqlVerificar) {
            while ($fila = mysqli_fetch_assoc($resulta)) {
         ?>
               <!-- Features -->
               <section id="features">
                  <div class="container">
                     <header>
                        <h2>Perfil de <strong><?php echo $fila['Nombre']; ?> <?php echo $fila['Apellido']; ?></strong></h2>
                     </header>
                     <div class="row aln-center">
                        <div class="col-4 col-6-medium col-12-small">

                           <!-- Feature -->
                           <section>
                              <img class="responsive_pareja" src="<?php echo $fila['foto1'] ?>" alt="" />
                           </section>

                        </div>
                        <div class="col-4 col-6-medium col-12-small">

                           <!-- Feature -->
                           <section>
                              <img class="responsive_pareja" src="<?php echo $fila['foto2'] ?>" alt="" />
                           </section>

                        </div>
                        <div class="col-4 col-6-medium col-12-small">

                           <!-- Feature -->
                           <section>
                              <img class="responsive_pareja" src="<?php echo $fila['foto3'] ?>" alt="" />
                           </section>
                        </div>
                     </div>
                     <div class="prueba">
                           <h4>Nombre: </h4>
                           <li class="informacion"><?php echo $fila['Nombre']; ?> <?php echo $fila['Apellido']; ?></li>
                           <h4>Celular: </h4>
                           <li class="informacion"><?php echo $fila['Celular']; ?></li>
                           <h4>Email: </h4>
                           <li class="informacion"><?php echo $fila['email']; ?></li>
                           <h4>Busco conocer: </h4>
                           <li class="informacion">
                              <?php
                              if ($fila['Interes'] == 3) echo "Hombres";
                              if ($fila['Interes'] == 4) echo "Mujeres";
                              if ($fila['Interes'] == 5) echo "Hombres o mujeres";
                              ?>
                           </li>
                           <h4>Tengo: </h4>
                           <li class="informacion">
                              <?php
                              // Calculo la edad, se evalúa con la fecha actual.
                              $fecha = new DateTime($fila['Nacimiento']);
                              $hoy = new DateTime();
                              $annos = $hoy->diff($fecha);
                              echo $annos->y;
                              ?> años
                           </li>
                           <h4>Ocupación: </h4>
                           <li class="informacion"><?php echo $fila['Escuela']; ?></li>
                           <h4>Información: </h4>
                           <li class="informacion"><?php echo $fila['Sobre_ti']; ?></li>
                        </div>
                  </div>
               </section>
      <?php
               break;
            }
         } else echo "<div class='alert' role='alert'>No tienes permisos para ver esta pagina!</div>";
         mysqli_close($conexion);
      } else {
         echo "<div class='alert' role='alert'>Ha ocurrido un error!</div>";
      }
      ?>
   </div>
   <?php
   include "footer.php";
   ?>
</body>

</html>