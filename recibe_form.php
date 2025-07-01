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

include("views/_encabezado.php"); //Agrega el encabezado del layout

// Validación del formulario
$campos = ["nombre", "apellido", "musica", "divas", "peliculas", "influencer", "argentina", "deGrande", "facturas"];
$errores = [];
$valores = [];
$faltan = [];
$faltan_datos = false;

foreach ($campos as $c) {
    if (!isset($_POST[$c]) || $_POST[$c] === '') {
        $faltan[] = $c;
    }
}

if (count($faltan) > 0) {

    echo "<div class='alerta' style='
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        margin: 20px 0;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        font-weight: bold;
        max-width: 500px;
    '>
        ⚠️ No se guardaron los datos porque falta información válida. <br> 
        Por favor completá todos los campos obligatorios: " . implode(", ", $faltan) . "
    </div>
    <div class='button'>
        <a href='?p=formulario' style='
            width: 10%
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        '>Volver</a>
    </div>";

    exit;
}


echo "Gracias por contestar la encuesta.<br><br>";

foreach ($campos as $campo) {
    $valor = trim($_POST[$campo] ?? '');
    $valores[$campo] = $valor;

    if ($valor === '') {
        $errores[$campo] = "El campo '$campo' es obligatorio.";
    }
}

if (!empty($errores)) {
    include 'index.php';
    exit;
}

// Verifica si falta algún dato
foreach ($campos as $campo) {
    if (empty($_POST[$campo])) {
        $faltan_datos = true;
        break;
    }
}

// Determina el resultado
$resultadoFinal = "0";

if (
    $_POST["musica"] === "si" &&
    $_POST["divas"] === "1" &&
    $_POST["peliculas"] === "1" &&
    $_POST["influencer"] === "1" &&
    $_POST["argentina"] === "si" &&
    $_POST["deGrande"] === "1"
) {
    echo "<p><strong>¡Sus ringtones están listos en <a href='https://drive.google.com/drive/folders/10aIMT68tVvlS-NX-Me10_UxbFqJjdeGm'>Aquí</a>!</strong></p>\n";
    $resultadoFinal = "1";
} elseif (
    $_POST["musica"] === "si" &&
    $_POST["divas"] === "2" &&
    $_POST["peliculas"] === "2" &&
    $_POST["influencer"] === "2" &&
    $_POST["argentina"] === "no" &&
    $_POST["deGrande"] === "2"
) {
    echo "<p><strong>¡Sus ringtones están listos en <a href='https://drive.google.com/drive/folders/15CxS6QdbXv5CPOAR_P5QvEjUsNCAXb_5'>Ringtone 2</a>!</strong></p>\n";
    $resultadoFinal = "2";
} elseif (
    $_POST["musica"] === "no" &&
    $_POST["divas"] === "3" &&
    $_POST["peliculas"] === "3" &&
    $_POST["influencer"] === "3" &&
    $_POST["argentina"] === "si" &&
    $_POST["deGrande"] === "3"
) {
    echo "<p><strong>¡Sus ringtones están listos en <a href='https://drive.google.com/drive/folders/1zTVCNl1DMyRB1QmOEDW1Bv_2Vr0tGR2U'>Ringtone 3</a>!</strong></p>\n";
    $resultadoFinal = "3";
} else {
    echo "<p><strong>Sus ringtones están en proceso.</strong></p>\n";
    $resultadoFinal = "4";
}

// Validación final para no guardar si falta info crítica
if (
    empty($_POST["nombre"]) ||
    empty($_POST["apellido"]) ||
    empty($resultadoFinal) ||
    $resultadoFinal === "Datos incompletos"
) {
    echo "
    <div class='alerta' style='
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        margin: 20px 0;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        font-weight: bold;
        max-width: 500px;
    '>
        ⚠️ No se guardaron los datos porque falta información válida. <br> Por favor completá todos los campos obligatorios.
    </div>
    <div class='button'>
        <a href='?p=formulario' style='
            width: 10%
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        '>Volver</a>
    </div>";

    exit;
}

// INSERTA en la base de datos
$nombre = $conn->real_escape_string($_POST["nombre"]);
$apellido = $conn->real_escape_string($_POST["apellido"]);
$resultadoFinal = $conn->real_escape_string($resultadoFinal);

$sqlInsert = "INSERT INTO `Resultados` (`nombre`, `apellido`, `Resultado`) VALUES ('$nombre', '$apellido', '$resultadoFinal')";
if ($conn->query($sqlInsert)) {
    echo "<p style='color: green;'>✅ Datos guardados correctamente.</p>";
} else {
    echo "<p style='color: red;'>❌ Error al guardar los datos: " . $conn->error . "</p>";
}

// MOSTRAR TODOS LOS RESULTADOS AL FINAL
$sql = "SELECT * FROM Resultados";
$resultado = $conn->query($sql);  //Quitar que muestre los resultados

// Calcular porcentaje de coincidencia
$sqlTotal = "SELECT COUNT(*) AS total FROM Resultados";
$sqlCoinciden = "SELECT COUNT(*) AS coincidencias FROM Resultados WHERE Resultado = '$resultadoFinal'";

$resultTotal = $conn->query($sqlTotal);
$resultCoinciden = $conn->query($sqlCoinciden);

if ($resultTotal && $resultCoinciden) {
    $total = $resultTotal->fetch_assoc()["total"];
    $coinciden = $resultCoinciden->fetch_assoc()["coincidencias"];

    if ($total > 0) {
        $porcentaje = round(($coinciden / $total) * 100, 2);

        echo "<div style='
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            margin: 20px 0;
            border: 1px solid #bee5eb;
            border-radius: 5px;
            max-width: 500px;
        '>
            📊 <strong>$porcentaje%</strong> de las personas que completaron esta encuesta obtuvieron el mismo resultado que vos.
        </div>";
    }
}

if ($resultado && $resultado->num_rows > 0) {
    echo "<hr><h3>Respuestas almacenadas:</h3>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "Nombre: " . $fila["nombre"] . "<br>";
        echo "Apellido: " . $fila["apellido"] . "<br>";
        echo "Resultado: " . $fila["Resultado"] . "<br><br>";
    }
} else {
    echo "No se encontraron resultados.";
}

echo "<br><div class='button'>
        <a href='index.php' style='
            width: 10%
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        '>Volver</a>
    </div>";

include("views/_pie_de_pagina.php");//Agrega el footer del layout
?>
