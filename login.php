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
				<h1 class="p-3 mb-2 bg-success text-white">Iniciar sesión</h1>
				<?php
				if ($conexion) {
				?>
					<form method="post" action="login.php" class="p-3 mb-2 bg-light text-dark">
						<?php include('errors.php'); ?>
						<div class="form-group">
							<label>Correo electrónico</label>
							<input type="email" class="form-control" name="email">
							<label>Contraseña</label>
							<input type="password" class="form-control" name="contrasena">
						</div>
						<p>
							<button type="submit" class="btn btn-primary" name="login_user">Iniciar sesión</button>
						</p>
						<p>
							¿No estás registrado? <a href="register.php">¡Regístrate!</a>
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