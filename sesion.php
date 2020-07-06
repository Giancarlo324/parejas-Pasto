<div class="container">
    <?php
    require "conexion.php";

    $Nombre = "";
    $Apellido = "";
    $Sexo = "";
    $Nacimiento = "";
    $Escuela = "";
    $username = "";
    $Sobre_ti = "";
    $Celular = "";
    $Interes = "";
    $email    = "";
    $errors = array(); // Detectar si hay errores al realizar el registro o iniciar sesión.
    $_SESSION['success'] = ""; // Almaceno cuando se haga bien el procedimiento.

    // Textos para errores en los campos.
    $errorNombre = "<div class='alert alert-danger' role='alert'> Nombre es obligatorio! </div>";
    $errorApellido = "<div class='alert alert-danger' role='alert'> Apellido es obligatorio! </div>";
    $errorSexo = "<div class='alert alert-danger' role='alert'> Selecciona tu sexo </div>";
    $errorNacimiento = "<div class='alert alert-danger' role='alert'> Selecciona tu fecha de nacimiento </div>";
    $errorEstudio = "<div class='alert alert-danger' role='alert'> Ingresa tu nivel de estudio acadmémico </div>";
    $errorUsername = "<div class='alert alert-danger' role='alert'> Ingresa un nombre de usuario </div>";
    $errorSobre_ti = "<div class='alert alert-danger' role='alert'> Ingresa algo sobre ti </div>";
    $errorCelular = "<div class='alert alert-danger' role='alert'> Ingresa tu número de celular </div>";
    $errorInteres = "<div class='alert alert-danger' role='alert'> Selecciona qué te interesa encontrar </div>";
    $errorEmail = "<div class='alert alert-danger' role='alert'> Email es obligatorio! </div>";
    $errorPassword = "<div class='alert alert-danger' role='alert'> Contraseña es obligatoria! </div>";
    $errorPassword2 = "<div class='alert alert-danger' role='alert'> Las contraseñas no coinciden :( </div>";

    // Verificaciones.
    $errorPassword = "<div class='alert alert-danger' role='alert'> Contraseña es obligatoria! </div>";
    $errorPassword2 = "<div class='alert alert-danger' role='alert'> Las contraseñas no coinciden :( </div>";
    $errorUsuarioExiste = "<div class='alert alert-danger' role='alert'> El usuario ingresado ya existe</div>";
    $errorEmailExiste = "<div class='alert alert-danger' role='alert'> El usuario ingresado ya existe</div>";

    // Cuando salga bien todo o datos incorrectos.
    $successError = "<div class='alert alert-success' role='alert'> Todo salió perfecto! </div>";
    $errorDatos = "<div class='alert alert-danger' role='alert'> Tus datos son incorrectos :( </div>";


    if ($conexion) { // Verifico conexión de DB.
        session_start();
        // Validar username que no se repita.
        function validarUsername($username, $conexion)
        {
            $sql = "SELECT * FROM usuario
            WHERE username='$username'";

            $result = mysqli_query($conexion, $sql);
            if (mysqli_num_rows($result) > 0) return 1; // Ya existe
            else return 0; // No existe
        }
        // Validar email que no se repita.
        function validarEmail($email, $conexion)
        {
            $sql = "SELECT * FROM usuario
            WHERE email='$email'";

            $result = mysqli_query($conexion, $sql);
            if (mysqli_num_rows($result) > 0) return 1; // Ya existe
            else return 0; // No existe
        }

        // Registrar usuario
        if (isset($_POST['reg_user'])) {
            echo $_POST['Sexo'];
            // Recibir los input del formulario, con seguridad de PHP.
            $Nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
            $Apellido = mysqli_real_escape_string($conexion, $_POST['Apellido']);
            $Sexo = mysqli_real_escape_string($conexion, $_POST['Sexo']);
            $Nacimiento = mysqli_real_escape_string($conexion, $_POST['Nacimiento']);
            $Escuela = mysqli_real_escape_string($conexion, $_POST['Escuela']);
            $username = mysqli_real_escape_string($conexion, $_POST['username']);
            $Sobre_ti = mysqli_real_escape_string($conexion, $_POST['Sobre_ti']);
            $Celular = mysqli_real_escape_string($conexion, $_POST['Celular']);
            $Interes = mysqli_real_escape_string($conexion, $_POST['Interes']);
            $email = mysqli_real_escape_string($conexion, $_POST['email']);
            $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
            $contrasena2 = mysqli_real_escape_string($conexion, $_POST['contrasena']);

            // Validación para campos vacíos y coincidencia de claves
            if (empty($Nombre)) {
                array_push($errors, $errorNombre);
            }
            if (empty($Apellido)) {
                array_push($errors, $errorApellido);
            }
            if (empty($Sexo)) {
                array_push($errors, $errorSexo);
            }
            if (empty($Nacimiento)) {
                array_push($errors, $errorNacimiento);
            }
            if (empty($Escuela)) {
                array_push($errors, $errorEstudio);
            }
            if (empty($username)) {
                array_push($errors, $errorUsername);
            }
            if (empty($Sobre_ti)) {
                array_push($errors, $errorSobre_ti);
            }
            if (empty($Celular)) {
                array_push($errors, $errorCelular);
            }
            if (empty($email)) {
                array_push($errors, $errorEmail);
            }
            if (empty($contrasena)) {
                array_push($errors, $errorPassword);
            }
            if ($contrasena != $contrasena2) {
                array_push($errors, $errorPassword2);
            }
            if (validarUsername($username, $conexion) == 1) {
                array_push($errors, $errorUsuarioExiste);
            }
            if (validarEmail($email, $conexion) == 1) {
                array_push($errors, $errorEmailExiste);
            }
            // Registra un usuario si todo sale bien.
            if (count($errors) == 0) {
                $password = md5($contrasena); // Cifrar la contraseña antes de guardarla en la base de datos
                $query = "INSERT INTO usuario (Nombre, Apellido, Sexo, Nacimiento, Escuela, username, Sobre_ti, Celular, Interes, email, contrasena) 
					  VALUES('$Nombre', '$Apellido', '$Sexo', '$Nacimiento', '$Escuela', '$username', '$Sobre_ti', '$Celular', '$Interes', '$email', '$password')";
                mysqli_query($conexion, $query);

                // Identifico el usuario para poder crear una sesión con id.
                $sqlc = "SELECT * FROM usuario WHERE email='$email'";
                $resultc = mysqli_query($conexion, $sqlc);
                if (mysqli_num_rows($resultc) > 0) {

                    while ($row = mysqli_fetch_array($resultc)) { // En row obtengo los datos del usuario, necesito id.
                        if ($email  == $row['email'] && $password == $row['contrasena']) {
                            $_SESSION['username'] = $row['username']; // Creo la sesión con username que proviene del while.
                            $_SESSION['id'] = $row['id']; // Creo la sesión con id que proviene del while.
                            $_SESSION['success'] = $successError; // Indico que es correcta la sesión.
                            mysqli_close($conexion);
                            header('location: index.php'); // Redirijo hacia index.php.
                        }
                    }
                }
            }
        }


        // Inicio de sesión
        if (isset($_POST['login_user'])) {
            // Recibir los input del formulario, con seguridad de PHP.
            $email = mysqli_real_escape_string($conexion, $_POST['email']);
            $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

            // Valido campos en blanco y añado errores si es que hay.
            if (empty($email)) {
                array_push($errors, $errorEmail);
            }
            if (empty($contrasena)) {
                array_push($errors, $errorPassword);
            }
            // Si todo va bien...
            if (count($errors) == 0) {
                $password = md5($contrasena); // Codificar contraseña antes de almacenarla.
                $query = "SELECT * FROM usuario WHERE email='$email' AND contrasena='$password'";
                $results = mysqli_query($conexion, $query);

                // Verificación si usuario y contraseña coinciden con los almacenados en la DB.
                if (mysqli_num_rows($results) == 1) {
                    // Identifico el usuario para poder crear una sesión con id.
                    $sqlc = "SELECT * FROM usuario WHERE email='$email'";
                    $resultc = mysqli_query($conexion, $sqlc);
                    if (mysqli_num_rows($resultc) > 0) {

                        while ($row = mysqli_fetch_array($resultc)) { // En row obtengo los datos del usuario, necesito id.
                            if ($email  == $row['email'] && $password == $row['contrasena']) {
                                $_SESSION['username'] = $row['username']; // Creo la sesión con username proviene del while.
                                $_SESSION['id'] = $row['id']; // Creo la sesión con id que proviene del while.
                                $_SESSION['success'] = $successError; // Indico que es correcta la sesión.
                                mysqli_close($conexion);
                                header('location: index.php'); // Redirijo hacia index.php.
                            }
                        }
                    }
                    //
                } else {
                    // Muestro error de datos incorrectos.
                    array_push($errors, $errorDatos);
                }
            }
        }
        // Sección para cuando da me gusta, no me gusta o siguiente.
        // Me gusta
        if (isset($_POST['boton'])) {
            $valor = $_POST['boton'];

            $miId = $_SESSION['id'];

            $query = "INSERT INTO megusta (id_usuario, quien_gusta) 
                              VALUES('$miId', '$valor')";
            mysqli_query($conexion, $query);
        }
        // No me gusta
        if (isset($_POST['boton2'])) {
            $valor = $_POST['boton2'];

            $miId = $_SESSION['id'];

            $query = "INSERT INTO megusta (id_usuario, no_gusta) 
                              VALUES('$miId', '$valor')";
            mysqli_query($conexion, $query);
        }
        // Modificar mi perfil
        if (isset($_POST['editar'])) {
            $miId = $_SESSION['id'];
            $sql = "SELECT * FROM usuario WHERE id = $miId";
            $query = mysqli_query($conexion, $sql);
            while ($row = mysqli_fetch_array($query)) {
                if ($_POST['password_1'] != '') {
                    $password_1 = md5(mysqli_real_escape_string($conexion, $_POST['password_1']));
                    $password_2 = md5(mysqli_real_escape_string($conexion, $_POST['password_2']));
                }
                if ($_POST['username'] != '')
                    $username = mysqli_real_escape_string($conexion, $_POST['username']);
                if ($_POST['username'] == '') $username = $row['username'];
                if (empty($password_1)) {
                    $password_1 = $row['contrasena'];
                    $password_2 = $row['contrasena'];
                }
                $Interes = mysqli_real_escape_string($conexion, $_POST['Interes']);
                // Verifico si las contraseñas coinciden
                if ($password_1 != $password_2) {
                    array_push($errors, $errorPassword2);
                }
                $sql2 = "UPDATE usuario SET username = ?, contrasena = ?, Interes = ? WHERE id = ?";
                $sqlFuncional = $conexion->prepare($sql2);
                $sqlFuncional->bind_param('ssii', $username, $password_1, $Interes, $miId);
                $sqlFuncional->execute();

                //$query2 = mysqli_query($conexion, $sql2);
                if (count($errors) == 0) {
                    if ($sqlFuncional) {
                        $successError = "<div class='alert alert-success' role='alert'> Se actualizaron los datos </div>";
                        //echo $successError;
                        echo'<script type="text/javascript">
                        alert("Datos actualizados!");
                        window.location.href="modificarPerfil.php?id='.$miId.'";
                        </script>';
    ?>
    
    <?php
                        //header("location: modificarPerfil.php?id=$miId");
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Algo salió mal, este nombre de usuario ya existe.</div>";
                    }
                } else echo "<div class='alert alert-danger' role='alert'> Las contraseñas no coinciden :( </div>";
            }
        }
    }
    ?>

</div>