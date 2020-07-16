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
            // En fila2 estará la consulta.
            /*
            while ($fila2 = mysqli_fetch_assoc($resultado)) {
                // Hombres.
                if ($fila2['Interes'] == 3 and $fila2['Sexo'] == 1) { // Si es hombre que busca hombres.
                    $sqlHombreHombre = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, id FROM usuario WHERE id != ? and Sexo = 1 and (Interes = 3 or Interes = 5)";

                    $sqlFuncional5 = $conexion->prepare($sqlHombreHombre);
                    $sqlFuncional5->bind_param('i', $myId);
                    $sqlFuncional5->execute();
                    $resultado2 = $sqlFuncional5->get_result();
                }
                else if ($fila2['Interes'] == 4 and $fila2['Sexo'] == 1) { // Si es hombre que busca mujeres.
                    $sqlHombreMujer = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, id FROM usuario WHERE id != ? and Sexo = 1 and (Interes = 4 or Interes = 5)";

                    $sqlFuncional6 = $conexion->prepare($sqlHombreMujer);
                    $sqlFuncional6->bind_param('i', $myId);
                    $sqlFuncional6->execute();
                    $resultado2 = $sqlFuncional6->get_result();
                }
                else if ($fila2['Interes'] == 5 and $fila2['Sexo'] == 1) { // Si es hombre que busca hombres o mujeres.
                    $sqlHombreATodo = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, id FROM usuario WHERE id != ? and Sexo = 1 and Interes = 5";

                    $sqlFuncional7 = $conexion->prepare($sqlHombreATodo);
                    $sqlFuncional7->bind_param('i', $myId);
                    $sqlFuncional7->execute();
                    $resultado2 = $sqlFuncional7->get_result();
                }
                // Mujeres
                else if (($fila2['Interes'] == 4 or $fila2['Interes'] == 5) and $fila2['Sexo'] == 2) { // Si es mujer que busca mujeres o todo.
                    $sqlMujerMujer = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, id FROM usuario WHERE id != ? and Sexo = 2 and (Interes = 4 or Interes = 5)";

                    $sqlFuncional8 = $conexion->prepare($sqlMujerMujer);
                    $sqlFuncional8->bind_param('i', $myId);
                    $sqlFuncional8->execute();
                    $resultado2 = $sqlFuncional8->get_result();
                }
                else if (($fila2['Interes'] == 3 or $fila2['Interes'] == 5) and $fila2['Sexo'] == 2) { // Si es mujer que busca hombres o todo.
                    $sqlMujerHombre = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, id FROM usuario WHERE id != ? and Sexo = 2 and (Interes = 3 or Interes = 5)";

                    $sqlFuncional9 = $conexion->prepare($sqlMujerHombre);
                    $sqlFuncional9->bind_param('i', $myId);
                    $sqlFuncional9->execute();
                    $resultado2 = $sqlFuncional9->get_result();
                }
                else if ($fila2['Interes'] == 5 and $fila2['Sexo'] == 2) { // Si es mujer que busca hombres o mujeres.
                    $sqlMujerATodo = "SELECT Nombre, Apellido, foto1, foto2, foto3, Escuela, Sobre_ti, Nacimiento, id FROM usuario WHERE id != ? and Sexo = 2 and Interes = 5";

                    $sqlFuncional10 = $conexion->prepare($sqlMujerATodo);
                    $sqlFuncional10->bind_param('i', $myId);
                    $sqlFuncional10->execute();
                    $resultado2 = $sqlFuncional10->get_result();
                }
                else {
                    // Ejecuto una sentencia vacía si no encontró coincidencia.
                    $sqlVacia = "SELECT Nombre FROM usuario WHERE id != ? and Sexo = 9";

                    $sqlFuncional11 = $conexion->prepare($sqlVacia);
                    $sqlFuncional11->bind_param('i', $myId);
                    $sqlFuncional11->execute();
                    $resultado2 = $sqlFuncional11->get_result();
                    $totalFilas = 1;
                }
            }*/
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