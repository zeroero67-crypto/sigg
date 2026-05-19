<?php

include("../conexion.php");

$id = $_GET['id'];
$estado = $_GET['estado'];

$sql = "UPDATE solicitudes
SET estado='$estado'
WHERE id='$id'";

$conn->query($sql);

header("Location: solicitudes.php");

?>