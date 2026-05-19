
<!DOCTYPE html>
<html>
<head>

<title>Login SIGSS</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:linear-gradient(to right,#5c1028,#1d3f77);
    height:100vh;
}

.login-box{
    background:white;
    border-radius:15px;
    padding:40px;
    box-shadow:0px 5px 20px rgba(0,0,0,0.2);
}

</style>

</head>

<body>
<?php
session_start();
include("conexion.php");

if(isset($_POST['login'])){

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";

    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){

        $usuario = $resultado->fetch_assoc();

        if(password_verify($password, $usuario['password'])){

            $_SESSION['usuario'] = $usuario;

            if($usuario['rol'] == 'admin'){
                header("Location: admin/dashboard.php");
            } else {
                header("Location: alumno/dashboard.php");
            }

        } else {
            $error = "Contraseña incorrecta";
        }

    } else {
        $error = "Usuario no encontrado";
    }

}
?>

<div class="container h-100">

<div class="row h-100 justify-content-center align-items-center">

<div class="col-md-4">

<div class="login-box">

<div class="text-center mb-4">

<img src="img/logo.png" width="120">

<h2 class="mt-3">
SIGSS
</h2>

<p>
Sistema Integral de Servicio Social
</p>

</div>

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<input type="email"
name="correo"
class="form-control mb-3"
placeholder="Correo">

<input type="password"
name="password"
class="form-control mb-3"
placeholder="Contraseña">

<button name="login"
class="btn btn-primary w-100">

Iniciar Sesión

</button>

</form>

<a href="registro.php" class="d-block mt-3 text-center">
Registrarse
</a>

</div>

</div>

</div>

</div>

</body>
</html>