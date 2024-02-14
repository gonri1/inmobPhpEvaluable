<?php
session_start();

include_once("biblioteca/funciones.php");
require_once("config/connection.php");

$connexion = conn();

//Capturamos lo que nos llega por $_GET

$usuario = $_GET["usuario"];
$id = $_GET["codigo_piso"];
$precio = $_GET["precio"];



insertComprado($connexion, $usuario, $id, $precio);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/estilos.css">
</head>

<body>

    <div class="container bg-light">

        <!-- Header -->
        <div class="row mb-3">
            <div class="col-11">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand ms-5 mb-4" href="#">
                            <img src="imagenes/logoUE.jpg" alt="Logo" width="55" height="37" class="d-inline-block align-text-top fs-2">
                            InmoDAW-Comprador
                        </a>
                    </div>
                </nav>
            </div>
            <div class="col-1 bg-warning">
                <h4 class="text-success text-center border-bottom">Usuario</h4>
                <h5 class="text-center text-white border-bottom"><?php echo $_SESSION["user"] ?></h5>
            </div>
        </div>

        <div class="row mb-2"> <!-- lista de pisos comprados -->
            <div class="container">
                <h3 class="bg-success p-2 text-dark bg-opacity-10">Enhorabuena...</h3>
            </div>

        </div>
        <div class="row">
            <?php echo leerPisosCompradorCarrito($connexion, $id) ?>
        </div>
        <div class="row">
            <a href="index.php" class="btn btn-outline-dark mt-4" style="--bs-text-opacity: .5;" role="button">Index</a>
            <a href="comprador.php" class="btn btn-outline-danger mt-4" style="--bs-text-opacity: .5;" role="button">Atras</a>
        </div>
    </div>
</body>

</html>