<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/EstadoDAO.php");

class Estado {
    private $id;
    private $valor;

    public function __construct($id = "", $valor = "") {
        $this->id = $id;
        $this->valor = $valor;
    }

    public function getId() {
        return $this->id;
    }

    public function getValor() {
        return $this->valor;
    }

    public function consultar() {

        $conexion = new Conexion();
        $conexion->abrir();
        $EstadoDAO=new EstadoDAO($this->id,$this->valor);
        $conexion->ejecutar($EstadoDAO->consultar());
        $estados = array();
        while (($registro = $conexion->registro()) != null) {
            $estado = new Estado($registro[0], $registro[1]);
            array_push($estados, $estado);
        }
        $conexion->cerrar();
        return $estados;
}
}