<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Administrador SIGSS</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/estilos.css">

</head>

<body>

<div class="sidebar">

<div class="text-center">

<img src="../img/logo.png" width="100">

</div>

<h2 class="mt-3">SIGSS</h2>

<hr>

<a href="dashboard.php">Inicio</a>

<a href="solicitudes.php">Solicitudes</a>

<a href="../logout.php">Cerrar Sesión</a>

</div>

<div class="content">

<div class="header">

<h2>
Panel Administrativo
</h2>

<p>
Control Institucional de Servicio Social
</p>

</div>

<div class="row">

<div class="col-md-4">

<div class="card shadow p-4 card-dashboard">

<h3>Solicitudes</h3>

<p>
Administrar solicitudes de alumnos
</p>

</div>

</div>

<div class="col-md-4">

<div class="card shadow p-4 card-dashboard">

<h3>Documentos</h3>

<p>
Revisión de archivos PDF
</p>

</div>

</div>

<div class="col-md-4">

<div class="card shadow p-4 card-dashboard">

<h3>Usuarios</h3>

<p>
Administración de cuentas
</p>

</div>

</div>

</div>

<div class="footer">

<hr>

<p>
SIGSS Administración © 2026
</p>

</div>

</div>

</body>
</html>