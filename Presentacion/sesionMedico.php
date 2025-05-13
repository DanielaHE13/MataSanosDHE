<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["rol"] != "medico") {
    header("Location: index.php");
    exit();
}

$id = $_SESSION["id"];
$medico = new Medico($id);
$medico -> consultar();
echo "Hola " . $medico -> getNombre() . " " . $medico -> getApellido();
echo "Usted tiene la especialidad: " . $medico -> getEspecialidad() -> getNombre();
?>