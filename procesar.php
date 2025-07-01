<?php
require_once 'conexion.php';  // Conecta cn la BD

if (isset($_POST['submit'])) {
    // Guardar respuesta (ajustá los campos según tu base)
    $respuesta = $_POST['respuesta']; // ejemplo
    $sql = "INSERT INTO respuestas (respuesta) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $respuesta);
    $stmt->execute();
    echo "Respuesta guardada correctamente.";
}

elseif (isset($_POST['delete_last'])) {
    // Eliminar la última entrada (la de mayor ID)
    $sql = "DELETE FROM respuestas ORDER BY id DESC LIMIT 1";
    if ($conn->query($sql)) {
        echo "Última entrada eliminada correctamente.";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}

$conn->close();
?>

