<?php


//arrays para validar los campos
$campos = ["nombre", "ciudadano", "dolares", "cultura_cierre", "organo", "filosofia"];
$campos_clave = ["dolares", "cultura_cierre", "organo", "filosofia"];
$faltan_datos = false;

// Valida el nombre
if (empty($_POST["nombre"])) {
    echo "<p>Debe escribir su nombre. </p>\n";
}

// Valida la pregunta sobre ciudadano
if (empty($_POST["ciudadano"])) {
    echo "<p>Debe seleccionar si es ciudadano de bien.</p>\n";
}

// Valida la cantidad de dólares
if (empty($_POST["dolares"])) {
    echo "<p>Debe elegir cuántos dólares compró.</p>\n";
}

// Valida cultura_cierre
if (empty($_POST["cultura_cierre"])) {
    echo "<p>Debe seleccionar un espacio cultural.</p>\n";
}

// Valida si vendió un órgano
if (empty($_POST["organo"])) {
    echo "<p>Debe seleccionar si vendió un órgano.</p>\n";
}

// Valida filosofía
if (empty($_POST["filosofia"])) {
    echo "<p>Debe elegir una opción sobre la filosofía.</p>\n";
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
    $_POST["dolares"] === "Ninguno" &&
    $_POST["cultura_cierre"] === "Ninguno" &&
    $_POST["organo"] === "no" &&
    $_POST["filosofia"] === "No se qué es"
) {
    echo "<p><strong>¡Ha salvado a 0 niños del Chaco y seguro sea zurd0000000!</strong></p>\n";
} 
else if (
    $_POST["dolares"] === "Más de 10000usd" &&  // Asegurate que el value en el select coincida con esto
    $_POST["cultura_cierre"] === "La casa de Lali" &&
    $_POST["organo"] === "si" &&
    $_POST["filosofia"] === "Re de acuerdo"
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