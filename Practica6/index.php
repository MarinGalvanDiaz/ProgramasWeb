<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liga</title>
    <link rel="stylesheet" href="Style/Style.css">
    <link rel="icon" href="Images/Beisbol-Cuba-edición-61.webp">
    <?php
    include 'Scripts/tabla.php';
    $vinculo = '/hosting/galvmari/home/Datos/infEquip.csv'
    ?>
</head>
<body>
    <div class="contenedor">
        <nav>
            <a href="#">INICIO</a>
            <a href="#">CALENDARIO</a>
            <a href="#">POSICIONES</a>
            <a href="#">EQUIPOS</a>
            <a href="#">ESTADÍSTICAS</a>
            <a href="#">DESCARGAS</a>
            <a href="#">MÁS</a>
            <a href="#">REGLAMENTO</a>
        </nav>
        <div class="contenedor2">
            <div class="Cuadros">
        <div class="cuadro1">
            <p>BATEO</p>
        </div>
            <div class="cuadro2">
                <p>PITCHEO</p>
            </div>
                <div class="cuadro3">
                    <p>FILDEO</p>
                </div>
            </div>
            <div class="imagen">
                <img src="Images/Beisbol-Cuba-edición-61.webp" alt="Logo liga cubana">
            </div>
            <div class="Selector">
                <div class="headConte">
                    <p>General&nbsp;|&nbsp;Designado&nbsp;|&nbsp;Emergente|
                        &nbsp;VS zurdos&nbsp;|&nbsp;<strong>VS derechos</strong>&nbsp;|&nbsp;Con corredores&nbsp;|&nbsp;Conexiones
                    </p>
                </div>
            </div>
            <div class="Estadisticas">
                <table>
                    <?php
                     imprimirTablaDesdeCSV($vinculo);
                    ?>
                </table>
            </div>
    </div>


</div>
</body>
</html>