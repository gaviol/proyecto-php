<?php
require_once("../../config/db_connect.php");

class personas {
    private $conexion;

    public function __construct() {
        $conect = new Conectar();
        $this->conexion = $conect->conexion();
    }

    public function actualizar($datos) {
        $sql = "UPDATE personas SET doce_nombre = ?, doce_apellido = ?, per_cumple = ?, per_mail = ?, doce_cel = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssssi", $datos['nombre'], $datos['apellido'], $datos['cumple'], $datos['email'], $datos['cel'], $datos['id']);
        return $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos = array(
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['doce_apellido'],
        'cumple' => $_POST['per_cumple'],
        'email' => $_POST['per_email'],
        'cel' => $_POST['per_cel']
    );

    $personas = new personas();
    if ($personas->actualizar($datos)) {
        echo json_encode(array("success" => "Persona actualizada con éxito."));
    } else {
        echo json_encode(array("error" => "Error al actualizar la persona."));
    }
}
