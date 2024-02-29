<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';
header("Access-Control-Allow-Origin: *");

// Permitir los métodos de solicitud que deseas permitir
if (isset($_GET["fecha"]) && isset($_GET["hora"]) && isset($_GET["nombre"]) && isset($_GET["telefono"])) {
    // Recibir y validar los datos de la URL
    $fecha = $_GET["fecha"];
    $hora = $_GET["hora"];
    $nombre = $_GET["nombre"];
    $telefono = $_GET["telefono"];

    // Insertar el nuevo turno en la base de datos
    $sql = "INSERT INTO turnos (fecha, hora, nombre, telefono) VALUES ('$fecha', '$hora', '$nombre', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del turno recién insertado
        $idTurno = $conn->insert_id;

        // Consultar la base de datos para obtener el turno recién insertado
        $sqlSelect = "SELECT * FROM turnos WHERE id = $idTurno";
        $result = $conn->query($sqlSelect);

        if ($result->num_rows > 0) {
            // Convertir el resultado en un array asociativo
            $turno = $result->fetch_assoc();
            // Devolver el turno creado como JSON
            echo json_encode($turno);
        } else {
            // Si no se encuentra el turno, devolver un mensaje de error
            http_response_code(404);
            echo json_encode(["error" => "No se encontró el turno creado"]);
        }
    } else {
        // Error al crear el turno
        $response = ["success" => false, "message" => "Error al crear el turno: " . $conn->error];
        echo json_encode($response);
    }
} else {
    // Devolver un error si no se proporcionan todos los parámetros requeridos
    http_response_code(400);
    echo json_encode(["error" => "Faltan parámetros en la solicitud"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>