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
    //if (!$_GET) header("Location:modificarPerfil.php?id=".$miId);
    ?>
    <div class="container">
        <div class="row">
            <div class="card-body">
                <header>
                    <h2>Actualizar mi perfil</h2>
                </header>
                <?php
                if ($conexion) {
                    $miId = $_SESSION['id'];
                    if (isset($_GET['id']) && $_SESSION['id'] == $_GET['id']) {

                        $sql = "SELECT foto1, foto2, foto3, Nombre, Apellido, Sexo, Escuela, Sobre_ti, Celular, Interes, contrasena FROM usuario WHERE id = ?";
                        //
                        $sqlFun = $conexion->prepare($sql);
                        $sqlFun->bind_param('i', $miId);
                        $sqlFun->execute();
                        $query = $sqlFun->get_result();
                        //
                        //$query = mysqli_query($conexion, $sql);
                        while ($row = mysqli_fetch_array($query)) {
                            $img1 = $row['foto1'];
                            $img2 = $row['foto2'];
                            $img3 = $row['foto3'];
                ?>
                            <form method="post" enctype="multipart/form-data" action="modificarPerfil.php?id=<?php echo $miId ?>">
                                <?php include('errors.php'); ?>
                                <div>
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Escribe tu nombre" name="Nombre" value="<?php echo $row['Nombre']; ?>">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="Escribe tu apellido" name="Apellido" value="<?php echo $row['Apellido'];; ?>">
                                    <p>
                                        <label>Escoge tus tres mejores fotografías (tamaño recomendado: 410px alto * 380px ancho y peso max:9mb)</label>
                                        <input type="file"  name="foto1" id="foto1" accept="image/*" />
                                        <?php echo "<img src='$img1' style='width:150px; height:160px;'" ?>
                                    </p>
                                    <p>
                                        <input type="file"  name="foto2" id="foto2" accept="image/*" />
                                        <?php echo "<img src='$img2' style='width:150px; height:160px;'" ?>
                                    </p>
                                    <p>
                                        <input type="file"  name="foto3" id="foto3" accept="image/*" />
                                        <?php echo "<img src='$img3' style='width:150px; height:160px;'" ?>
                                    </p>

                                    <p>
                                        <label>Sexo</label>

                                        <label class="miradio">Hombre
                                            <input type="radio" name="Sexo" value="1" <?php if ($Sexo == "1") echo "checked";
                                                                                        echo $row['Sexo'] == 1 ? 'checked' : '' ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="miradio">Mujer
                                            <input type="radio" name="Sexo" value="2" <?php if ($Sexo == "2") echo "checked";
                                                                                        echo $row['Sexo'] == 2 ? 'checked' : '' ?>>
                                            <span class="checkmark"></span>
                                        </label>

                                    </p>
                                    <label>Nivel de estudios acadmémicos</label>
                                    <input type="text" placeholder="Escribe que estudias actualmente" name="Escuela" value="<?php echo $row['Escuela']; ?>">
                                    <!--
                                    <label>Nombre de usuario</label>
                                    <input type="text" placeholder="Escribe tu nombre de usuario" name="username" value="<?php echo $row['username']; ?>">
                                    -->
                                    <label>Sobre ti</label>
                                    <textarea type="text" placeholder="Describe cuales son tus gustos, que buscas, qué haces..." name="Sobre_ti" value="<?php echo $row['Sobre_ti']; ?>"></textarea>
                                    <label>Celular</label>
                                    <input type="tel" maxlength="10" placeholder="Num. Celular" name="Celular" value="<?php echo $row['Celular']; ?>">
                                    <p>
                                        <label>Me interesa</label>

                                        <label class="miradio">Hombres
                                            <input type="radio" name="Interes" value="3" <?php if ($Interes == "3") echo "checked";
                                                                                            echo $row['Interes'] == 3 ? 'checked' : '' ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="miradio">Mujeres
                                            <input type="radio" name="Interes" value="4" <?php if ($Interes == "4") echo "checked";
                                                                                            echo $row['Interes'] == 4 ? 'checked' : '' ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="miradio">Hombres y mujeres
                                            <input type="radio" name="Interes" value="5" <?php if ($Interes == "5") echo "checked";
                                                                                            echo $row['Interes'] == 5 ? 'checked' : '' ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </p>
                                    <label>Contraseña actual</label>
                                    <input type="password" placeholder="Escribe tu contraseña actual" name="password_actual">
                                    <label>Contraseña nueva</label>
                                    <input type="password" placeholder="Escribe tu nueva contraseña" name="password_1">
                                    <label>Confirmar contraseña nueva</label>
                                    <input type="password" placeholder="Confirma tu nueva contraseña" name="password_2">
                                </div>
                                <br>
                                <p>
                                    <input type="submit" name="editar" value="Actualizar" />
                                </p>
                            </form>
                <?php
                        }
                    } else echo "<div class=''>No tienes permiso para ver esta pagina!</div>";
                    mysqli_close($conexion);
                } else {
                    echo "<div class=''>Ha ocurrido un error!</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>