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
    $foto1 = "";
    $foto2 = "";
    $foto3 = "";
    $errors = array(); // Detectar si hay errores al realizar el registro o iniciar sesión.
    $_SESSION['success'] = ""; // Almaceno cuando se haga bien el procedimiento.

    // Textos para errores en los campos.
    $errorNombre = "<div class='alert' role='alert'> Nombre es obligatorio! </div>";
    $errorApellido = "<div class='alert' role='alert'> Apellido es obligatorio! </div>";
    $errorSexo = "<div class='alert' role='alert'> Selecciona tu sexo </div>";
    $errorNacimiento = "<div class='alert' role='alert'> Selecciona tu fecha de nacimiento </div>";
    $errorEdad = "<div class='alert' role='alert'> Solo se permiten mayores de 18 años </div>";
    $errorEstudio = "<div class='alert' role='alert'> Ingresa tu nivel de estudio acadmémico </div>";
    $errorUsername = "<div class='alert' role='alert'> Ingresa un nombre de usuario </div>";
    $errorSobre_ti = "<div class='alert' role='alert'> Ingresa algo sobre ti </div>";
    $errorCelular = "<div class='alert' role='alert'> Ingresa tu número de celular </div>";
    $errorInteres = "<div class='alert' role='alert'> Selecciona qué te interesa encontrar </div>";
    $errorEmail = "<div class='alert' role='alert'> Email es obligatorio! </div>";
    $errorPassword = "<div class='alert' role='alert'> Contraseña es obligatoria! </div>";
    $errorPassword2 = "<div class='alert' role='alert'> Las contraseñas no coinciden :( </div>";
    $errorImagenoPeso = "<div class='alert' role='alert'> Archivo no permitido o excede el límite de peso permitido(9mb) </div>";

    // Verificaciones.
    $errorPassword = "<div class='alert' role='alert'> Contraseña es obligatoria! </div>";
    $errorPassword2 = "<div class='alert' role='alert'> Las contraseñas no coinciden :( </div>";
    $errorUsuarioExiste = "<div class='alert' role='alert'> El usuario ingresado ya existe</div>";
    $errorEmailExiste = "<div class='alert' role='alert'> El correo ingresado ya existe</div>";

    // Cuando salga bien todo o datos incorrectos.
    $successError = "<div class='alert' role='alert'> Todo salió perfecto! </div>";
    $errorDatos = "<div class='alert' role='alert'> Tus datos son incorrectos :( </div>";


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
        // Validar username que no se repita, pero pueda tener el mismo al modificarse.
        function validarUsernameModificar($username, $id, $conexion)
        {
            $sql = "SELECT * FROM usuario
            WHERE username='$username' and ( id != $id ) ";

            $result = mysqli_query($conexion, $sql);
            if (mysqli_num_rows($result) > 0) return 1; // Ya existe
            else return 0; // No existe
        }

        // Registrar usuario
        if (isset($_POST['reg_user'])) {
            // Recibir los input del formulario, con seguridad de PHP.
            $Nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
            $Apellido = mysqli_real_escape_string($conexion, $_POST['Apellido']);
            $Sexo = mysqli_real_escape_string($conexion, $_POST['Sexo']);
            $Nacimiento = mysqli_real_escape_string($conexion, $_POST['Nacimiento']);
            $Escuela = mysqli_real_escape_string($conexion, $_POST['Escuela']);
            $username = mysqli_real_escape_string($conexion, $_POST['username']);

            $foto1 = "img/" . $username . basename($_FILES['foto1']['name']);
            $foto2 = "img/" . $username . basename($_FILES['foto2']['name']);
            $foto3 = "img/" . $username . basename($_FILES['foto3']['name']);

            $permitidos = array("image/jpg", "image/jpeg", "image/png", "image/jpeg", "image/bmp");
            $limite_peso_b = 9437184; //9mb

            // Valido que sea una imagen y el tamaño no supere las 9mb.
            if ((in_array($_FILES['foto1']['type'], $permitidos)) && (in_array($_FILES['foto2']['type'], $permitidos)) && (in_array($_FILES['foto3']['type'], $permitidos)) && $_FILES['foto1']['size'] <= $limite_peso_b && $_FILES['foto2']['size'] <= $limite_peso_b && $_FILES['foto3']['size'] <= $limite_peso_b) {
            } else {
                array_push($errors, $errorImagenoPeso);
            }

            $Sobre_ti = mysqli_real_escape_string($conexion, $_POST['Sobre_ti']);
            $Celular = mysqli_real_escape_string($conexion, $_POST['Celular']);
            $Interes = mysqli_real_escape_string($conexion, $_POST['Interes']);
            $email = mysqli_real_escape_string($conexion, $_POST['email']);
            $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
            $contrasena2 = mysqli_real_escape_string($conexion, $_POST['contrasena']);

            // Validación para campos vacíos y coincidencia de claves
            if (empty($Nombre)) array_push($errors, $errorNombre);
            
            if (empty($Apellido)) array_push($errors, $errorApellido);
            
            if (empty($Sexo)) array_push($errors, $errorSexo);
            
            if (empty($Nacimiento)) array_push($errors, $errorNacimiento);
            
            if (!empty($Nacimiento)) {
                //
                $fecha = new DateTime($Nacimiento);
                $hoy = new DateTime();
                $annos = $hoy->diff($fecha);
                if($annos->y < 18) array_push($errors, $errorEdad);
            }
            
            if (empty($Escuela)) array_push($errors, $errorEstudio);
            
            if (empty($username)) array_push($errors, $errorUsername);
            
            if (empty($Sobre_ti)) array_push($errors, $errorSobre_ti);
            
            if (empty($Celular)) array_push($errors, $errorCelular);
            
            if (empty($email)) array_push($errors, $errorEmail);
            
            if (empty($contrasena)) array_push($errors, $errorPassword);
            
            if ($contrasena != $contrasena2) array_push($errors, $errorPassword2);
            
            if (validarUsername($username, $conexion) == 1) array_push($errors, $errorUsuarioExiste);
            
            if (validarEmail($email, $conexion) == 1) array_push($errors, $errorEmailExiste);
            
            // Registra un usuario si todo sale bien.
            if (count($errors) == 0) {
                // Las fotografías tiene el formato de: img/nombredeusuario#.extension
                $foto1 = "img/" . $username . "1." . pathinfo($foto1, PATHINFO_EXTENSION);
                $foto2 = "img/" . $username . "2." . pathinfo($foto2, PATHINFO_EXTENSION);
                $foto3 = "img/" . $username . "3." . pathinfo($foto3, PATHINFO_EXTENSION);

                $password = md5($contrasena); // Cifrar la contraseña antes de guardarla en la base de datos
                $query = "INSERT INTO usuario (Nombre, Apellido, foto1, foto2, foto3, Sexo, Nacimiento, Escuela, username, Sobre_ti, Celular, Interes, email, contrasena) 
					  VALUES('$Nombre', '$Apellido', '$foto1', '$foto2', '$foto3', '$Sexo', '$Nacimiento', '$Escuela', '$username', '$Sobre_ti', '$Celular', '$Interes', '$email', '$password')";
                mysqli_query($conexion, $query);

                if ((move_uploaded_file($_FILES['foto1']['tmp_name'], $foto1)) and (move_uploaded_file($_FILES['foto2']['tmp_name'], $foto2)) and (move_uploaded_file($_FILES['foto3']['tmp_name'], $foto3))) {
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
                } else echo "pailas";
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
            header('location: encuentra_pareja.php'); // Redirijo hacia la misma pagina php para evitar reenvío de formulario.
        }
        // No me gusta
        if (isset($_POST['boton2'])) {
            $valor = $_POST['boton2'];

            $miId = $_SESSION['id'];

            $query = "INSERT INTO megusta (id_usuario, no_gusta) 
                              VALUES('$miId', '$valor')";
            mysqli_query($conexion, $query);
            header('location: encuentra_pareja.php'); // Redirijo hacia la misma pagina php para evitar reenvío de formulario.
        }
        // Modificar mi perfil
        if (isset($_POST['editar'])) {
            $miId = $_SESSION['id'];
            $sql = "SELECT * FROM usuario WHERE id = $miId";
            $query = mysqli_query($conexion, $sql);

            $permitidos = array("image/jpg", "image/jpeg", "image/png", "image/jpeg", "image/bmp");
            $limite_peso_b = 9437184; //9mb

            while ($row = mysqli_fetch_array($query)) {
                // Recibir los input del formulario, con seguridad de PHP.

                $Nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
                $Apellido = mysqli_real_escape_string($conexion, $_POST['Apellido']);
                // Siguen las fotografías que están más abajo.
                $Sexo = mysqli_real_escape_string($conexion, $_POST['Sexo']);
                $Escuela = mysqli_real_escape_string($conexion, $_POST['Escuela']);
                //$username = mysqli_real_escape_string($conexion, $_POST['username']);
                $Sobre_ti = mysqli_real_escape_string($conexion, $_POST['Sobre_ti']);
                $Celular = mysqli_real_escape_string($conexion, $_POST['Celular']);

                $Interes = mysqli_real_escape_string($conexion, $_POST['Interes']);
                $contrasena = mysqli_real_escape_string($conexion, $_POST['password_1']);
                $contrasena2 = mysqli_real_escape_string($conexion, $_POST['password_2']);


                if (empty($Nombre)) $Nombre = mysqli_real_escape_string($conexion, $row['Nombre']);
                if (empty($Apellido)) $Apellido = mysqli_real_escape_string($conexion, $row['Apellido']);
                if (empty($_FILES['foto1']['name'])) $foto1 = $row['foto1'];
                if (empty($_FILES['foto2']['name'])) $foto2 = $row['foto2'];
                if (empty($_FILES['foto3']['name'])) $foto3 = $row['foto3'];

                if (!empty($_FILES['foto1']['name'])) {
                    // Valido que sea una imagen y el tamaño no supere las 9mb.
                    if ((in_array($_FILES['foto1']['type'], $permitidos)) && $_FILES['foto1']['size'] <= $limite_peso_b) {
                        // Elimino la foto actual.
                        unlink($row['foto1']);
                        // Nueva ruta para nueva foto.
                        $foto1 = "img/" . $row['username'] . "1." . pathinfo($_FILES['foto1']['name'], PATHINFO_EXTENSION);
                        // Subo foto.
                        move_uploaded_file($_FILES['foto1']['tmp_name'], $foto1);
                    } else array_push($errors, $errorImagenoPeso);
                }

                if (!empty($_FILES['foto2']['name'])) {
                    // Valido que sea una imagen y el tamaño no supere las 9mb.
                    if ((in_array($_FILES['foto2']['type'], $permitidos)) && $_FILES['foto2']['size'] <= $limite_peso_b) {
                        // Elimino la foto actual.
                        unlink($row['foto2']);
                        // Nueva ruta para nueva foto.
                        $foto2 = "img/" . $row['username'] . "2." . pathinfo($_FILES['foto2']['name'], PATHINFO_EXTENSION);
                        // Subo foto.
                        move_uploaded_file($_FILES['foto2']['tmp_name'], $foto2);
                    } else array_push($errors, $errorImagenoPeso);
                }

                if (!empty($_FILES['foto3']['name'])) {
                    // Valido que sea una imagen y el tamaño no supere las 9mb.
                    if ((in_array($_FILES['foto3']['type'], $permitidos)) && $_FILES['foto3']['size'] <= $limite_peso_b) {
                        // Elimino la foto actual.
                        unlink($row['foto3']);
                        // Nueva ruta para nueva foto.
                        $foto3 = "img/" . $row['username'] . "3." . pathinfo($_FILES['foto3']['name'], PATHINFO_EXTENSION);
                        // Subo foto.
                        move_uploaded_file($_FILES['foto3']['tmp_name'], $foto3);
                    } else array_push($errors, $errorImagenoPeso);
                }
                if (empty($Sexo)) $Sexo = mysqli_real_escape_string($conexion, $row['Sexo']);
                if (empty($Escuela)) $Escuela = mysqli_real_escape_string($conexion, $row['Escuela']);
                //if (empty($username)) $username = mysqli_real_escape_string($conexion, $row['username']);
                if (empty($Sobre_ti)) $Sobre_ti = mysqli_real_escape_string($conexion, $row['Sobre_ti']);
                if (empty($Celular)) $Celular = mysqli_real_escape_string($conexion, $row['Celular']);
                if (empty($Celular)) $Celular = mysqli_real_escape_string($conexion, $row['Celular']);
                if (empty($Interes)) $Interes = mysqli_real_escape_string($conexion, $row['Interes']);
                if (empty($contrasena) && empty($contrasena2)) {
                    $password_1 = $row['contrasena'];
                    $password_2 = $row['contrasena'];
                }
                // Hasta aquí están las validaciones sobre si hace o no modificaciones.

                /* Validación para saber si el usuario nuevo coincide o no con uno existente.
                if (validarUsernameModificar($username, $miId, $conexion) == 1) {
                    array_push($errors, $errorUsuarioExiste);
                }*/
                // Validación para saber si cambia la contraseña
                if (!empty($contrasena)) {
                    if ($contrasena != $contrasena2) {
                        array_push($errors, $errorPassword2);
                    } else {
                        $contrasena = md5(mysqli_real_escape_string($conexion, $contrasena));
                        $contrasena2 = md5(mysqli_real_escape_string($conexion, $contrasena2));
                    }
                }

                // Actualiza un usuario si todo sale bien.
                if (count($errors) == 0) {

                    $password = md5($contrasena); // Cifrar la contraseña antes de guardarla en la base de datos
                    $sql2 = "UPDATE usuario SET Nombre = ?, Apellido = ?, foto1 = ?, foto2 = ?, foto3 = ?, Sexo = ?, Escuela = ?, Sobre_ti = ?, Celular = ?, Interes = ?, contrasena = ? WHERE id = ?";
                    $sqlFuncional = $conexion->prepare($sql2);
                    $sqlFuncional->bind_param('sssssissiisi', $Nombre, $Apellido, $foto1, $foto2, $foto3, $Sexo, $Escuela, $Sobre_ti, $Celular, $Interes, $password_1, $miId);
                    $sqlFuncional->execute();

                    if ($sqlFuncional)
                        echo '<script type="text/javascript">
                        alert("Datos actualizados!");
                        window.location.href="modificarPerfil.php?id=' . $miId . '";
                        </script>';
                    else
                        echo "<div class='alert' role='alert'>Algo salió mal.</div>";
                } else echo '<script type="text/javascript">
                        alert("Las contraseñas no coinciden!");
                        window.location.href="modificarPerfil.php?id=' . $miId . '";
                        </script>';
            }
        }
    }

    ?>

</div>