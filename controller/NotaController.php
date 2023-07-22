<?php

require_once("model/NotaModel.php");

class NotaController {

    public $notaModel;

    public function __construct() {

        $this->notaModel = new notaModel();
    }

    public function matricular() {

        $estudiantes = $_POST["estudiantesSeleccionados"];

        foreach ($estudiantes as $estudiante) {

            $this->notaModel->setPrevio1(0.0);
            $this->notaModel->setPrevio2(0.0);
            $this->notaModel->setNota3(0.0);
            $this->notaModel->setExamen(0.0);
            $this->notaModel->setIdMateria($_POST["materia"]);
            $this->notaModel->setIdEstudiante($estudiante);
    
            $this->notaModel->matricular();
        }

    }

    public function asignarNotas() {

        $notas = $_POST["notas"];

        foreach ($notas as $nota) {

            $this->notaModel->setPrevio1($nota["previo_1"]);
            $this->notaModel->setPrevio2($nota["previo_2"]);
            $this->notaModel->setNota3($nota["nota_3"]);
            $this->notaModel->setExamen($nota["examen"]);
            $this->notaModel->setIdMateria($_POST["id_materia"]);
            $this->notaModel->setIdEstudiante($nota["id_estudiante"]);

            $this->notaModel->asignarNotas();
        }

        return true;

    }
    
    public function ListarEstudiantesPorMateria() {
        $this->notaModel->setIdMateria($_GET["id"]);
        return $this->notaModel->ListarEstudiantesPorMateria();
    }

    public function verMisNotas() {
        $this->notaModel->setIdMateria($_GET["id"]);
        $this->notaModel->setIdEstudiante($_COOKIE["id_usuario"]);
        return $this->notaModel->verMisNotas();
    }

}

?>