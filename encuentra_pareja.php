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
        ?>
            <?php
            $myId = $_SESSION['id'];
            $interesUsuario = "SELECT Interes, Sexo FROM usuario WHERE id = ?";

            $sqlFuncional = $conexion->prepare($interesUsuario);
            $sqlFuncional->bind_param('i', $myId);
            $sqlFuncional->execute();
            $resulta = $sqlFuncional->get_result();
            $totalFilas = 1;

            //$resultadoInteres = mysqli_query($conexion, $interesUsuario);
            while ($fila = mysqli_fetch_assoc($resulta)) {
                if ($fila['Sexo'] == 1 and $fila['Interes'] == 3) { // Hombre busca hombre.
                    $consultaHombres = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, Interes, Sexo, id FROM usuario WHERE id != ? and Sexo = 1 and (Interes = 3 or Interes = 5)";

                    $sqlFuncional2 = $conexion->prepare($consultaHombres);
                    $sqlFuncional2->bind_param('i', $myId);
                    $sqlFuncional2->execute();
                    $resultado = $sqlFuncional2->get_result();
                }
                if ($fila['Sexo'] == 1 and $fila['Interes'] == 4) { // Hombre busca mujer.
                    $consultaHombres = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, Interes, Sexo, id FROM usuario WHERE id != ? and Sexo = 2 and (Interes = 3 or Interes = 5)";

                    $sqlFuncional2 = $conexion->prepare($consultaHombres);
                    $sqlFuncional2->bind_param('i', $myId);
                    $sqlFuncional2->execute();
                    $resultado = $sqlFuncional2->get_result();
                }
                if ($fila['Sexo'] == 2 and $fila['Interes'] == 4) { // Mujer busca mujer.
                    $consultaMujeres = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, Interes, Sexo, id FROM usuario WHERE id != ? and Sexo = 2 and (Interes = 4 or Interes = 5)";

                    $sqlFuncional3 = $conexion->prepare($consultaMujeres);
                    $sqlFuncional3->bind_param('i', $myId);
                    $sqlFuncional3->execute();
                    $resultado = $sqlFuncional3->get_result();
                }
                if ($fila['Sexo'] == 2 and $fila['Interes'] == 3) { // Mujer busca hombre.
                    $consultaMujeres = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, Interes, Sexo, id FROM usuario WHERE id != ? and Sexo = 1 and (Interes = 4 or Interes = 5)";

                    $sqlFuncional3 = $conexion->prepare($consultaMujeres);
                    $sqlFuncional3->bind_param('i', $myId);
                    $sqlFuncional3->execute();
                    $resultado = $sqlFuncional3->get_result();
                }
                if ($fila['Sexo'] == 1 and $fila['Interes'] == 5) { // Hombre que le interesa todo.
                    $consultaHombres = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, Interes, Sexo, id FROM usuario WHERE id != ? and (Interes = 3 or Interes = 5)";

                    $sqlFuncional4 = $conexion->prepare($consultaHombres);
                    $sqlFuncional4->bind_param('i', $myId);
                    $sqlFuncional4->execute();
                    $resultado = $sqlFuncional4->get_result();
                }
                if ($fila['Sexo'] == 2 and $fila['Interes'] == 5) { // Mujer que le interesa todo.
                    $consultaHombres = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, Interes, Sexo, id FROM usuario WHERE id != ? and (Interes = 4 or Interes = 5)";

                    $sqlFuncional4 = $conexion->prepare($consultaHombres);
                    $sqlFuncional4->bind_param('i', $myId);
                    $sqlFuncional4->execute();
                    $resultado = $sqlFuncional4->get_result();
                }
            }
            while ($fila3 = mysqli_fetch_assoc($resultado)) {
                // if (empty($fila3))  echo "Vacio";
                // else echo "Tiene contenido";


                $id_quien_gusta = $fila3['id'];
                // Verifico si el perfil que aparece ya le di me gusta o no me gusta.
                $validarMeGusta = "SELECT * FROM megusta WHERE (id_usuario = ? and (quien_gusta = ? or no_gusta = ?))";
                $sqlFuncional = $conexion->prepare($validarMeGusta);
                $sqlFuncional->bind_param('iii', $myId, $id_quien_gusta, $id_quien_gusta);
                $sqlFuncional->execute();
                $resulta = $sqlFuncional->get_result();

                $totalFilas = $resulta->num_rows;
                if ($totalFilas == 0) { // Si no le he dado me gusta, hago que aparezcan sus datos.
            ?>
                    <!-- Features -->
                    <section id="features">
                        <div class="container">
                            <header>
                                <h2>¿Te gustaría conocer a <strong><?php echo $fila3['Nombre']; ?> <?php echo $fila3['Apellido']; ?></strong>?</h2>
                            </header>
                            <div class="row aln-center">
                                <div class="col-4 col-6-medium col-12-small">

                                    <!-- Feature -->
                                    <section>
                                        <img class="responsive_pareja" src="<?php echo $fila3['foto1'] ?>" alt="" />
                                        <header>
                                            <h3>Estudios</h3>
                                        </header>
                                        <p><?php echo $fila3['Escuela']; ?>.</p>
                                    </section>

                                </div>
                                <div class="col-4 col-6-medium col-12-small">

                                    <!-- Feature -->
                                    <section>
                                        <img class="responsive_pareja" src="<?php echo $fila3['foto2'] ?>" alt="" />
                                        <header>
                                            <h3>Información...</h3>
                                        </header>
                                        <p><?php echo $fila3['Sobre_ti']; ?>.</p>
                                    </section>

                                </div>
                                <div class="col-4 col-6-medium col-12-small">

                                    <!-- Feature -->
                                    <section>
                                        <img class="responsive_pareja" src="<?php echo $fila3['foto3'] ?>" alt="" />
                                        <header>
                                            <h3>Su edad</h3>
                                        </header>
                                        <p><?php
                                            // Calculo la edad, se evalúa con la fecha actual.
                                            $fecha = new DateTime($fila3['Nacimiento']);
                                            $hoy = new DateTime();
                                            $annos = $hoy->diff($fecha);
                                            echo $annos->y;
                                            ?> años.</p>
                                    </section>

                                </div>
                                <div class="col-12">
                                    <div>
                                        <form method="POST" action="encuentra_pareja.php">

                                            <div>
                                                <button type="submit" name="boton" value="<?php echo $fila3['id']; ?>">Me gusta</button>
                                                <button type="submit" name="boton2" value="<?php echo $fila3['id']; ?>">No me gusta</button>
                                            </div>
                                            <br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                    break;
                }
            }
            if ($totalFilas != 0) {

                ?>
                <!-- Features -->
                <section id="features">
                    <div class="container">
                        <header>
                            <h2>En este momento no hay parejas disponibles</h2>
                        </header>
                        <div class="row aln-center">
                            ¡Comparte este sitio web con tus amigos y descubre gente nueva!
                            <img src="images/buscarpareja.jpg" class="responsive" />
                        </div>
                    </div>
                </section>
        <?php
            }
            mysqli_close($conexion);
        } else {
            echo "<div class='container'>Ha ocurrido un error!</div>";
        }
        ?>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>