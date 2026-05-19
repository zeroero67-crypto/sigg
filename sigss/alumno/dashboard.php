<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>SIGSS Alumno</title>

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

<a href="solicitar.php">
Solicitar Servicio
</a>

<a href="subir_documentos.php">
Subir Documentos
</a>

<a href="estado.php">
Estado
</a>

<a href="../logout.php">
Cerrar Sesión
</a>

</div>

<div class="content">

<div class="header">

<h2>
Sistema Integral de Gestión de Servicio Social
</h2>

<p>
Instituto Tecnológico
</p>

</div>

<h3>
Bienvenido
<?php echo $_SESSION['usuario']['nombre']; ?>
</h3>

<div class="row mt-4">

<div class="col-md-4">

<a href="solicitar.php" class="text-decoration-none">

<div class="card shadow p-4 card-dashboard">

<h3>Solicitud</h3>

<p>
Registrar solicitud de servicio social
</p>

<button class="btn btn-primary">
Ingresar
</button>

</div>

</a>

</div>

<div class="col-md-4">

<a href="subir_documentos.php" class="text-decoration-none">

<div class="card shadow p-4 card-dashboard">

<h3>Documentos</h3>

<p>
Subir archivos PDF institucionales
</p>

<button class="btn btn-success">
Ingresar
</button>

</div>

</a>

</div>

<div class="col-md-4">

<a href="estado.php" class="text-decoration-none">

<div class="card shadow p-4 card-dashboard">

<h3>Estado</h3>

<p>
Consultar seguimiento de solicitud
</p>

<button class="btn btn-warning">
Ingresar
</button>

</div>

</a>

</div>

</div>

<div class="footer">

<hr>

<p>
SIGSS © 2026 - Sistema Institucional
</p>

</div>

</div>

</body>
</html>