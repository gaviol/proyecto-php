<?php
require_once "/conf/db_Connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['doce_apellido'];
    $cumple = $_POST['per_cumple'];
    $email = $_POST['per_email'];
    $cel = $_POST['per_cel'];

    $personas = new personas();
    $datos = array($nombre, $apellido, $cumple, $email, $cel);

    if ($personas->insertar($datos)) {
        echo json_encode(array("success" => true, "message" => "Persona registrada correctamente."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error al registrar persona."));
    }
}

