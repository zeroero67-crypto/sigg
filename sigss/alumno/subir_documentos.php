<?php

session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../login.php");
}

$usuario_id = $_SESSION['usuario']['id'];

$mensaje = "";
$error = "";

if(isset($_POST['subir'])){

    function subirArchivo($campo){

        if(isset($_FILES[$campo]) &&
           $_FILES[$campo]['error'] == 0){

            $extension = strtolower(
                pathinfo(
                    $_FILES[$campo]['name'],
                    PATHINFO_EXTENSION
                )
            );

            // SOLO PDF
            if($extension != "pdf"){
                return "ERROR_PDF";
            }

            // MAXIMO 5MB
            if($_FILES[$campo]['size'] > 5000000){
                return "ERROR_SIZE";
            }

            $nombre = time() . "_" .
            basename($_FILES[$campo]['name']);

            $ruta = "../uploads/documentos/" . $nombre;

            if(move_uploaded_file(
                $_FILES[$campo]['tmp_name'],
                $ruta
            )){
                return $nombre;
            }

            return "";

        }

        return "";

    }

    $curp = subirArchivo("curp");
    $ine = subirArchivo("ine");
    $kardex = subirArchivo("kardex");
    $carta_compromiso = subirArchivo("carta_compromiso");
    $carta_presentacion = subirArchivo("carta_presentacion");
    $reporte1 = subirArchivo("reporte1");
    $reporte2 = subirArchivo("reporte2");
    $reporte3 = subirArchivo("reporte3");
    $reporte4 = subirArchivo("reporte4");
    $constancia = subirArchivo("constancia");

    $archivos = [
        $curp,
        $ine,
        $kardex,
        $carta_compromiso,
        $carta_presentacion,
        $reporte1,
        $reporte2,
        $reporte3,
        $reporte4,
        $constancia
    ];

    foreach($archivos as $archivo){

        if($archivo == "ERROR_PDF"){
            $error = "Solo se permiten archivos PDF";
        }

        if($archivo == "ERROR_SIZE"){
            $error = "El archivo excede 5MB";
        }

    }

    if($error == ""){

        $stmt = $conn->prepare("
        INSERT INTO requisitos
        (
            usuario_id,
            curp,
            ine,
            kardex,
            carta_compromiso,
            carta_presentacion,
            reporte1,
            reporte2,
            reporte3,
            reporte4,
            constancia_terminacion
        )
        VALUES
        (?,?,?,?,?,?,?,?,?,?,?)
        ");

        $stmt->bind_param(
            "issssssssss",
            $usuario_id,
            $curp,
            $ine,
            $kardex,
            $carta_compromiso,
            $carta_presentacion,
            $reporte1,
            $reporte2,
            $reporte3,
            $reporte4,
            $constancia
        );

        if($stmt->execute()){
            $mensaje = "Documentos subidos correctamente";
        } else {
            $error = "Error al guardar";
        }

    }

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Subir Documentos</title>

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
Subida de Requisitos
</h2>

<p>
Carga de documentos institucionales
</p>

</div>

<div class="card shadow p-4">

<?php

if($mensaje != ""){
    echo "
    <div class='alert alert-success'>
    $mensaje
    </div>
    ";
}

if($error != ""){
    echo "
    <div class='alert alert-danger'>
    $error
    </div>
    ";
}

?>

<form method="POST"
enctype="multipart/form-data">

<div class="row">

<div class="col-md-6">

<label>CURP PDF</label>
<input type="file"
name="curp"
class="form-control mb-3"
accept=".pdf">

<label>INE PDF</label>
<input type="file"
name="ine"
class="form-control mb-3"
accept=".pdf">

<label>Kardex PDF</label>
<input type="file"
name="kardex"
class="form-control mb-3"
accept=".pdf">

<label>Carta Compromiso</label>
<input type="file"
name="carta_compromiso"
class="form-control mb-3"
accept=".pdf">

<label>Carta Presentación</label>
<input type="file"
name="carta_presentacion"
class="form-control mb-3"
accept=".pdf">

</div>

<div class="col-md-6">

<label>Reporte 1</label>
<input type="file"
name="reporte1"
class="form-control mb-3"
accept=".pdf">

<label>Reporte 2</label>
<input type="file"
name="reporte2"
class="form-control mb-3"
accept=".pdf">

<label>Reporte 3</label>
<input type="file"
name="reporte3"
class="form-control mb-3"
accept=".pdf">

<label>Reporte 4</label>
<input type="file"
name="reporte4"
class="form-control mb-3"
accept=".pdf">

<label>Constancia Terminación</label>
<input type="file"
name="constancia"
class="form-control mb-3"
accept=".pdf">

</div>

</div>

<button name="subir"
class="btn btn-success w-100 mt-3">

Subir Archivos

</button>

</form>

</div>

<div class="footer">

<hr>

<p>
SIGSS © 2026
</p>

</div>

</div>

</body>
</html>