<?php

require_once("Conectar.php");

class MateriaModel {

    private $id;
    private $nombre;
    private $hInicio;
    private $hFin;
    private $idDocente;

    private $db;

    public function __construct() {

        $conn = new Conectar();
        $this->db = $conn->conexion;
    }

    public function crearMateria() {

        $consulta = "INSERT INTO materia (nombre, h_inicio, h_fin, id_docente) values(?, ?, ?, ?)";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->nombre, $this->hInicio, $this->hFin, $this->idDocente]);
		return  $this->db->lastInsertId();
    }

    public function listarMaterias($Idusuario, $rolusuario){

        $consulta = "SELECT usuario.nombre as nombre_docente, usuario.apellido as apellido_docente, materia.id, materia.nombre AS nombre_materia FROM materia INNER JOIN usuario ON materia.id_docente = usuario.id";

        if($rolusuario == "estudiante") {

            $consulta = "SELECT usuario.nombre AS nombre_docente, usuario.apellido AS apellido_docente, materia.id, materia.nombre AS nombre_materia, nota.id_estudiante FROM ((materia INNER JOIN usuario ON materia.id_docente = usuario.id) INNER JOIN nota ON materia.id = nota.id_materia) WHERE nota.id_estudiante = " . $Idusuario;
        } elseif ($rolusuario == "docente") {
            
            $consulta = "SELECT usuario.nombre AS nombre_docente, usuario.apellido AS apellido_docente, materia.id, materia.nombre AS nombre_materia FROM materia INNER JOIN usuario ON materia.id_docente = usuario.id AND materia.id_docente = " . $Idusuario;
        }

		$stmt = $this->db->prepare($consulta);
		$stmt->execute();

		return $stmt->fetchAll();
	}
    
    public function asignarMateria(){
		$consulta = "INSERT INTO nota (id_materia, id_estudiante) values(?, ?)";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->nombre, $this->hInicio, $this->hFin, $this->idDocente]);
		return  $this->db->lastInsertId();
	}
    

    public function obtenerMateria(){
		$consulta = "SELECT * FROM materia WHERE id = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->id]);

		return $stmt->fetch();
	}

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }
    
    public function getHInicio() {
        return $this->hInicio;
    }
    
    public function getHFin() {
        return $this->hFin;
    }
    
    public function getIdDocente() {
        return $this->idDocente;
    }
    
    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setHInicio($hInicio) {
        $this->hInicio = $hInicio;
    }
    
    public function setHFin($hFin) {
        $this->hFin = $hFin;
    }
    
    public function setIdDocente($idDocente) {
        $this->idDocente = $idDocente;
    }

}

?>