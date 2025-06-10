<?php


//arrays para validar los campos
$campos = ["nombre", "apellido", "musica", "divas", "peliculas", "influencer", "argentina", "deGrande", "facturas"];
$errores = [];
$valores = [];


foreach ($campos as $campo) {
    $valor = isset($_POST[$campo]) ? trim($_POST[$campo]) : '';
    $valores[$campo] = $valor;

    if ($valor === '') {
        $errores[$campo] = "El campo '$campo' es obligatorio.";
    }
}

if (!empty($errores)) {
    include 'index.php';
    exit;
}


//Recorre array de campos para ver los datos recibidos
echo "<h2>Datos recibidos:</h2>";
for ($i = 0; $i < count($campos); $i++) {
    $campo = $campos[$i];
    if (!empty($_POST[$campo])) {
        echo "<p><strong>$campo:</strong> " . $_POST[$campo] . "</p>";
    }
}

//Recorre el array de campos claves
for ($i = 0; $i < count($campos_clave); $i++) {
    if (empty($_POST[$campos_clave[$i]])) {
        $faltan_datos = true;
        break; // con que uno esté vacío, ya alcanza
    }
}

if (
    $_POST["divas"] === "Ninguno" &&
    $_POST["peliculas"] === "Ninguno" &&
    $_POST["argentina"] === "no" &&
    $_POST["deGrande"] === "No se qué es"
) {
    echo "<p><strong>¡Ha salvado a 0 niños del Chaco y seguro sea zurd0000000!</strong></p>\n";
} 
else if (
    $_POST["divas"] === "Más de 10000usd" &&  // Asegurate que el value en el select coincida con esto
    $_POST["peliculas"] === "La casa de Lali" &&
    $_POST["argentina"] === "si" &&
    $_POST["deGrande"] === "Re de acuerdo"
) {
    echo "<p><strong>¡Ha salvado a INCONTABLES niños del Chaco!</strong></p>\n";
} else if ($faltan_datos) {
    echo "<p><strong>No se puede determinar su grado de heroísmo hacia los niños del Chaco porque faltan datos.</strong></p>\n";
}
else {
    echo "<p><strong> Salvó a varios niños del Chaco, pero podría haber salvado más.</strong></p>\n";
}

echo "<a href='formulario.php'>volver</a>";

?>