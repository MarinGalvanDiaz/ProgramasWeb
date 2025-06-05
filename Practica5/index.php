<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Style/Style.css">
    <title>Document</title>
</head>
<body>
<div class="contenedor">
    <?php
    $ruta = "/var/www/";

    $archivo2 = 'Data/Materias.csv';

    $archivo = $ruta . $archivo2;

    if (($handle = fopen($archivo, 'r')) !== false) {
        echo '<table border="1">';
        while (($fila = fgetcsv($handle)) !== false) {
            echo '<tr>';
            foreach ($fila as $celda) {
                echo '<td>' . htmlspecialchars($celda) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        fclose($handle);
    } else {
        echo 'No se pudo abrir el archivo CSV.';
    }
    ?>
    <div class="prueba">
        <p>Hola</p>
    </div>
</div>

</body>
</html>
