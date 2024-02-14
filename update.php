<?php
session_start();

include_once("biblioteca/funciones.php");
require_once("config/connection.php");

$id = "";
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


//MANEJAMOS LOS POST DEL SELECT PARA MODIFICAR--------------

$modUser = isset($_POST["modUser"]) ? strip_tags(trim($_POST["modUser"])) : "";
$modPiso = isset($_POST["modPiso"]) ? strip_tags(trim($_POST["modPiso"])) : "";


// INSERTAR VALUES EN FORMULARIO USUARIOS

if (!$connexion) {
    die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
}

$sql = "SELECT `usuario_id`, `nombres`, `correo`, `clave`, `tipo_usuario` FROM `usuario`;";

$result = mysqli_query($connexion, $sql);


if (mysqli_num_rows($result) > 0) {

    while ($fila = mysqli_fetch_assoc($result)) {

        if ($modUser == $fila["usuario_id"]) {

            $id = $fila["usuario_id"];
            $nombre = $fila["nombres"];
            $correo = $fila["correo"];
            $clave = $fila["clave"];
            $tipo = $fila["tipo_usuario"];
        }
    }
}


// INSERTAR VALUES EN FORMULARIO PISOS


if (!$connexion) {
    die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
}

$sql = "SELECT * FROM `pisos`;";

$result = mysqli_query($connexion, $sql);


if (mysqli_num_rows($result) > 0) {

    while ($fila = mysqli_fetch_assoc($result)) {

        if ($modPiso == $fila["Codigo_piso"]) {

            $codigoPiso = $fila["Codigo_piso"];
            $calle = $fila["calle"];
            $numero = $fila["numero"];
            $piso = $fila["piso"];
            $puerta = $fila["puerta"];
            $cp = $fila["cp"];
            $metros = $fila["metros"];
            $zona = $fila["zona"];
            $precio = $fila["precio"];
            $imagen = $fila["imagen"];
            $usuarioId = $fila["usuario_id"];
        }
    }
}

//Llamadas a las funciones update

echo modifiedUser($connexion);
echo modifiedPiso($connexion);

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

    <div class="container-fluid bg-light">
        <!-- Header -->
        <div class="row">
            <div class="col-10">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand ms-5 mb-4" href="#">
                            <img src="imagenes/logoUE.jpg" alt="Logo" width="55" height="37" class="d-inline-block align-text-top fs-2">
                            InmoDAW->Admin
                        </a>
                    </div>
                </nav>
            </div>
            <div class="col-1 bg-warning">
                <h4 class="text-success text-center border-bottom">Usuario</h4>
                <h5 class="text-center text-white border-bottom"><?php echo $_SESSION["admin"] ?></h5>
            </div>
        </div>

        <!-- SELECT PARA MODIFICAR USUARIO Y PISO -->

        <div class="row">
            <h1 class="text-center bg-success text-dark bg-opacity-10">-MODIFICACION-</h1>
        </div>
        <div class="row mb-5">
            <div class="col-6 bg-light  border-start"><!-- Mod Usuario-->
                <h2 class="text-center mt-5 mb-4 bg-warning p-2 text-dark bg-opacity-50">Elige Usuario a Modificar</h2>
                <form action="#" method="post">
                    <select class="form-select" aria-label="Default select example" name="modUser"><!--  Seleccion de usuario -->
                        <option selected>Selecciona usuario a Modificar</option>
                        <?php echo userSelect($connexion) ?>
                    </select>
                    <button type="submit" class="btn btn-danger mt-4 mb-4">Enviar</button>
                </form>

            </div>

            <div class="col-6 bg-light border-end"><!-- Mod Piso-->
                <h2 class="text-center mt-5 mb-4 bg-warning p-2 text-dark bg-opacity-50">Elige Piso Modificar</h2>
                <form action="#" method="post">
                    <select class="form-select" aria-label="Default select example" name="modPiso"><!--  Seleccion de piso -->
                        <option selected>Selecciona piso a Modificar</option>
                        <?php echo pisoSelect($connexion) ?>
                    </select>
                    <button type="submit" class="btn btn-danger mt-4 mb-4">Enviar</button>
                </form>
            </div>
        </div>

        <!-- MODIFICAR USUARIO Y PISO -->

        <div class="row border-bottom mb-5">
            <div class="row bg-light">
                <div class="col-5 mx-auto border-4 border-end border-4"><!--  formulario Usuarios -->
                    <form action="#" method="post">
                        <div class="mb-3"><!--  usuario id -->
                            <label for="id" class="form-label mt-3">Id de Usuario</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>" readonly>
                        </div>
                        <div class="mb-3"><!--  nombre -->
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>">
                        </div>
                        <div class="mb-3"> <!--  email -->
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $correo ?>">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3"><!--  clave -->
                            <label for="clave" class="form-label">Clave</label>
                            <input type="text" class="form-control" id="clave" name="clave" value="<?php echo $clave ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-5">Modificar</button>
                    </form>


                </div>
                <div class="col-5 mx-auto ms-1"> <!--  formulario Pisos -->
                    <form action="#" method="post">
                        <div class="mb-3"><!--  Codigo Piso -->
                            <label for="codigoPiso" class="form-label">CodigoPiso</label>
                            <input type="number" class="form-control" id="codigoPiso" name="codigoPiso" value="<?php echo $codigoPiso ?>" readonly>
                        </div>
                        <div class="mb-3"><!--  calle -->
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" value="<?php echo $calle ?>">
                        </div>
                        <div class="mb-3"> <!--  numero -->
                            <label for="numero" class="form-label">Numero</label>
                            <input type="text" class="form-control" id="numero" aria-describedby="emailHelp" name="numero" value="<?php echo $numero ?>">
                        </div>

                        <div class="mb-3"><!--  piso -->
                            <label for="piso" class="form-label">Piso</label>
                            <input type="text" class="form-control" id="piso" name="piso" value="<?php echo $piso ?>">
                        </div>

                        <div class="mb-3"><!--  puerta -->
                            <label for="puerta" class="form-label">Puerta</label>
                            <input type="text" class="form-control" id="puerta" name="puerta" value="<?php echo $puerta ?>">
                        </div>

                        <div class="mb-3"><!--  cp -->
                            <label for="cp" class="form-label">Cp</label>
                            <input type="text" class="form-control" id="cp" name="cp" pattern="[0-9]{5}" value="<?php echo $cp ?>">
                        </div>

                        <div class="mb-3"><!--  metros -->
                            <label for="metros" class="form-label">Metros</label>
                            <input type="text" class="form-control" id="metros" name="metros" value="<?php echo $metros ?>">
                        </div>

                        <div class="mb-3"><!--  zona -->
                            <label for="zona" class="form-label">Zona</label>
                            <input type="text" class="form-control" id="zona" name="zona" value="<?php echo $zona ?>">
                        </div>


                        <div class="mb-3"><!--precio -->
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio ?>">
                        </div>

                        <div class="mb-3"><!--imagen -->
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo $imagen ?>">
                        </div>

                        <div class="mb-3"><!--usuario_id -->
                            <label for="usuario_id" class="form-label">Usuario Id</label>
                            <input type="text" class="form-control" id="usuario_id" name="usuario_id" value="<?php echo $usuarioId ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </form>

                </div>
            </div>

            <!--  Links -->
            <div class="row">
                <a href="index.php" class="btn btn-outline-dark mt-4" style="--bs-text-opacity: .5;" role="button">Index</a>
            </div>
            <div class="row">
                <a href="admin.php" class="btn btn-outline-success mt-4" style="--bs-text-opacity: .5;" role="button">Atras</a>
            </div>
        </div>
</body>

</html>