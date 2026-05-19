<?php

session_start();
include("../conexion.php");

$buscar = "";

if(isset($_GET['buscar'])){
    $buscar = $_GET['buscar'];
}

$sql = "
SELECT solicitudes.*, usuarios.nombre
FROM solicitudes
INNER JOIN usuarios
ON solicitudes.usuario_id = usuarios.id
WHERE usuarios.nombre LIKE '%$buscar%'
";

$resultado = $conn->query($sql);

$total = $resultado->num_rows;

?>

<!DOCTYPE html>
<html>
<head>

<title>Solicitudes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/estilos.css">

</head>

<body>

<div class="sidebar">

<h2>SIGSS</h2>

<hr>

<a href="dashboard.php">Inicio</a>
<a href="solicitudes.php">Solicitudes</a>
<a href="../logout.php">Salir</a>

</div>

<div class="content">

<div class="card shadow p-4">

<h2>Solicitudes Registradas</h2>

<p>
Total:
<?php echo $total; ?>
</p>

<form method="GET">

<input type="text"
name="buscar"
class="form-control mb-3"
placeholder="Buscar alumno">

<button class="btn btn-primary">
Buscar
</button>

</form>

<table class="table table-bordered table-hover">

<tr>

<th>Alumno</th>
<th>Folio</th>
<th>Proyecto</th>
<th>Estado</th>
<th>Horas</th>
<th>Acciones</th>

</tr>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?php echo $fila['nombre']; ?></td>

<td><?php echo $fila['folio']; ?></td>

<td><?php echo $fila['proyecto']; ?></td>

<td><?php echo $fila['estado']; ?></td>

<td><?php echo $fila['horas']; ?></td>

<td>

<a href="aprobar.php?id=<?php echo $fila['id']; ?>&estado=Aprobado"
class="btn btn-success btn-sm">
Aprobar
</a>

<a href="aprobar.php?id=<?php echo $fila['id']; ?>&estado=En revision"
class="btn btn-warning btn-sm">
Revisión
</a>

<a href="aprobar.php?id=<?php echo $fila['id']; ?>&estado=Liberado"
class="btn btn-primary btn-sm">
Liberar
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>