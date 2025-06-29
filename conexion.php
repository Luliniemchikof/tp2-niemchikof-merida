
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'nombre_de_tu_base';

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Opcional: establecer codificación
$conn->set_charset("utf8");
?>
