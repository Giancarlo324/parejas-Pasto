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
                    if (!$_GET) header('Location:a_quien_le_gusto.php?pagina=1');
                    if ($_GET['pagina']>3 || $_GET['pagina']<1) header('Location:a_quien_le_gusto.php?pagina=1');
                    $iniciar = ($_GET['pagina'] - 1) * 3;
                    $myId = $_SESSION['id'];
                    $personas_pagina = 3;
                    // Consulta en donde podré saber el total de personas.
                    $misGutos2 = "SELECT * FROM usuario INNER JOIN megusta ON usuario.id = megusta.id_usuario WHERE quien_gusta = ? and quien_gusta is not NULL";
                    // Consulta en donde podré saber el total de personas a mostrar por pagina y son las que indicaré.
                    $misGutos = "SELECT * FROM usuario INNER JOIN megusta ON usuario.id = megusta.id_usuario WHERE quien_gusta = ? and quien_gusta is not NULL LIMIT ?, ?";
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
                    if ($totalFilas == 0) { // Verifico si existen datos.
                        echo "No le has dado me gusta a nadie";
                    } else {
                ?>

                        <?php

                        while ($fila = mysqli_fetch_assoc($resulta)) {
                        ?>
                            <table class="table">

                                <thead class="thead-light">
                                    <tr>
                                        <th>Nombre: <?php echo $fila['Nombre']; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>Foto: <?php echo $fila['username']; ?>
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
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="a_quien_le_gusto.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
            <?php for ($i = 0; $i < $paginas; $i++) : ?>
                <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="a_quien_le_gusto.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
            <?php endfor ?>

            <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="a_quien_le_gusto.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
        </ul>
    </nav>
        
    </div>
    <?php
    include "footer.html";
    ?>
</body>

</html>