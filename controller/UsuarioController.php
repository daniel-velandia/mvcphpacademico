<?php

require_once("model/UsuarioModel.php");

class UsuarioController {

    public $usuarioModel;

    public function __construct() {

        $this->usuarioModel = new UsuarioModel();
    }

    public function crearUsuario() {

        $this->usuarioModel->setDocumento($_POST["documento"]);
        $this->usuarioModel->setNombre($_POST["nombre"]);
        $this->usuarioModel->setApellido($_POST["apellido"]);
        $this->usuarioModel->setCorreo($_POST["correo"]);
        $this->usuarioModel->setclave(password_hash($_POST["documento"], PASSWORD_DEFAULT));
        $this->usuarioModel->setRol($_POST["rol"]);

        return $this->usuarioModel->crearUsuario();
    }

    public function obtenerUsuarioPorId(){
        $this->usuarioModel->setId($_GET["id"]);
		return $this->usuarioModel->obtenerUsuarioPorId();
	}

    public function login() {
        $this->usuarioModel->setCorreo($_POST["correo"]);
        $this->usuarioModel->setClave($_POST["clave"]);

        $usuario = $this->usuarioModel->obtenerUsuarioPorCorreo();

        if(!empty($usuario) && password_verify($this->usuarioModel->getClave(), $usuario['clave'])) {
            
            setcookie("id_usuario", $usuario["id"], time() + 86400 , "/");
            setcookie("rol_usuario", $usuario["rol"], time() + 86400 , "/");
            return true;
        } else {
            return false;
        }

    }

    public function logout() {
        setcookie("id_usuario", "", time() - 3600, "/");
        setcookie("rol_usuario", "", time() - 3600, "/");
        header("Location: view/Inicio.html");
        exit;
    }

    public function listarEstudiantes() {
        $this->usuarioModel->setRol("estudiante");
        return $this->usuarioModel->listarUsuarios();
    }

    public function listarDocentes() {
        $this->usuarioModel->setRol("docente");
        return $this->usuarioModel->listarUsuarios();
    }
}

?>