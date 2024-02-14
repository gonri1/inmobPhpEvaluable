<?php
session_start();

include_once("biblioteca/funciones.php");
require_once("config/connection.php");

// Funcion para hacer la conexion con la BBDD

$connexion = conn();

//Sacamos user Id para que en el formulario nos aparezca por defecto y solo lectura, su id

$userId = userId($connexion, $_SESSION["user"]);

// LLamamos a la funcion generica de insertar Piso

echo insertPiso($connexion);


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
        <div class="row border-bottom">
            <div class="col-11">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand ms-5 mb-5" href="#">
                            <img src="imagenes/logoUE.jpg" alt="Logo" width="55" height="37" class="d-inline-block align-text-top fs-2">
                            InmoDAW->Vendedor
                        </a>
                    </div>
                </nav>
            </div>
            <div class="col-1 bg-warning">
                <h4 class="text-success text-center">Usuario</h4>
                <h5 class="text-center text-white"><?php echo $_SESSION["user"] ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-9 bg-light border-top border-end border-start ms-5"><!-- Insertar Piso-->
                <h2 class="text-center mt-5">Alta nuevo Piso</h2>
                <form action="#" method="post">
                    <div class="mb-3"><!--  Codigo Piso -->
                        <label for="codigoPiso" class="form-label">CodigoPiso</label>
                        <input type="number" class="form-control" id="codigoPiso" name="codigoPiso">
                    </div>
                    <div class="mb-3"><!--  calle -->
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control" id="calle" name="calle">
                    </div>
                    <div class="mb-3"> <!--  numero -->
                        <label for="numero" class="form-label">Numero</label>
                        <input type="text" class="form-control" id="numero" aria-describedby="emailHelp" name="numero">
                    </div>

                    <div class="mb-3"><!--  piso -->
                        <label for="piso" class="form-label">Piso</label>
                        <input type="text" class="form-control" id="piso" name="piso">
                    </div>

                    <div class="mb-3"><!--  puerta -->
                        <label for="puerta" class="form-label">Puerta</label>
                        <input type="text" class="form-control" id="puerta" name="puerta">
                    </div>

                    <div class="mb-3"><!--  cp -->
                        <label for="cp" class="form-label">Cp</label>
                        <input type="text" class="form-control" id="cp" name="cp" pattern="[0-9]{5}">
                    </div>

                    <div class="mb-3"><!--  metros -->
                        <label for="metros" class="form-label">Metros</label>
                        <input type="text" class="form-control" id="metros" name="metros">
                    </div>

                    <div class="mb-3"><!--  zona -->
                        <label for="zona" class="form-label">Zona</label>
                        <input type="text" class="form-control" id="zona" name="zona">
                    </div>


                    <div class="mb-3"><!--precio -->
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio">
                    </div>

                    <div class="mb-3"><!--imagen -->
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="text" class="form-control" id="imagen" name="imagen">
                    </div>

                    <div class="mb-3"><!--usuario_id -->
                        <label for="usuario_id" class="form-label">Usuario Id</label>
                        <input type="text" class="form-control" id="usuario_id" name="usuario_id" value="<?php echo $userId ?>" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
            <div class="row mb-2">
                <a href="index.php" class="btn btn-outline-dark mt-4" style="--bs-text-opacity: .5;" role="button">Index</a>
            </div>
        </div>
    </div>
</body>

</html>