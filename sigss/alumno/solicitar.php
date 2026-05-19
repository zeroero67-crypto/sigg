<?php

session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

if(isset($_POST['solicitar'])){

    $usuario_id = $_SESSION['usuario']['id'];

    $carrera = trim($_POST['carrera']);
    $semestre = trim($_POST['semestre']);
    $proyecto = trim($_POST['proyecto']);

    $folio = "SIGSS-" . rand(1000,9999);

    $stmt = $conn->prepare("
    INSERT INTO solicitudes
    (usuario_id,carrera,semestre,proyecto,folio)
    VALUES (?,?,?,?,?)
    ");

    $stmt->bind_param(
        "issss",
        $usuario_id,
        $carrera,
        $semestre,
        $proyecto,
        $folio
    );

    if($stmt->execute()){
        $mensaje = "Solicitud enviada correctamente";
    } else {
        $mensaje = "Error";
    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Solicitud</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/estilos.css">

</head>

<body>

<div class="sidebar">

<h2>SIGSS</h2>

<hr>

<a href="dashboard.php">Inicio</a>
<a href="solicitar.php">Solicitud</a>
<a href="subir_documentos.php">Documentos</a>
<a href="estado.php">Estado</a>
<a href="../logout.php">Salir</a>

</div>

<div class="content">

<div class="card shadow p-4">

<h2>Solicitud de Servicio Social</h2>

<?php
if(isset($mensaje)){
    echo "<div class='alert alert-success'>$mensaje</div>";
}
?>

<form method="POST">

<label>Carrera</label>

<input type="text"
name="carrera"
class="form-control mb-3"
required>

<label>Semestre</label>

<input type="text"
name="semestre"
class="form-control mb-3"
required>

<label>Proyecto</label>

<select name="proyecto"
class="form-control mb-3">

<option>Desarrollo Web</option>
<option>Soporte Técnico</option>
<option>Base de Datos</option>
<option>Vinculación</option>

</select>

<button name="solicitar"
class="btn btn-primary">

Enviar Solicitud

</button>

</form>

</div>

</div>

</body>
</html>