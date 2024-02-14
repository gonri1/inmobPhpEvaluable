<?php

session_start();

include_once("biblioteca/funciones.php");
require_once("config/connection.php");

$connexion = conn();

//Logueo de propietarios y compradores

$userPass = isset($_POST["userPassword"]) ? trim(strip_tags($_POST["userPassword"])) : "";
$userName = isset($_POST["userName"]) ? trim(strip_tags($_POST["userName"])) : "";


//Logueo usuarios

userInn($connexion);

//Logueo Admin

adminInn($connexion);

//Insertar usuario

insertUser($connexion);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InmoDAW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/estilos.css">
</head>

<body>

    <div class="container bg-light">

        <!-- Header -->
        <div class="row border-bottom">
            <div class="col-11 border-top">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand ms-5 mb-5" href="#">
                            <img src="imagenes/logoUE.jpg" alt="Logo" width="55" height="37" class="d-inline-block align-text-top fs-2">
                            InmoDAW
                        </a>
                    </div>
                </nav>
            </div>
            <div class="col-1 bg-light">
                <p class="text-black text-center mt-2">BBDD Status</p>
                <h5 class="text-center text-black"><?php echo conectionStatus($connexion) ?></h5>
            </div>
        </div>

        <!-- LOGUINS -->

        <div class="row mt-3">
            <div class="col-4 ms-5 bg-light mb-3 border-end "> <!-- Logueo Usuario -->
                <h2 class="text-center border-bottom mb-1 bg-success p-2 text-dark bg-opacity-10">Login</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="userName" aria-describedby="name">
                        <div id="emailHelp" class="form-text">We'll never share your name with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordUser" name="userPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Acceder</button>
                </form>
            </div>

            <div class="col-4 bg-light mx-auto border-end"><!-- Logueo Admin -->
                <h2 class="text-center border-bottom mb-1 bg-success p-2 text-dark bg-opacity-10">Administrador</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="nameAdmin" aria-describedby="name">
                        <div id="emailHelp" class="form-text">We'll never share your name with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="passwordAdmin">
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Acceder</button>
                </form>
            </div>

            <div class="col-3 mb-3 mx-auto text-center bg-light"><!-- Acceso invitado Usuario -->
                <h2 class="border-bottom mb-1 bg-success p-2 text-dark bg-opacity-10">Invitado</h2>
                <a href="invitado.php" class="btn btn-danger mt-4" role="button">Acceder</a>
            </div>

        </div>

        <!-- FORMULARIO DE ALTA -->

        <div class="container">
            <div class="row justify-content-center border-top">
                <div class="col-6 bg-light">
                    <h2 class="text-center mt-5 bg-success p-2 text-dark bg-opacity-10">Alta nuevo usuario</h2>
                    <div class="row">
                        <div class="col-12">
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
                </div>
            </div>
        </div>
    </div>

</body>

</html>