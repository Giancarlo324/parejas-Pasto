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
                <h1 class="p-3 mb-2 bg-success text-white">Bien</h1>
                <?php
                if ($conexion) {
                    $miId = $_SESSION['id'];
                    //if (!$_GET) header("Location:modificarPerfil.php?id=".$miId);
                    if (isset($_GET['id']) && $_SESSION['id'] == $_GET['id']) {
                        $sql = "SELECT * FROM usuario WHERE id = $miId";
                        $query = mysqli_query($conexion, $sql);
                        while ($row = mysqli_fetch_array($query)) {
                ?>
                            <form method="post" action="modificarPerfil.php" class="p-3 mb-2 bg-light text-dark">
                                <div class="form-group">
                                    <label>Nombre de usuario</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
                                    <p><label>Me interesa</label>
                                        <p>
                                            <input type="radio" name="Interes" value="3" <?php if ($Interes == "3") echo "checked";
                                                                                            echo $row['Interes'] == 3 ? 'checked' : '' ?>> Hombres
                                            <input type="radio" name="Interes" value="4" <?php if ($Interes == "4") echo "checked";
                                                                                            echo $row['Interes'] == 4 ? 'checked' : '' ?> ?> Mujeres
                                            <input type="radio" name="Interes" value="5" <?php if ($Interes == "5") echo "checked";
                                                                                            echo $row['Interes'] == 5 ? 'checked' : '' ?> ?> Todo
                                        </p>
                                    </p>
                                    <label>Contraseña nueva</label>
                                    <input type="password" class="form-control" name="password_1">
                                    <label>Confirmar contraseña nueva</label>
                                    <input type="password" class="form-control" name="password_2">
                                </div>
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
    include "footer.html";
    ?>
</body>

</html>