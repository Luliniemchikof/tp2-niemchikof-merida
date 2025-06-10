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
//echo "<h2>Datos recibidos:</h2>";
//for ($i = 0; $i < count($campos); $i++) {
 //   $campo = $campos[$i];
//    if (!empty($_POST[$campo])) {
//        echo "<p><strong>$campo:</strong> " . $_POST[$campo] . "</p>";
//    }
//}

//Recorre el array de campos claves
for ($i = 0; $i < count($campos); $i++) {
    if (empty($_POST[$campos[$i]])) {
        $faltan_datos = true;
        break; // con que uno esté vacío, ya alcanza
    }
}

if (
    $_POST["musica"] === "si" &&
    $_POST["divas"] === "1" &&
    $_POST["peliculas"] === "1" &&
    $_POST["peliculas"] === "1" &&
    $_POST["argentina"] === "si" &&
    $_POST["deGrande"] === "1"
) {
    echo "<p><strong>¡Sus rinstones están listos en <a>https://drive.google.com/drive/folders/10aIMT68tVvlS-NX-Me10_UxbFqJjdeGm</a>!</strong></p>\n";
} 
else if (
     $_POST["musica"] === "si" &&
    $_POST["divas"] === "2" &&
    $_POST["peliculas"] === "2" &&
    $_POST["peliculas"] === "2" &&
    $_POST["argentina"] === "no" &&
    $_POST["deGrande"] === "2"
) {
    echo "<p><strong>¡Sus rinstones están listos en <a>https://drive.google.com/drive/folders/15CxS6QdbXv5CPOAR_P5QvEjUsNCAXb_5</a>!</strong></p>\n";
} else if (
    $_POST["musica"] === "no" &&
    $_POST["divas"] === "3" &&
    $_POST["peliculas"] === "3" &&
    $_POST["peliculas"] === "3" &&
    $_POST["argentina"] === "si" &&
    $_POST["deGrande"] === "3"
) {
    echo "<p><strong>¡Sus rinstones están listos en <a>https://drive.google.com/drive/folders/1zTVCNl1DMyRB1QmOEDW1Bv_2Vr0tGR2U</a>!</strong></p>\n";
}else if ($faltan_datos) {
    echo "<p><strong>No se pueden proveer ringtones porque faltan datos</strong>\n";
}
else {
    echo "<p><strong>Sus datos están en proceso</strong></p>\n";
}

echo "<a href='index.php'>volver</a>";

?>