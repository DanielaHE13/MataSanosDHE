<?php

class MedicoDAO
{
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $idMedico;
    private $idEspecialidad;

    public function __construct($idMedico = 0, $idEspecialidad = 0, $nombre = "", $apellido = "", $correo = "", $clave = "")
    {
        $this->idMedico = $idMedico;
        $this->idEspecialidad = $idEspecialidad;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
    }

    public function consultarPorEspecialidad($idEspecialidad)
    {
        return "SELECT idMedico, nombre, apellido, correo, clave, foto, Especialidad_id 
                FROM Medico 
                WHERE Especialidad_id = $idEspecialidad
                ORDER BY apellido ASC";
    }
}
