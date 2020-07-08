<?php
include('sesion.php');
?>
<!DOCTYPE html>
<html>
<?php
include "head.html";
?>

<body>
   <?php
   include "header.php";
   ?>
   <div class="container">
      <div class="row">
         <div class="card-body">
            <h1 class="p-3 mb-2 bg-success text-white">Bienvenido</h1>
            <div class="container">
                <?php
                $miId = $_SESSION['id'];
                $sqlPerfilPersona = "SELECT * FROM usuario WHERE id = ?";
                $sqlFuncional = $conexion->prepare($sqlPerfilPersona);
                $sqlFuncional->bind_param('i', $miId);
                $sqlFuncional->execute();
                $resulta = $sqlFuncional->get_result();

                if ($sqlFuncional) {
                    while ($fila = mysqli_fetch_assoc($resulta)) {
                        echo $fila['Nombre'];
                    }
                }
                ?>
            </div>
         </div>
      </div>
   </div>
   <?php
   include "footer.php";
   ?>
</body>

</html>