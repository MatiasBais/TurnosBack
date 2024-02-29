<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia esto por la dirección de tu servidor MySQL
$username = "matias"; // Cambia esto por tu nombre de usuario de MySQL
$password = "1234"; // Cambia esto por tu contraseña de MySQL
$database = "turnos"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    // La conexión fue exitosa
    // Puedes dejar un mensaje de prueba aquí si lo deseas
    // echo "Conexión exitosa";
}

// Establecer el conjunto de caracteres a UTF-8 (opcional)
$conn->set_charset("utf8");

// Ahora, esta variable $conn contiene la conexión a tu base de datos y puedes utilizarla en tus otros archivos PHP para realizar consultas.
?>