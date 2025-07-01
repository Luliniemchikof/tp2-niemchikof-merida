<?php

require_once 'conexion.php';  // Conecta con la BD


//Condicional para eliminar el último registro de la BD con el ID
if (isset($_POST['eliminar_ultimo']) && isset($_POST['registro_id'])) { 
    $id = (int) $_POST['registro_id'];

    $sqlDelete = "DELETE FROM resultados WHERE id = $id LIMIT 1"; //Límite de deletes

    if ($conn->query($sqlDelete)) {
        // Redirige al formulario después de eliminar
        header("Location: index.php?p=formulario"); //Si elimina el registro, redirige
        exit;
    } else {
        echo "<p style='color:red;'>❌ Error al eliminar: " . $conn->error . "</p>"; //Si no logra eliminar el registro, muestra el error
        exit;
    }
} 

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

if (count($faltan) > 0) { //Si faltan datos que completar muestra el mensaje
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
            width: 10%;
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

foreach ($campos as $campo) { //Muestra los campos faltantes
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

// Determina el resultado entre los 4 posibles
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

// Validación final
if (
    empty($_POST["nombre"]) ||
    empty($_POST["apellido"]) ||
    empty($resultadoFinal) ||
    $resultadoFinal === "Datos incompletos"
) {
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
        ⚠️ No se guardaron los datos porque falta información válida. <br> Por favor completá todos los campos obligatorios.
    </div>";
    exit;
}

// Insertar en la BD
$nombre = $conn->real_escape_string($_POST["nombre"]);
$apellido = $conn->real_escape_string($_POST["apellido"]);
$resultadoFinal = (int)$resultadoFinal;

$sqlInsert = "INSERT INTO `resultados` (`nombre`, `apellido`, `Resultado`) VALUES ('$nombre', '$apellido', $resultadoFinal)";

if ($conn->query($sqlInsert)) {
    $inserted_id = $conn->insert_id; // Se obtiene después del INSERT exitoso
    echo "<p style='color: green;'>✅ Datos guardados correctamente.</p>";
} else {
    echo "<p style='color: red;'>❌ Error al guardar los datos: " . $conn->error . "</p>";
}


// Calcular porcentaje de personas con el mismo resultado
$sqlTotal = "SELECT COUNT(*) AS total FROM resultados";
$sqlCoinciden = "SELECT COUNT(*) AS coincidencias FROM resultados WHERE Resultado = $resultadoFinal";

$resultTotal = $conn->query($sqlTotal);
$resultCoinciden = $conn->query($sqlCoinciden);

if ($resultTotal && $resultCoinciden) {
    $total = $resultTotal->fetch_assoc()["total"]; //Busca las coincidencias en los resultados
    $coinciden = $resultCoinciden->fetch_assoc()["coincidencias"];

    if ($total > 0) {
        $porcentaje = round(($coinciden / $total) * 100, 2); //Calcula el porcentaje
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

//Botón para volver al inicio
echo "<br><div class='button'>
    <a href='index.php' style='
        display: inline-block;
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    '>Volver</a>
   
</div>";

//Botón para eliminar el registro
echo "<form method='post' action='recibe_form.php'>
    <input type='hidden' name='registro_id' value='$inserted_id'>
    <button type='submit' name='eliminar_ultimo' style='
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    '>Eliminar mi respuesta y volver a completar</button>
</form>";

include("views/_pie_de_pagina.php"); // Footer
?>
