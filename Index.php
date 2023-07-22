<?php

    $rutaControlador = "controller/" . $_GET["controlador"] . "Controller.php";

    if(!file_exists($rutaControlador)) {
        header("Location: view/Inicio.html");
        exit;
    }

    require_once $rutaControlador;
    $nombreControlador = $_GET["controlador"] . "Controller";
    $controlador = new $nombreControlador();

    if(method_exists($controlador, $_GET["accion"])) {
        header('Content-Type: application/json');
        echo json_encode($controlador->{$_GET["accion"]}());
    }

?>