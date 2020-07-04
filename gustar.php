<?php
require "sesion.php";
if (isset($_POST['boton'])) {
    $valor = $_POST['boton'];

    $miId = $_SESSION['id'];

    $query = "INSERT INTO megusta (usuario, le_gusta) 
					  VALUES('$miId', '$valor')";
    mysqli_query($conexion, $query);
}
if (isset($_POST['boton2'])) {
    $valor = $_POST['boton2'];

    $miId = $_SESSION['id'];

    $query = "INSERT INTO megusta (usuario, le_gusta) 
					  VALUES('$miId', '$valor')";
    mysqli_query($conexion, $query);
}
if (isset($_POST['boton3'])) {
    $valor = $_POST['boton3'];

    $miId = $_SESSION['id'];

    $query = "INSERT INTO megusta (usuario, le_gusta) 
					  VALUES('$miId', '$valor')";
    mysqli_query($conexion, $query);
}