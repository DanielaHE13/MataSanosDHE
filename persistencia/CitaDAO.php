<?php
class CitaDAO
{
    private $id;
    private $fecha;
    private $hora;
    private $paciente;
    private $medico;
    private $consultorio;
    private $estado;

    public function __construct($id = "", $fecha = "", $hora = "", $paciente = "", $medico = "", $consultorio = "", $estado = "")
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->paciente = $paciente;
        $this->medico = $medico;
        $this->consultorio = $consultorio;
        $this->estado = $estado;
    }

    public function consultar($rol, $id)
{
    $sentencia = "SELECT c.idCita, c.fecha, c.hora, 
                         p.idPaciente, p.nombre, p.apellido, 
                         m.idMedico, m.nombre, m.apellido, 
                         con.idConsultorio, con.nombre, 
                         e.idEstadoCita, e.valor
                  FROM Cita c
                  JOIN Paciente p ON c.Paciente_idPaciente = p.idPaciente
                  JOIN Medico m ON c.Medico_idMedico = m.idMedico
                  JOIN Consultorio con ON c.Consultorio_idConsultorio = con.idConsultorio
                  JOIN EstadoCita e ON c.EstadoCita_idEstadoCita = e.idEstadoCita
                  ORDER BY c.fecha ASC, c.hora ASC";
 ;

    if ($rol == "medico") {
        $sentencia .= " WHERE m.idMedico = '" . $id . "'";
    } else if ($rol == "paciente") {
        $sentencia .= " WHERE p.idPaciente = '" . $id . "'";
    }

    return $sentencia;
}
public function editarEstado()
    {
        return "UPDATE Cita SET EstadoCita_idEstadoCita = '{$this->estado}' WHERE idCita = '{$this->id}'";
    }
}
