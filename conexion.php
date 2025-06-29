
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'resultados';

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Opcional: establecer codificación
$conn->set_charset("utf8");
?>
