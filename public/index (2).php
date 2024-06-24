<?php
$host = "127.0.0.1";
$db = "dw2_ejemplo";
$user = "root";
$password = "";

// Establecer conexión a la base de datos
$link = new mysqli($host, $user, $password, $db);
if ($link->connect_error) {
    die("La conexión falló: " . $link->connect_error);
}

// Datos para insertar en la tabla personas (ejemplo)
$nombre = "Diego";
$apellido = "Diego";
$nacimiento = "1990-01-01";
$email = "diego@example.com";
$telefono = "086674";

// Preparar consulta SQL utilizando consulta preparada
$sql = "INSERT INTO personas (nombre, apellido, nacimiento, email, telefono) VALUES (?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);

// Vincular parámetros y ejecutar consulta preparada
$stmt->bind_param("sssss", $nombre, $apellido, $nacimiento, $email, $telefono);

if ($stmt->execute()) {
    echo "Registro insertado correctamente.<br>";
} else {
    echo "Error al insertar el registro: " . $stmt->error . "<br>";
}

// Cerrar declaración y conexión
$stmt->close();
$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Crud de Personas</h1>

        <!-- Formulario de Registro -->
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3">Registro de Persona</h3>
                <form id="formRegistro" action="procesar.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="doce_apellido">Apellido:</label>
                        <input type="text" class="form-control" id="doce_apellido" name="doce_apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="per_cumple">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="per_cumple" name="per_cumple">
                    </div>
                    <div class="form-group">
                        <label for="per_email">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="per_email" name="per_email" required>
                    </div>
                    <div class="form-group">
                        <label for="per_cel">Teléfono:</label>
                        <input type="text" class="form-control" id="per_cel" name="per_cel">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Persona</button>
                </form>
            </div>

            <!-- Tabla de Personas -->
            <div class="col-md-6">
                <h3 class="mb-3">Listado de Personas</h3>
                <table class="table">
                    <thead>
                
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Correo </th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>
                    <tbody id="personTableBody">
            
                    <tbody id="personTableBody">
                        <!-- Aquí se cargarán los datos de las personas dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Integración del archivo funciones.js -->
    <script src="includes/funciones.js"></script>

    <!-- Agregar Bootstrap JavaScript desde CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Integración del archivo funciones.js -->
    <script src="includes/funciones.js"></script>

    <!-- Agregar Bootstrap JavaScript desde CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
