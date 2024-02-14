
<?php

//Funcion que nos indica el status de la conexion

function conectionStatus($conn)
{
    $output = "";

    if ($conn) {
        $output .= "OK";
    } else {
        $output .= "KO";
    }
    return $output;
}

//Insertar usuario generica

function insertUser($conn)
{

    $userName = isset($_POST["nombre"]) ? trim(strip_tags($_POST["nombre"])) : "";
    $userEmail = isset($_POST["email"]) ? trim(strip_tags($_POST["email"])) : "";
    $userClave = isset($_POST["clave"]) ? trim(strip_tags($_POST["clave"])) : "";
    $tipoUsuario = isset($_POST["userSelect"]) ? trim(strip_tags($_POST["userSelect"])) : "";


    if ($userName && $userClave && $userEmail && $tipoUsuario) {

        if (!$conn) {
            die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
        }

        $sql = "INSERT INTO `usuario`(`usuario_id`, `nombres`, `correo`, `clave`, `tipo_usuario`) VALUES ('','$userName','$userEmail','$userClave', '$tipoUsuario')";

        if (mysqli_query($conn, $sql)) {
            echo "Inserccion realizada";
        } else {
            echo "Error en la inserción: " . mysqli_error($conn);
        }
    }
}


// Logueo usuario propietario/comprador

function userInn($conn)
{

    $userPass = isset($_POST["userPassword"]) ? trim(strip_tags($_POST["userPassword"])) : "";
    $userName = isset($_POST["userName"]) ? trim(strip_tags($_POST["userName"])) : "";

    if ($userName && $userPass) {

        if (!$conn) {
            die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
        }

        $sql = "SELECT `nombres`, `clave`, `tipo_usuario`, `usuario_id` FROM `usuario`;";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            while ($fila = mysqli_fetch_assoc($result)) {

                if ($fila["nombres"] == $userName && $fila["clave"] == $userPass  && $fila["tipo_usuario"] == "comprador") {
                    header("Location:comprador.php");
                    $_SESSION["user"] = $userName;
                } elseif ($fila["nombres"] == $userName && $fila["clave"] == $userPass  && $fila["tipo_usuario"] == "vendedor") {
                    header("Location:vendedor.php");
                    $_SESSION["user"] = $userName;
                }
            }
        }
    }
}


//Funcion generica leer pisos

function leerPisos($conn)
{
    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `Codigo_piso`, `calle`, `numero`, `piso`, `puerta`, `cp`, `metros`, `zona`, `precio`, `imagen`, `usuario_id` FROM `pisos`;";

    $result = mysqli_query($conn, $sql);

    $output .= "<table class='table border border-primary'>";
    $output .= "<thead class='bg-info'>";
    $output .= "<tr>";
    $output .= "<th scope='col' class='bg-info'>Codigo</th>";
    $output .= "<th scope='col' class='bg-info'>calle</th>";
    $output .= "<th scope='col' class='bg-info'>numero</th>";
    $output .= "<th scope='col' class='bg-info'>piso</th>";
    $output .= "<th scope='col' class='bg-info'>puerta</th>";
    $output .= "<th scope='col' class='bg-info'>cp</th>";
    $output .= "<th scope='col' class='bg-info'>metros</th>";
    $output .= "<th scope='col' class='bg-info'>zona</th>";
    $output .= "<th scope='col' class='bg-info'>precio</th>";
    $output .= "<th scope='col' class='bg-info'>imagen</th>";
    $output .= "<th scope='col' class='bg-info'>Id User</th>";
    $output .= "</tr>";
    $output .= "</thead>";

    $output .= "  <tbody>";
    if (mysqli_num_rows($result) > 0) {

        while ($fila = mysqli_fetch_assoc($result)) {

            $output .= "<tr>";
            $output .= "<td scope='row'>" . $fila["Codigo_piso"] . "</td>";
            $output .= "<td>" . $fila["calle"] . "</td>";
            $output .= "<td>" . $fila["numero"] . "</td>";
            $output .= "<td>" . $fila["piso"] . "</td>";
            $output .= "<td>" . $fila["puerta"] . "</td>";
            $output .= "<td>" . $fila["cp"] . "</td>";
            $output .= "<td>" . $fila["metros"] . "</td>";
            $output .= "<td>" . $fila["zona"] . "</td>";
            $output .= "<td>" . $fila["precio"] . "</td>";
            $output .= "<td>" . $fila["imagen"] . "</td>";
            $output .= "<td>" . $fila["usuario_id"] . "</td>";
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";
    }

    return $output;
}


// Logueo Administrador

function adminInn($conn)
{

    $adminPass = isset($_POST["passwordAdmin"]) ? trim(strip_tags($_POST["passwordAdmin"])) : "";
    $adminName = isset($_POST["nameAdmin"]) ? trim(strip_tags($_POST["nameAdmin"])) : "";

    if ($adminName && $adminPass) {

        if (!$conn) {
            die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
        }

        $sql = "SELECT * FROM `admin`";

        $result = mysqli_query($conn, $sql);

        while ($fila = mysqli_fetch_assoc($result)) {

            if ($adminName == $fila["admin_name"] && $adminPass == $fila["admin_key"]) {
                header("Location:admin.php");
                $_SESSION["admin"] = "Admin";
                $_SESSION["name"] = $adminName;
            }
        }
    }
}

// Funcion Generica que lista todos los usuarios con sus campos

function leerUsuarios($conn)
{
    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `usuario_id`, `nombres`, `correo`, `clave`, `tipo_usuario` FROM `usuario`;";

    $result = mysqli_query($conn, $sql);

    $output .= "<table class='table border border-primary'>";
    $output .= "<thead class='bg-warning'>";
    $output .= "<tr>";
    $output .= "<th scope='col' class='bg-warning'>Id</th>";
    $output .= "<th scope='col' class='bg-warning'>Nombres</th>";
    $output .= "<th scope='col' class='bg-warning'>Correo</th>";
    $output .= "<th scope='col' class='bg-warning'>Clave</th>";
    $output .= "<th scope='col' class='bg-warning'>Tipo Usuario</th>";
    $output .= "</tr>";
    $output .= "</thead>";
    $output .= "  <tbody>";
    if (mysqli_num_rows($result) > 0) {

        while ($fila = mysqli_fetch_assoc($result)) {

            $output .= "<tr>";
            $output .= "<td scope='row'>" . $fila["usuario_id"] . "</td>";
            $output .= "<td>" . $fila["nombres"] . "</td>";
            $output .= "<td>" . $fila["correo"] . "</td>";
            $output .= "<td>" . $fila["clave"] . "</td>";
            $output .= "<td>" . $fila["tipo_usuario"] . "</td>";
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";
    }

    return $output;
}


//Funcion para insertar piso

function insertPiso($conn)
{
    $codigoPiso = isset($_POST["codigoPiso"]) ? trim(strip_tags($_POST["codigoPiso"])) : "";
    $calle = isset($_POST["calle"]) ? trim(strip_tags($_POST["calle"])) : "";
    $numero = isset($_POST["numero"]) ? trim(strip_tags($_POST["numero"])) : "";
    $piso = isset($_POST["piso"]) ? trim(strip_tags($_POST["piso"])) : "";
    $puerta = isset($_POST["puerta"]) ? trim(strip_tags($_POST["puerta"])) : "";
    $cp = isset($_POST["cp"]) ? trim(strip_tags($_POST["cp"])) : "";
    $metros = isset($_POST["metros"]) ? trim(strip_tags($_POST["metros"])) : "";
    $zona = isset($_POST["zona"]) ? trim(strip_tags($_POST["zona"])) : "";
    $precio = isset($_POST["precio"]) ? trim(strip_tags($_POST["precio"])) : "";
    $imagen = isset($_POST["imagen"]) ? trim(strip_tags($_POST["imagen"])) : "";
    $usuario_id = isset($_POST["usuario_id"]) ? trim(strip_tags($_POST["usuario_id"])) : "";

    if ($codigoPiso && $calle && $numero && $piso && $puerta && $cp && $metros && $zona && $precio && $imagen && $usuario_id) {

        if (!$conn) {
            die("Conexion con BBDD ha fallado: " . mysqli_connect_error());
        }


        $sql = "INSERT INTO `pisos`(`Codigo_piso`, `calle`, `numero`, `piso`, `puerta`, `cp`, `metros`, `zona`, `precio`, `imagen`, `usuario_id`) VALUES ('$codigoPiso','$calle','$numero','$piso','$puerta','$cp','$metros','$zona','$precio','$imagen','$usuario_id');";

        if (mysqli_query($conn, $sql)) {
            echo "Inserccion correcta";
        } else {
            echo "Error en la inserción: " . mysqli_error($conn);
        }
    }
}


//Funcion para Crear el select para borrar los usuarios

function deteleUserSelect($conn)
{

    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `nombres`, `usuario_id` FROM `usuario`;";

    $result = mysqli_query($conn, $sql);



    while ($fila = mysqli_fetch_assoc($result)) {

        $output .= "<option value=" . $fila["usuario_id"] . ">" . $fila["nombres"] . "</option>";
    }

    return $output;
}


//Funcion para Crear el select para borrar los pisos

function detelePisoSelect($conn)
{

    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `Codigo_piso`, `calle` FROM `pisos`;";

    $result = mysqli_query($conn, $sql);



    while ($fila = mysqli_fetch_assoc($result)) {

        $output .= "<option value=" . $fila["Codigo_piso"] . ">" . $fila["calle"] . "</option>";
    }

    return $output;
}


//Funcion de lectura de piso en la pagina de compradores

function leerPisosComprador($conn)
{
    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `Codigo_piso`, `calle`, `numero`, `piso`, `puerta`, `cp`, `metros`, `zona`, `precio`, `imagen`, `usuario_id` FROM `pisos`;";

    $result = mysqli_query($conn, $sql);

    $output .= "<table class='table border border-primary'>";
    $output .= "<thead class='bg-info'>";
    $output .= "<tr>";
    $output .= "<th scope='col' class='bg-info'>Codigo</th>";
    $output .= "<th scope='col' class='bg-info'>calle</th>";
    $output .= "<th scope='col' class='bg-info'>numero</th>";
    $output .= "<th scope='col' class='bg-info'>piso</th>";
    $output .= "<th scope='col' class='bg-info'>puerta</th>";
    $output .= "<th scope='col' class='bg-info'>cp</th>";
    $output .= "<th scope='col' class='bg-info'>metros</th>";
    $output .= "<th scope='col' class='bg-info'>zona</th>";
    $output .= "<th scope='col' class='bg-info'>precio</th>";
    $output .= "<th scope='col' class='bg-info'>imagen</th>";
    $output .= "<th scope='col' class='bg-info'>Comprar</th>";
    $output .= "</tr>";
    $output .= "</thead>";

    $output .= "  <tbody>";
    if (mysqli_num_rows($result) > 0) {

        while ($fila = mysqli_fetch_assoc($result)) {

            $output .= "<tr>";
            $output .= "<td scope='row'>" . $fila["Codigo_piso"] . "</td>";
            $output .= "<td>" . $fila["calle"] . "</td>";
            $output .= "<td>" . $fila["numero"] . "</td>";
            $output .= "<td>" . $fila["piso"] . "</td>";
            $output .= "<td>" . $fila["puerta"] . "</td>";
            $output .= "<td>" . $fila["cp"] . "</td>";
            $output .= "<td>" . $fila["metros"] . "</td>";
            $output .= "<td>" . $fila["zona"] . "</td>";
            $output .= "<td>" . $fila["precio"] . "</td>";
            $output .= "<td>" . $fila["imagen"] . "</td>";
            $output .= "<td><a href='compras.php?codigo_piso=" . $fila["Codigo_piso"] . "&usuario=" . $fila["usuario_id"] . "&precio=" . $fila["precio"] . "' class='btn btn-warning'>Agrega</a></td>";
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";
    }

    return $output;
}

//Funcion de lectura de carrito en compras.php

function leerPisosCompradorCarrito($conn, $data)
{
    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }
    $sql = "SELECT * FROM `pisos` WHERE `Codigo_piso`='$data';";

    $result = mysqli_query($conn, $sql);

    $output .= "<table class='table border border-primary'>";
    $output .= "<thead class='bg-info'>";
    $output .= "<tr>";
    $output .= "<th scope='col' class='bg-info'>Codigo</th>";
    $output .= "<th scope='col' class='bg-info'>calle</th>";
    $output .= "<th scope='col' class='bg-info'>numero</th>";
    $output .= "<th scope='col' class='bg-info'>piso</th>";
    $output .= "<th scope='col' class='bg-info'>puerta</th>";
    $output .= "<th scope='col' class='bg-info'>cp</th>";
    $output .= "<th scope='col' class='bg-info'>metros</th>";
    $output .= "<th scope='col' class='bg-info'>zona</th>";
    $output .= "<th scope='col' class='bg-info'>precio</th>";
    $output .= "</tr>";
    $output .= "</thead>";

    $output .= "  <tbody>";
    if (mysqli_num_rows($result) > 0) {

        while ($fila = mysqli_fetch_assoc($result)) {

            $output .= "<tr>";
            $output .= "<td scope='row'>" . $fila["Codigo_piso"] . "</td>";
            $output .= "<td>" . $fila["calle"] . "</td>";
            $output .= "<td>" . $fila["numero"] . "</td>";
            $output .= "<td>" . $fila["piso"] . "</td>";
            $output .= "<td>" . $fila["puerta"] . "</td>";
            $output .= "<td>" . $fila["cp"] . "</td>";
            $output .= "<td>" . $fila["metros"] . "</td>";
            $output .= "<td>" . $fila["zona"] . "</td>";
            $output .= "<td>" . $fila["precio"] . "</td>";
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";
    }

    return $output;
}

//Sacamos la id del usuario para vendedor.php

function userId($conn, $data)
{
    if (!$conn) {
        die("Conexion con BBDD ha fallado: " . mysqli_connect_error());
    }

    $data = mysqli_real_escape_string($conn, $data);

    $sql = "SELECT `usuario_id` FROM `usuario` WHERE `nombres`='$data';";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['usuario_id'];
}

//Funcion para borrar Pisos

function detelePisos($conn, $data)
{

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "DELETE FROM `pisos` WHERE `Codigo_piso`='$data';";

    $result = mysqli_query($conn, $sql);

    return $result;
}

//Funcion para borrar Usuarios

function deteleUsuarios($conn, $data)
{

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "DELETE FROM `usuario` WHERE `usuario_id`='$data';";

    $result = mysqli_query($conn, $sql);

    return $result;
}

//Funcion para Crear el select para borrar los usuarios

function userSelect($conn)
{

    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `nombres`, `usuario_id` FROM `usuario`;";

    $result = mysqli_query($conn, $sql);



    while ($fila = mysqli_fetch_assoc($result)) {

        $output .= "<option value=" . $fila["usuario_id"] . ">" . $fila["nombres"] . "</option>";
    }

    return $output;
}


//Funcion para Crear el select para borrar los pisos

function pisoSelect($conn)
{

    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT `Codigo_piso`, `calle` FROM `pisos`;";

    $result = mysqli_query($conn, $sql);



    while ($fila = mysqli_fetch_assoc($result)) {

        $output .= "<option value=" . $fila["Codigo_piso"] . ">" . $fila["calle"] . "</option>";
    }

    return $output;
}

//Funcion para update piso

function modifiedPiso($conn)
{
    $codigoPiso = isset($_POST["codigoPiso"]) ? trim(strip_tags($_POST["codigoPiso"])) : "";
    $calle = isset($_POST["calle"]) ? trim(strip_tags($_POST["calle"])) : "";
    $numero = isset($_POST["numero"]) ? trim(strip_tags($_POST["numero"])) : "";
    $piso = isset($_POST["piso"]) ? trim(strip_tags($_POST["piso"])) : "";
    $puerta = isset($_POST["puerta"]) ? trim(strip_tags($_POST["puerta"])) : "";
    $cp = isset($_POST["cp"]) ? trim(strip_tags($_POST["cp"])) : "";
    $metros = isset($_POST["metros"]) ? trim(strip_tags($_POST["metros"])) : "";
    $zona = isset($_POST["zona"]) ? trim(strip_tags($_POST["zona"])) : "";
    $precio = isset($_POST["precio"]) ? trim(strip_tags($_POST["precio"])) : "";
    $imagen = isset($_POST["imagen"]) ? trim(strip_tags($_POST["imagen"])) : "";
    $usuario_id = isset($_POST["usuario_id"]) ? trim(strip_tags($_POST["usuario_id"])) : "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "UPDATE `pisos` SET `calle`='$calle', `numero`='$numero', `piso`='$piso', `puerta`='$puerta', `cp`='$cp', `metros`='$metros', `zona`='$zona', `precio`='$precio', `imagen`='$imagen', `usuario_id`='$usuario_id' WHERE `Codigo_piso`='$codigoPiso'";

    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error en la actualización: " . mysqli_error($conn);
    }
}

//Funcion para update usuarios

function modifiedUser($conn)
{
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $correo = isset($_POST["email"]) ? $_POST["email"] : "";
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : "";



    if ($id && ($nombre || $correo || $clave)) {

        if (!$conn) {
            die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
        }

        $sql = "UPDATE `usuario` SET `nombres`='$nombre', `correo`='$correo', `clave`='$clave' WHERE `usuario_id`='$id'";


        mysqli_query($conn, $sql);
    }
}

//Insercion de pisos comprados en tabla comprados

function insertComprado($conn, $data1, $data2, $data3)
{

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "INSERT INTO `comprados`(`usuario_comprador`, `Codigo_piso`, `Precio_final`) VALUES ('$data1','$data2','$data3');";

    if (mysqli_query($conn, $sql)) {
        echo "Inserccion realizada";
    } else {
        echo "Error en la inserción: " . mysqli_error($conn);
    }
}

//Leer comprados

function leerComprados($conn)
{
    $output = "";

    if (!$conn) {
        die("Conexion con BBDD ha fallado :" . mysqli_connect_error());
    }

    $sql = "SELECT * FROM `comprados`";

    $result = mysqli_query($conn, $sql);

    $output .= "<table class='table border border-primary'>";
    $output .= "<thead class='bg-warning'>";
    $output .= "<tr>";
    $output .= "<th scope='col' class='bg-warning'>Id comprador</th>";
    $output .= "<th scope='col' class='bg-warning'>Codigo Piso</th>";
    $output .= "<th scope='col' class='bg-warning'>Precio Final</th>";
    $output .= "</tr>";
    $output .= "</thead>";
    $output .= "  <tbody>";
    if (mysqli_num_rows($result) > 0) {

        while ($fila = mysqli_fetch_assoc($result)) {

            $output .= "<tr>";
            $output .= "<td scope='row'>" . $fila["usuario_comprador"] . "</td>";
            $output .= "<td>" . $fila["Codigo_piso"] . "</td>";
            $output .= "<td>" . $fila["Precio_final"] . "</td>";
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";
    }

    return $output;
}
