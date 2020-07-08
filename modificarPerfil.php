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
                <h1 class="p-3 mb-2 bg-success text-white">Bien</h1>
                <?php
                if ($conexion) {
                    $miId = $_SESSION['id'];
                    if (isset($_GET['id']) && $_SESSION['id'] == $_GET['id']) {

                        $sql = "SELECT * FROM usuario WHERE id = $miId";
                        $query = mysqli_query($conexion, $sql);
                        while ($row = mysqli_fetch_array($query)) {
                            $img1 = $row['foto1'];
                            echo $img1;
                            $img2 = $row['foto2'];
                            $img3 = $row['foto3'];
                ?>
                            <form method="post" enctype="multipart/form-data" action="modificarPerfil.php?id=<?php echo $miId ?>" class="p-3 mb-2 bg-light text-dark">
                                <div class="form-group">
                                    <label>Nombre de usuario</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
                                    <p>
                                        <label>Escoge tus tres mejores fotografías (tamaño recomendado: 410px alto * 380px ancho)</label>
                                        <input type="file" class="form-control" name="foto1" id="foto1" accept="image/*" />
                                        <?php echo "<img src='$img1' style='width:150px; height:160px;'" ?>
                                    </p>
                                    <p>
                                        <input type="file" class="form-control" name="foto2" id="foto2" accept="image/*" />
                                        <?php echo "<img src='$img2' style='width:150px; height:160px;'" ?>
                                    </p>
                                    <p>
                                        <input type="file" class="form-control" name="foto3" id="foto3" accept="image/*" />
                                        <?php echo "<img src='$img3' style='width:150px; height:160px;'" ?>
                                    </p>
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
                                    <label>Contraseña nueva</label>
                                    <input type="password" class="form-control" name="password_1">
                                    <label>Confirmar contraseña nueva</label>
                                    <input type="password" class="form-control" name="password_2">
                                </div>
                                <br>
                                <p>
                                    <input type="submit" name="editar" class="btn btn-success" value="Actualizar" />
                                </p>
                            </form>
                <?php
                        }
                    } else echo "<div class='alert alert-danger'>No tienes permiso para ver esta pagina!</div>";
                    mysqli_close($conexion);
                } else {
                    echo "<div class='alert alert-danger'>Ha ocurrido un error!</div>";
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