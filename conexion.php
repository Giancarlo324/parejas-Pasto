<?php

$mysqli_host="localhost";
$mysqli_user="root";
$mysqli_password="";
$mysqli_db="encuentros";

$conexion = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_password,$mysqli_db);
if(!$conexion)
    if (mysqli_connect_errno()) echo "Error con la conexión " . mysqli_connect_errno();
    else echo "Conexión correcta ";
?>