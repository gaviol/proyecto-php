<?php
require_once("../../config/db_connect.php");

class personas {
    private $conexion;

    public function __construct() {
        $conect = new Conectar();
        $this->conexion = $conect->conexion();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM personas WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $personas = new personas();
    if ($personas->eliminar($id)) {
        echo json_encode(array("success" => "Persona eliminada con éxito."));
    } else {
        echo json_encode(array("error" => "Error al eliminar la persona."));
    }
}

