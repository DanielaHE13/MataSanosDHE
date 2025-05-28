<?php
class EstadoDAO {
    private $id;
    private $valor;

    public function __construct($id = "", $valor = "") {
        $this->id = $id;
        $this->valor = $valor;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getValor() {
        return $this->valor;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function consultar() {
        return "SELECT idEstadoCita, valor FROM EstadoCita";
    }
}
