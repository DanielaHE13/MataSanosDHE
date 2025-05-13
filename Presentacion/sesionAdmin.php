<?php

session_start();
if (!isset($_SESSION["id"]) || $_SESSION["rol"] != "admin") {
    header("Location: index.php");
    exit();
}
$id = $_SESSION["id"];
$admin = new Admin($id);
$admin -> consultar();
echo "Hola " . $admin -> getNombre() . " " . $admin -> getApellido();
?>


AQUI VA EL MENU