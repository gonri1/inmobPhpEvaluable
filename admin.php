<?php
session_start();

include_once("biblioteca/funciones.php");
require_once("config/connection.php");



$usuarioId = "";
$nombre = "";
$correo = "";
$clave = "";
$tipo = "";

$codPiso = "";
$calle = "";
$numero = "";
$piso = "";
$puerta = "";
$cp = "";
$metros = "";
$zona = "";
$precio = "";
$imagen = "";
$usuarioId = "";



// Funcion para hacer la conexion con la BBDD

$connexion = conn();



//MANEJAMOS LOS POST DEL SELECT PARA BORRAR---------------



$deleteUser = isset($_POST["deleteUser"]) ? strip_tags(trim($_POST["deleteUser"])) : "";
$deletePiso = isset($_POST["deletePiso"]) ? strip_tags(trim($_POST["deletePiso"])) : "";



//Llamamos a la funcion generica para borrar Pisos

echo detelePisos($connexion, $deletePiso);

//Llamamos a la funcion generica para borrar Usuarios

echo deteleUsuarios($connexion, $deleteUser);




//MANEJAMOS LOS POST DEL SELECT PARA MODIFICAR--------------

$modUser = isset($_POST["modUser"]) ? strip_tags(trim($_POST["modUser"])) : "";
$modPiso = isset($_POST["modPiso"]) ? strip_tags(trim($_POST["modPiso"])) : "";


//Insertar Usuario

$insertUserResult = insertUser($connexion);
echo $insertUserResult;

//Insertar Piso

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
        <div class="row mt-1">
            <div class="col-10">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand ms-5 mb-3" href="#">
                            <img src="imagenes/logoUE.jpg" alt="Logo" width="55" height="37" class="d-inline-block align-text-top fs-2">
                            InmoDAW->Admin
                        </a>
                    </div>
                </nav>
            </div>
            <div class="col-1 bg-warning">
                <h5 class="text-center text-white border-bottom"><?php echo $_SESSION["admin"] ?></h5>
                <h5 class="text-center text-danger border-bottom"><?php echo $_SESSION["name"] ?></h5>
            </div>
        </div>

        <!-- Listado de pisos y usuarios -->
        <div class="row  mt-2">
            <h3 class="text-center bg-Primary p-2 text-dark bg-opacity-10 mb-5">-LISTADO-</h3>
        </div>
        <div class="row border-bottom">
            <div class="col ms-1">
                <h4 class="text-center bg-success p-2 text-dark bg-opacity-10 mb-2">Pisos</h4>
                <?php echo leerPisos($connexion) ?>
            </div>
            <div class="col me-1">
                <h4 class="text-center bg-success p-2 text-dark bg-opacity-10 mb-2">Usuarios</h4>
                <?php echo leerUsuarios($connexion) ?>
            </div>
        </div>

        <!-- INSERTAR USUARIO Y PISO -->
        <div class="row">
            <h3 class="text-center bg-secondary p-2 text-dark bg-opacity-10">-ALTA-</h3>
        </div>
        <div class="row  mb-5">
            <div class="col-6 bg-light border-start"><!-- Insertar Usuario-->
                <h3 class="text-center mt-5 bg-success p-2 text-dark bg-opacity-10">usuario</h3>
                <div class="row">
                    <form action="#" method="post">
                        <div class="mb-3"><!--  nombre -->
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3"> <!--  email -->
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3"><!--  clave -->
                            <label for="clave" class="form-label">Clave</label>
                            <input type="text" class="form-control" id="clave" name="clave" required>
                        </div>
                        <select class="form-select" aria-label="Default select example" name="userSelect"><!--  Seleccion de tipo usuario -->
                            <option selected>Selecciona tipo de usuario</option>
                            <option value="comprador">Comprador</option>
                            <option value="vendedor">Vendedor</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-4">Enviar</button>
                    </form>
                </div>
            </div>

            <div class="col-6 bg-light  border-start"><!-- Insertar Piso-->
                <h3 class="text-center mt-5 bg-success p-2 text-dark bg-opacity-10">Piso</h3>
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
                        <input type="text" class="form-control" id="usuario_id" name="usuario_id">
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

        <!-- BORRAR USUARIO Y PISO -->
        <div class="row">
            <h3 class="text-center bg-success p-2 text-dark bg-opacity-10">-BORRADO-</h3>
        </div>
        <div class="row  mb-5">

            <div class="col-6 bg-light  border-end border-start"><!-- Borrar Usuario-->
                <h4 class="text-center mt-5 bg-success p-2 text-dark bg-opacity-10">Borrar Usuario</h4>
                <form action="#" method="post">
                    <select class="form-select" aria-label="Default select example" name="deleteUser"><!--  Seleccion de usuario -->
                        <option selected>Selecciona usuario a borrar</option>
                        <?php echo deteleUserSelect($connexion) ?>
                    </select>
                    <button type="submit" class="btn btn-warning mt-4">Enviar</button>
                </form>

            </div>

            <div class="col-6 bg-light  border-end border-start"><!-- Borrar Piso-->
                <h4 class="text-center mt-5 bg-success p-2 text-dark bg-opacity-10">Borrar Piso</h4>
                <form action="#" method="post">
                    <select class="form-select" aria-label="Default select example" name="deletePiso"><!--  Seleccion de piso -->
                        <option selected>Selecciona piso a borrar</option>
                        <?php echo detelePisoSelect($connexion) ?>
                    </select>
                    <button type="submit" class="btn btn-warning mt-4">Enviar</button>
                </form>
            </div>
        </div>
        <div class="row">
            <a href="index.php" class="btn btn-outline-dark mt-4" style="--bs-text-opacity: .5;" role="button">Index</a>
        </div>
        <div class="row"><!-- Links -->
            <a href="update.php" class="btn btn-outline-success mt-4" style="--bs-text-opacity: .5;" role="button">Modificar</a>
        </div>
        <div class="row">
            <a href="vendidos.php" class="btn btn-outline-dark mt-4" style="--bs-text-opacity: .5;" role="button">Vendidos</a>
        </div>

    </div>
</body>

</html>