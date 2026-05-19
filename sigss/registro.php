<?php

include("conexion.php");

if(isset($_POST['registrar'])){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nombre, correo, password)
            VALUES('$nombre','$correo','$password')";

    if($conn->query($sql)){
        echo "Usuario registrado";
    } else {
        echo "Error";
    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Registro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow">

<h2>Registro</h2>

<form method="POST">

<input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre">

<input type="email" name="correo" class="form-control mb-3" placeholder="Correo">

<input type="password" name="password" class="form-control mb-3" placeholder="Contraseña">

<button name="registrar" class="btn btn-success">
Registrarse
</button>

<button name="login"
class="btn btn-primary w-100">
<a href="index.php">
    Regresar
</a>
</button>
</form>

</div>

</div>

</body>
</html>