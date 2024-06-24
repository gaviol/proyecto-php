<?php
require_once("../../config/db_connect.php");

class personas {
    private $conexion;

    public function __construct() {
        $conect = new Conectar();
        $this->conexion = $conect->conexion();
    }

    public function getAll() {
        $sql = "SELECT * FROM personas";
        $result = $this->conexion->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM personas WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

$personas = new personas();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $persona = $personas->getById($id);
    if ($persona) {
        echo json_encode($persona);
    } else {
        echo json_encode(array("error" => "Persona no encontrada."));
    }
} else {
    $personas_todas = $personas->getAll();
    echo json_encode($personas_todas);
}
