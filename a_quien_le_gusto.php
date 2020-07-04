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
                // Validar si el interes es uno o le hace a todo.
                /*$sql = "SELECT * FROM usuario WHERE id!=myId AND Sexo=Interes";
                $sqlAll = "SELECT * FROM usuario WHERE id!=myId";
                $resultado = mysqli_query($conexion, $sql);
                */
                ?>
                <div class="card text-center">
                    <div class="card-header">
                        ¿Te gusta?
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Nombre persona</h5>
                        <p class="card-text">El acerca de.</p>
                        <a href="#" class="btn btn-primary">Acceder al perfil</a>
                    </div>
                    <div class="card-footer text-muted">
                        Mostrar edad
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "footer.html";
    ?>
</body>

</html>