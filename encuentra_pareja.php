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

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="card-body">
                <h1 class="p-3 mb-2 bg-success text-white">Bienvenido</h1>
                <?php
                if ($conexion) {
                ?>
                    <div class="card text-center">
                        <div class="card-header">
                            ¿Te gusta?
                        </div>
                        <div class="card-body">
                            <?php
                            $myId = $_SESSION['id'];
                            $interesUsuario = "SELECT `Interes` FROM `usuario` WHERE `id` = $myId";
                            $resultadoInteres = mysqli_query($conexion, $interesUsuario);
                            while ($fila = mysqli_fetch_assoc($resultadoInteres)) {
                                if ($fila['Interes'] == 3) { // Si le interesan hombres.
                                    $consultaHombres = "SELECT * FROM usuario WHERE id != $myId and Sexo = 1 and (Interes = 4 or Interes = 5) ";
                                    $resultado = mysqli_query($conexion, $consultaHombres);
                                }
                                if ($fila['Interes'] == 4) { // Si le interesan mujeres.
                                    $consultaMujeres = "SELECT * FROM usuario WHERE id != $myId and Sexo = 2 and (Interes = 3 or Interes = 5)";
                                    $resultado = mysqli_query($conexion, $consultaMujeres);
                                } else { // Si le interesa todo.
                                    $consultaHombres = "SELECT * FROM usuario WHERE id != $myId";
                                    $resultado = mysqli_query($conexion, $consultaHombres);
                                }
                            }
                            // En fila estará la consulta.
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                if (empty($fila))  echo "Vacio";
                                else echo "Tiene contenido";


                                $id_quien_gusta = $fila['id'];
                                // Verifico si el perfil que aparece ya le di me gusta.
                                $validarMeGusta = "SELECT * FROM megusta WHERE (id_usuario = $myId and quien_gusta = $id_quien_gusta)";
                                $resultado2 = mysqli_query($conexion, $validarMeGusta);
                                $totalFilas = mysqli_num_rows($resultado2);
                                if ($totalFilas == 0) { // Si no le he dado me gusta, hago que aparezcan sus datos.
                            ?>
                                    <!-- Mostrar posible pareja -->
                                    <h5 class="card-title">Nombre: <?php echo $fila['Nombre']; ?></h5>
                                    <p class="card-text">Datos de interés: <?php echo $fila['Sobre_ti']; ?></p>
                                    <a href="#" class="btn btn-primary">Acceder al perfil</a>
                        </div>
                        <div class="card-footer text-muted"> Edad:
                            <?php
                                    // Calculo la edad, se evalúa con la fecha actual.
                                    $fecha = new DateTime($fila['Nacimiento']);
                                    $hoy = new DateTime();
                                    $annos = $hoy->diff($fecha);
                                    echo $annos->y;
                            ?>
                        </div>
                        <div>
                            <form method="POST" action="encuentra_pareja.php">

                                <button type="submit" name="boton" value="<?php echo $fila['id']; ?>">Me gusta</button>
                                <button type="submit" name="boton2" value="<?php echo $fila['id']; ?>">No me gusta</button>
                                <button type="submit" name="boton3" value="boton3">Siguiente</button>
                            </form>
                        </div>
                    </div>
        <?php
                                    break;
                                }
                            }
                            mysqli_close($conexion);
                        } else {
                            echo "<div class='container'>Ha ocurrido un error!</div>";
                        }
        ?>
            </div>
        </div>
    </div>
    <?php
    include "footer.html";
    ?>
</body>

</html>