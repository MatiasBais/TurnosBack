<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';
header("Access-Control-Allow-Origin: *");
// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Consultar los turnos con fecha mayor o igual a hoy
    $sql = "SELECT * FROM turnos WHERE fecha >= CURDATE() ORDER BY fecha ASC";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Array para almacenar los datos de los turnos
        $turnos = array();

        // Iterar sobre los resultados y almacenarlos en el array
        while ($row = $result->fetch_assoc()) {
            $turnos[] = $row;
        }

        // Devolver los datos de los turnos en formato JSON
        echo json_encode($turnos);
    } else {
        // No se encontraron turnos
        echo json_encode(["message" => "No se encontraron turnos"]);
    }
} else {
    // Devolver error si el método de solicitud no es GET
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>