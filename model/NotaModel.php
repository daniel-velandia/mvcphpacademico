<?php

require_once("Conectar.php");

class NotaModel {

    private $id;
    private $previo1;
    private $previo2;
    private $nota3;
    private $examen;
    private $idMateria;
    private $idEstudiante;

    private $db;

    public function __construct() {

        $conn = new Conectar();
        $this->db = $conn->conexion;
    }
    
    public function matricular(){
		$consulta = "INSERT INTO nota (previo_1, previo_2, nota_3, examen, id_materia, id_estudiante) values(?, ?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->previo1, $this->previo2, $this->nota3, $this->examen, $this->idMateria, $this->idEstudiante]);
	}

    public function asignarNotas(){
		$consulta = "UPDATE nota SET previo_1 = ?, previo_2 = ?, nota_3 = ?, examen = ? WHERE id_materia = ? AND id_estudiante = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->previo1, $this->previo2, $this->nota3, $this->examen, $this->idMateria, $this->idEstudiante]);
	}

    public function ListarEstudiantesPorMateria(){
		$consulta = "SELECT usuario.nombre, usuario.apellido, nota.id, nota.previo_1, nota.previo_2, nota.nota_3, nota.examen, nota.id_materia, nota.id_estudiante FROM usuario INNER JOIN nota ON usuario.id = nota.id_estudiante WHERE nota.id_materia = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->idMateria]);

		return $stmt->fetchAll();
	}

    public function verMisNotas(){
		$consulta = "SELECT usuario.nombre, usuario.apellido, nota.id, nota.previo_1, nota.previo_2, nota.nota_3, nota.examen, nota.id_materia, nota.id_estudiante FROM usuario INNER JOIN nota ON usuario.id = nota.id_estudiante WHERE nota.id_materia = ? AND nota.id_estudiante = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->idMateria, $this->idEstudiante]);

		return $stmt->fetchAll();
	}

    // Métodos getter

    public function getId() {
        return $this->id;
    }

    public function getPrevio1() {
        return $this->previo1;
    }

    public function getPrevio2() {
        return $this->previo2;
    }

    public function getNota3() {
        return $this->nota3;
    }

    public function getExamen() {
        return $this->examen;
    }

    public function getIdMateria() {
        return $this->idMateria;
    }

    public function getIdEstudiante() {
        return $this->idEstudiante;
    }

    // Métodos setter

    public function setId($id) {
        $this->id = $id;
    }

    public function setPrevio1($previo1) {
        $this->previo1 = $previo1;
    }

    public function setPrevio2($previo2) {
        $this->previo2 = $previo2;
    }

    public function setNota3($nota3) {
        $this->nota3 = $nota3;
    }

    public function setExamen($examen) {
        $this->examen = $examen;
    }

    public function setIdMateria($idMateria) {
        $this->idMateria = $idMateria;
    }

    public function setIdEstudiante($idEstudiante) {
        $this->idEstudiante = $idEstudiante;
    }

}

?>