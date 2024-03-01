<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

header("Access-Control-Allow-Origin: *");

// Verificar si se proporciona el ID del turno a eliminar
if (isset($_GET["id"])) {
    // Obtener el ID del turno
    $id = $_GET["id"];

    // Consulta SQL para eliminar el turno con el ID proporcionado
    $sql = "DELETE FROM turnos WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // El turno se eliminó correctamente
        $response = ["success" => true, "message" => "Turno eliminado correctamente"];
        echo json_encode($response);
    } else {
        // Error al eliminar el turno
        $response = ["success" => false, "message" => "Error al eliminar el turno: " . $conn->error];
        echo json_encode($response);
    }
} else {
    // Devolver un error si no se proporciona el ID del turno
    http_response_code(400);
    echo json_encode(["error" => "ID de turno no proporcionado"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>