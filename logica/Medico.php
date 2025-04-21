<?php
require_once("logica/Persona.php");
require_once("persistencia/Conexion.php");
require_once("persistencia/MedicoDAO.php");

class Medico extends Persona
{
    private $idMedico;
    private $idEspecialidad;

    // Constructor
    public function __construct($idMedico = "", $idEspecialidad = "", $nombre = "", $apellido = "", $correo = "", $clave = "")
    {
        parent::__construct($nombre, $apellido, $correo, $clave);
        $this->idMedico = $idMedico;
        $this->idEspecialidad = $idEspecialidad;
    }
    // Consulta
    public function consultarPorEspecialidad($idEspecialidad)
    {
        $conexion = new Conexion();
        $medicoDAO = new MedicoDAO();
        $conexion->abrir();
        $conexion->ejecutar($medicoDAO->consultarPorEspecialidad($idEspecialidad));
        $medicos = array();

        while (($datos = $conexion->registro()) != null) {
            $medico = new Medico(
                $datos[0], // idMedico
                $datos[6], // idEspecialidad
                $datos[1], // nombre
                $datos[2], // apellido
                $datos[3], // correo
                $datos[4]  // clave
            );
            array_push($medicos, $medico);
        }

        $conexion->cerrar();
        return $medicos;
    }



    // Getters
    public function getIdMedico()
    {
        return $this->idMedico;
    }

    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }

    // Setters
    public function setIdMedico($idMedico)
    {
        $this->idMedico = $idMedico;
    }

    public function setIdEspecialidad($idEspecialidad)
    {
        $this->idEspecialidad = $idEspecialidad;
    }
}
