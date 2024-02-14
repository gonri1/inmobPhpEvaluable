<?php
session_start();

include_once("biblioteca/funciones.php");
require_once("config/connection.php");


// Funcion para hacer la conexion con la BBDD

$connexion = conn();

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
        <div class="row">
            <div class="col-10">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand ms-5 mb-5" href="#">
                            <img src="imagenes/logoUE.jpg" alt="Logo" width="55" height="37" class="d-inline-block align-text-top fs-2">
                            InmoDAW->Admin
                        </a>
                    </div>
                </nav>
            </div>
            <div class="col-1 bg-warning">
                <h4 class="text-success text-center">Usuario</h4>
                <h5 class="text-center text-white"><?php echo $_SESSION["admin"] ?></h5>
            </div>
        </div>
        <div class="row mt-5">
            <h3 class="text-center mb-4">Inmuebles Vendidos</h3>
            <?php echo leerComprados($connexion) ?>
        </div>  
        <div class="row">
            <a href="index.php" class="btn btn-outline-dark mt-4" style="--bs-text-opacity: .5;" role="button">Index</a>
        </div>
        <div class="row mb-5">
            <a href="admin.php" class="btn btn-outline-success mt-4" style="--bs-text-opacity: .5;" role="button">Atras</a>
        </div>
    </div>
</body>

</html>