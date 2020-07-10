<?php
include('sesion.php');
if (isset($_SESSION['username']) and isset($_SESSION['id'])) : header('location:index.php');
endif;
?>
<!DOCTYPE html>
<html>

<head>
	<?php
	include "head.html";
	?>
</head>

<body>
	<?php
	include "header.php";
	?>
	<div class="container">
		<div class="row">
			<div class="login">
				<h2 style="text-align: center;">Iniciar sesión</h2>
				<?php
				if ($conexion) {
				?>
					<form method="post" action="login.php">
						<?php include('errors.php'); ?>
						<div class="form-group">
							<label>Correo electrónico</label>
							<input type="email" placeholder="Escribe tu correo electrónico"  name="email">
							<label>Contraseña</label>
							<input type="password" placeholder="Escribe tu contraseña"  name="contrasena">
						</div>
						<p>
							<br>
							<button type="submit" class="btn btn-primary" name="login_user">Iniciar sesión</button>
						</p>
						<p style="font-size: 25px;">
							¿No estás registrado? <br><a href="register.php">¡Regístrate!</a>
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