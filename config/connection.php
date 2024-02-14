<?php
//Funcion para conectar a la BBDD

function conn()
{

    $servername = "localhost";
    $dbname = "inmobiliaria2";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    return $conn;
}

?>