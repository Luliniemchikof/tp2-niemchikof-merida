
<?php 

    if (!isset($_GET['p']) || $_GET['p']=='inicio'  ) {
        $vista = "inicio.php";
    }
    else if ( $_GET['p'] == 'formulario'){
        $vista = "formulario.php";
    }
    else if ( $_GET['p'] == 'mis-ringtones'){
        $vista = "ringtones.php";
    }
    else {
        $vista = "404.php";
    }

    include("views/_encabezado.php");
    include("views/". $vista );
    include("views/_pie_de_pagina.php");

?>



