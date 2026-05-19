<?php

session_start();
include("../conexion.php");

$usuario_id = $_SESSION['usuario']['id'];

$sql = "
SELECT *
FROM solicitudes
WHERE usuario_id='$usuario_id'
ORDER BY id DESC
";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>

<title>Estado</title>

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

<h2>Estado de Solicitudes</h2>

<table class="table table-bordered">

<tr>

<th>Folio</th>
<th>Proyecto</th>
<th>Estado</th>
<th>Horas</th>
<th>Fecha</th>

</tr>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td>
<?php echo $fila['folio']; ?>
</td>

<td>
<?php echo $fila['proyecto']; ?>
</td>

<td>

<?php

$estado = $fila['estado'];

if($estado == "Pendiente"){
    echo "<span class='badge bg-secondary'>Pendiente</span>";
}

if($estado == "En revision"){
    echo "<span class='badge bg-warning'>En revisión</span>";
}

if($estado == "Aprobado"){
    echo "<span class='badge bg-success'>Aprobado</span>";
}

if($estado == "Liberado"){
    echo "<span class='badge bg-primary'>Liberado</span>";
}

?>

</td>

<td>
<?php echo $fila['horas']; ?>
</td>

<td>
<?php echo $fila['fecha']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>