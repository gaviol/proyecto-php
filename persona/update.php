
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

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cumple = $_POST['cumple'];
$email = $_POST['email'];
$celular = $_POST['celular'];

$stmt = $conn->prepare("UPDATE personas SET doce_nombre = ?, doce_apellido = ?, per_cumple = ?, per_mail = ?, doce_cel = ? WHERE id = ?");
$stmt->bind_param("sssssi", $nombre, $apellido, $cumple, $email, $celular, $id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Registro actualizado exitosamente"]);
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>