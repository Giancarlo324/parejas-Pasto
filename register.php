<?php
include('sesion.php');
if (isset($_SESSION['username']) and isset($_SESSION['id'])) : header('location: index.php');
endif;
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
                <h2 style="text-align: center;">Registrarse</h2>
                <?php
                if ($conexion) {
                ?>
                    <form method="post" enctype="multipart/form-data" action="register.php">
                        <?php include('errors.php'); ?>
                        <div>
                            <label>Nombre</label>
                            <input type="text" placeholder="Escribe tu nombre" name="Nombre" value="<?php echo $Nombre; ?>">
                            <label>Apellido</label>
                            <input type="text" placeholder="Escribe tu apellido" name="Apellido" value="<?php echo $Apellido; ?>">
                            <p>
                                <label>Escoge tus tres mejores fotografías (tamaño recomendado: 410px alto * 380px ancho)</label>
                                <input type="file" name="foto1" id="foto1" accept="image/*" require>
                                <input type="file" name="foto2" id="foto2" accept="image/*" require>
                                <input type="file" name="foto3" id="foto3" accept="image/*" require>
                            </p>
                            
                            <p>
                                <label>Sexo</label>

                                <label class="miradio">Hombre
                                    <input type="radio" name="Sexo" value="1" <?php if ($Sexo == "1") echo "checked"; ?> checked>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="miradio">Mujer
                                    <input type="radio" name="Sexo" value="2" <?php if ($Sexo == "2") echo "checked"; ?>>
                                    <span class="checkmark"></span>
                                </label>

                            </p>
                            <label>Nacimiento</label>
                            <input type="date" name="Nacimiento" value="<?php echo $Nacimiento; ?>">
                            <label>Nivel de estudios acadmémicos</label>
                            <input type="text" placeholder="Escribe que estudias actualmente" name="Escuela" value="<?php echo $Escuela; ?>">
                            <label>Nombre de usuario</label>
                            <input type="text" placeholder="Escribe tu nombre de usuario" name="username" value="<?php echo $username; ?>">
                            <label>Sobre ti</label>
                            <textarea type="text" placeholder="Describe cuales son tus gustos, que buscas, qué haces..." name="Sobre_ti" value="<?php echo $Sobre_ti; ?>" placeholder="Escribe algo interesante sobre ti..."></textarea>
                            <label>Celular</label>
                            <input type="number" placeholder="Num. Celular" name="Celular" value="<?php echo $Celular; ?>">
                            <p>
                                <label>Me interesa</label>

                                <label class="miradio">Hombres
                                    <input type="radio" name="Interes" value="3" <?php if ($Interes == "3") echo "checked"; ?> checked>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="miradio">Mujeres
                                    <input type="radio" name="Interes" value="4" <?php if ($Interes == "4") echo "checked"; ?>>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="miradio">Hombres y mujeres
                                    <input type="radio" name="Interes" value="5" <?php if ($Interes == "5") echo "checked"; ?>>
                                    <span class="checkmark"></span>
                                </label>

                            </p>
                            <label>Email</label>
                            <input type="email" placeholder="Escribe tu correo electrónico" name="email" value="<?php echo $email; ?>">
                            <label>Contraseña</label>
                            <input type="password" placeholder="Escribe tu contraseña" name="contrasena">
                            <label>Confirmar contraseña</label>
                            <input type="password" placeholder="Confirma tu contraseña" name="contrasena2">
                        </div>
                        <p>
                            <br>
                            <button type="submit" class="btn" name="reg_user">Registrar</button>
                        </p>
                        <p style="font-size: 25px;">
                            ¿Ya estás registrado? <br><a href="login.php"><strong>Iniciar sesión</strong></a>
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
    include "footer.php";
    ?>
</body>

</html>