<?php

$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
$mensaje = "";

if (isset($_POST['actualizarEstado'])) {
    $idCita = $_POST['idCita'];
    $nuevoEstado = $_POST['nuevoEstado'];

    $citaActualizar = new Cita($idCita);
    $citaActualizar->setEstado($nuevoEstado);
}
$cita = new Cita();
$citas = $cita->consultar($rol, $id);

include("presentacion/encabezado.php");
include("presentacion/menu" . ucfirst($rol) . ".php");
include_once("logica/Estado.php");

?>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Citas</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        echo $mensaje;

                        $cita = new Cita();
                        $citas = $cita->consultar($rol, $id);

                        $estado = new Estado();
                        $estados = $estado->consultar(); // devuelve array de objetos Estado

                        echo "<table class='table table-striped table-hover'>";
                        echo "<tr><td>Id</td><td>Fecha</td><td>Hora</td>";
                        if ($rol != "paciente") echo "<td>Paciente</td>";
                        if ($rol != "medico") echo "<td>Médico</td>";
                        echo "<td>Consultorio</td>";
                        if ($rol == "admin") {
                            echo "<td>Estado</td>";
                            echo "<td>Actualización Estado</td>";
                        }
                        echo "</tr>";

                        foreach ($citas as $cit) {
                            echo "<tr>";
                            echo "<td>" . $cit->getId() . "</td>";
                            echo "<td>" . $cit->getFecha() . "</td>";
                            echo "<td>" . $cit->getHora() . "</td>";
                            if ($rol != "paciente") {
                                echo "<td>" . $cit->getPaciente()->getNombre() . " " . $cit->getPaciente()->getApellido() . "</td>";
                            }
                            if ($rol != "medico") {
                                echo "<td>" . $cit->getMedico()->getNombre() . " " . $cit->getMedico()->getApellido() . "</td>";
                            }
                            echo "<td>" . $cit->getConsultorio()->getNombre() . "</td>";

                            if ($rol == "admin") {
                                
								echo "<td>" . $cit->getEstado()->getValor() . "</td>";


                                // Mostrar columna "Estado"
                                echo "<td>";
                                echo "<form method='POST'>";
                                echo "<input type='hidden' name='idCita' value='" . $cit->getId() . "'>";
                                echo "<select name='nuevoEstado' class='form-select'>";
                                foreach ($estados as $est) {
                                    $selected = ($cit->getEstado() == $est->getId()) ? "selected" : "";
                                    echo "<option value='" . $est->getId() . "' $selected>" . $est->getValor() . "</option>";
                                }
                                echo "</select>";
                                echo "<button type='submit' name='actualizarEstado' class='btn btn-primary btn-sm mt-1'>Actualizar</button>";
                                echo "</form>";
                                echo "</td>";
                            }

                            echo "</tr>";
                        }

                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
