<?php
class Conectar {
    private $host = "localhost"; // Tu servidor de base de datos
    private $dbname = "tu_base_de_datos"; // Nombre de tu base de datos
    private $username = "tu_usuario"; // Usuario de la base de datos
    private $password = "tu_contraseña"; // Contraseña de la base de datos
    public $conexion;

    public function conexion() {
        try {
            $this->conexion = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conexion->connect_error) {
                throw new Exception("Error al conectar a la base de datos: " . $this->conexion->connect_error);
            }
            return $this->conexion;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

