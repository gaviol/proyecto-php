<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["message" => "Conexión fallida: " . $conn->connect_error]));
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cumple = $_POST['cumple'];
$email = $_POST['email'];
$celular = $_POST['celular'];

$stmt = $conn->prepare("INSERT INTO personas (doce_nombre, doce_apellido, per_cumple, per_mail, doce_cel) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $apellido, $cumple, $email, $celular);

if ($stmt->execute()) {
    echo json_encode(["message" => "Nuevo registro creado exitosamente"]);
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>