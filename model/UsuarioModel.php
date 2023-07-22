<?php

require_once("Conectar.php");

class UsuarioModel {

    private $id;
    private $documento;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $rol;

    private $db;

    public function __construct() {

        $conn = new Conectar();
        $this->db = $conn->conexion;
    }

    public function crearUsuario() {

        $consulta = "INSERT INTO usuario (documento, nombre, apellido, correo, clave, rol) values(?, ?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->documento, $this->nombre, $this->apellido, $this->correo, $this->clave, $this->rol]);
		return  $this->db->lastInsertId();
    }

    public function obtenerUsuarioPorId(){
		$consulta = "SELECT * FROM usuario WHERE id = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->id]);

		return $stmt->fetch();
	}

    public function obtenerUsuarioPorCorreo(){
		$consulta = "SELECT * FROM usuario WHERE correo = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->correo]);

		return $stmt->fetch();
	}

    public function listarUsuarios(){
		$consulta = "SELECT * FROM usuario WHERE rol = ?";
		$stmt = $this->db->prepare($consulta);
		$stmt->execute([$this->rol]);

		return $stmt->fetchAll();
	}

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getDocumento() {
        return $this->documento;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getApellido() {
        return $this->apellido;
    }
    
    public function getCorreo() {
        return $this->correo;
    }
    
    public function getClave() {
        return $this->clave;
    }
    
    public function getRol() {
        return $this->rol;
    }
    
    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
    
    public function setClave($clave) {
        $this->clave = $clave;
    }
    
    public function setRol($rol) {
        $this->rol = $rol;
    }

}

?>