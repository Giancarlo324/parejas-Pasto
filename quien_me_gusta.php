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
                <h2>Mis gustos</h2>
                <?php
                if ($conexion) {
                    if (!$_GET) header('Location:quien_me_gusta.php?pagina=1');
                    if ($_GET['pagina'] > 3 || $_GET['pagina'] < 1) header('Location:quien_me_gusta.php?pagina=1');
                    $iniciar = ($_GET['pagina'] - 1) * 3;
                    $myId = $_SESSION['id'];
                    $personas_pagina = 3;
                    // Consulta en donde podré saber el total de personas.
                    $misGutos2 = "SELECT * FROM usuario INNER JOIN megusta ON usuario.id = megusta.quien_gusta WHERE id_usuario = ? and quien_gusta is not NULL";
                    // Consulta en donde podré saber el total de personas a mostrar por pagina y son las que indicaré.
                    $misGutos = "SELECT * FROM usuario INNER JOIN megusta ON usuario.id = megusta.quien_gusta WHERE id_usuario = ? and quien_gusta is not NULL LIMIT ?, ?";
                    $sqlGustos = $conexion->prepare($misGutos);
                    // Aquí hago la consulta sin límite para saber cuántas filas tengo en la consulta.
                    $sqlGustos2 = $conexion->prepare($misGutos2);
                    $sqlGustos2->bind_param('i', $myId);
                    $sqlGustos2->execute();
                    $resulta2 = $sqlGustos2->get_result();
                    $totalFilas2 = $resulta2->num_rows;
                    //
                    $sqlGustos->bind_param('iii', $myId, $iniciar, $personas_pagina);
                    $sqlGustos->execute();
                    $resulta = $sqlGustos->get_result();
                    $totalFilas = $resulta->num_rows;
                    $paginas = $totalFilas2 / 3;
                    $paginas = ceil($paginas);
                    if ($totalFilas == 0) { // Verifico si el usuario le ha dado me gusta a alguien.
                ?>
                        <section id="features">
                            <div class="container">
                                <header>
                                    <h2>No pierdas la esperanza, encontrarás tu pareja perfecta</h2>
                                </header>
                                <div class="row aln-center">
                                    <p class="textos"> Prueba a conocer personas distintas, crea conexiones y diviertete!</p>
                                    <img src="images/buscarpareja.jpg" class="responsive" />
                                </div>
                            </div>
                        </section>
                    <?php
                    } else {
                    ?>

                        <?php

                        while ($fila = mysqli_fetch_assoc($resulta)) {
                        ?>
                            <table class="table">

                                <thead class="thead-light" style="text-align: center;">
                                    <tr>
                                        <th>Nombre: <?php echo $fila['Nombre']; ?> <?php echo $fila['Apellido']; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- Muestro las tres imágenes -->
                                            <div id="imgPersona" class="carousel slide" style="width: 380px; margin:auto;" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src="<?php echo $fila['foto1'] ?>" style="width: 380px; height:410px;" alt="First slide">
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#imgPersona" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#imgPersona" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Siguiente</span>
                                                </a>
                                            </div>
                                            <!-- Cierre muestra de las tres imágenes -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ver perfil: <?php echo $fila['id']; ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                                ?>
                        <?php
                        //}
                        mysqli_close($conexion);
                    }
                } else {
                    echo "<div class='container'>Ha ocurrido un error!</div>";
                }
                        ?>
                            </table>

            </div>

        </div>
        <div class="navigation">
            <ul class="pagination">
                <a class="<?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>" href="quien_me_gusta.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
                <?php for ($i = 0; $i < $paginas; $i++) : ?>
                    <a class="<?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>" href="quien_me_gusta.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                <?php endfor ?>

                <a class="<?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>" href="quien_me_gusta.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
        </div>
    </div>

    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>