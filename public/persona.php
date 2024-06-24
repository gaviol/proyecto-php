<?php
class Conectar {
    private $host = 'localhost';
    private $db = 'tu_base_de_datos';
    private $user = 'tu_usuario';
    private $password = 'tu_contraseña';
    private $conexion;

    public function conexion() {
        $this->conexion = new mysqli($this->host, $this->user, $this->password, $this->db);
        
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }
}

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
        $sql = "SELECT id, nombre, apellido, email FROM personas WHERE id=$id";
        $result = $this->conexion->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function insertar($datos) {
        $sql = "INSERT INTO personas (nombre, apellido, email) VALUES ('$datos[0]', '$datos[1]', $datos[2])";
        return $this->transaccion($sql);
    }

    public function actualizar($datos) {
        $sql = "UPDATE personas SET nombre='$datos[0]', apellido='$datos[1]', edad=$datos[2] WHERE id=$datos[3]";
        return $this->transaccion($sql);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM personas WHERE id=$id";
        return $this->transaccion($sql);
    }

    private function transaccion($sql) {
        $this->conexion->autocommit(false);
        if ($this->conexion->query($sql)) {
            $this->conexion->commit();
            $this->conexion->autocommit(true);
            return true;
        } else {
            $this->conexion->rollback();
            $this->conexion->autocommit(true);
            return false;
        }
    }
}
