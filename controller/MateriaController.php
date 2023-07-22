<?php

require_once("model/MateriaModel.php");

class MateriaController {

    public $materiaModel;

    public function __construct() {

        $this->materiaModel = new MateriaModel();
    }

    public function crearMateria() {

        $this->materiaModel->setNombre($_POST["nombre"]);
        $this->materiaModel->setHInicio($_POST["hInicio"]);
        $this->materiaModel->setHFin($_POST["hFin"]);
        $this->materiaModel->setIdDocente($_POST["id_docente"]);

        return $this->materiaModel->crearMateria();
    }

    public function obtenerMateria(){
        $this->materiaModel->setId($_GET["id"]);
		return $this->materiaModel->obtenerMateria();
	}

    public function listarMaterias() {
        $id = "";
        $rol = "";
        
        if(!empty($_COOKIE["id_usuario"]) && !empty($_COOKIE["rol_usuario"])) {
            $id = $_COOKIE["id_usuario"];
            $rol = $_COOKIE["rol_usuario"];
        }

        return $this->materiaModel->listarMaterias($id, $rol);
    }

}

?>