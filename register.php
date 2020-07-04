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
                <h1 class="p-3 mb-2 bg-success text-white">Registrarse</h1>
                <?php
                if ($conexion) {
                ?>
                    <form method="post" action="register.php" class="p-3 mb-2 bg-light text-dark">
                        <?php include('errors.php'); ?>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="Nombre" value="<?php echo $Nombre; ?>">
                            <label>Apellido</label>
                            <input type="text" class="form-control" name="Apellido" value="<?php echo $Apellido; ?>">
                            <p><label>Sexo</label>
                                <p>
                                    <input type="radio" name="Sexo" value="1" <?php if($Sexo == "1") echo "checked"; ?> checked/> Hombre
                                    <input type="radio" name="Sexo" value="2" <?php if($Sexo == "2") echo "checked"; ?> /> Mujer
                                </p>
                            </p>
                            <label>Nacimiento</label>
                            <input type="date" class="form-control" name="Nacimiento" value="<?php echo $Nacimiento; ?>">
                            <label>Nivel de estudios acadmémicos</label>
                            <input type="text" class="form-control" name="Escuela" value="<?php echo $Escuela; ?>">
                            <label>Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                            <label>Sobre ti</label>
                            <textarea type="text" class="form-control" name="Sobre_ti" value="<?php echo $Sobre_ti; ?>" placeholder="Escribe algo interesante sobre ti..."></textarea>
                            <label>Celular</label>
                            <input type="number" class="form-control" name="Celular" value="<?php echo $Celular; ?>">
                            <p><label>Me interesa</label>
                                <p>
                                    <input type="radio" name="Interes" value="3" <?php if($Interes == "3") echo "checked"; ?> checked> Hombres
                                    <input type="radio" name="Interes" value="4" <?php if($Interes == "4") echo "checked"; ?> > Mujeres
                                    <input type="radio" name="Interes" value="5" <?php if($Interes == "5") echo "checked"; ?> > Todo
                                </p>
                            </p>
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="contrasena">
                            <label>Confirmar contraseña</label>
                            <input type="password" class="form-control" name="contrasena2">
                        </div>
                        <p>
                            <button type="submit" class="btn btn-success" name="reg_user">Registrar</button>
                        </p>
                        <p>
                            ¿Ya estás registrado?<a href="login.php">Iniciar sesión</a>
                        </p>
                    </form>
                <?php
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