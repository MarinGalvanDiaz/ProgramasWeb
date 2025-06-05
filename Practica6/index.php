<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Style/Style.css">
    <title>Platillos</title>
    <?php
    $ruta = "/var/www/";
    $archivo2 = 'Data/Comida.csv';
    $archivo3 = 'Data/Calificaciones.csv';
    $archivo = $ruta . $archivo2;
    $archivo4 = $ruta . $archivo3;


    function imprimir($archivo, $archivo4, $tipo): void
    {
        // Cargar datos del archivo 4 en un array asociativo [id => ranking]
        $rankings = [];
        $comentarios = [];

        if (($fp2 = fopen($archivo4, "r"))) {
            fgetcsv($fp2); // Saltar cabecera si la tiene

            while (($linea = fgetcsv($fp2))) {
                $id = $linea[0];
                $ranking = $linea[1]; // Ajusta el índice según dónde esté el ranking
                $comentario = $linea[2];
                $rankings[$id] = $ranking;
                $comentarios[$id] = $comentario;
            }

            fclose($fp2);
        } else {
            echo "<p>No se pudo abrir el archivo de ranking.</p>";
            return;
        }

        // Leer el archivo principal
        if (($fp = fopen($archivo, "r"))) {
            fgetcsv($fp); // Saltar cabecera

            while (($linea = fgetcsv($fp))) {
                $id = $linea[0];

                if (($tipo == 1 && $linea[2] == "Plato_fuerte") ||
                    ($tipo == 2 && $linea[2] == "Postre")) {

                    echo "<p>Nombre: " . htmlspecialchars($linea[1]) . "</p>";
                    echo "<p>Ingredientes: " . htmlspecialchars($linea[3]) . "</p>";
                    echo "<p>Costo: " . htmlspecialchars($linea[4]) . "</p>";
                    echo "<p>Cantidad: " . htmlspecialchars($linea[5]) . "</p>";

                    if (isset($rankings[$id])) {
                        echo "<p>Ranking: " . htmlspecialchars($rankings[$id]) . "</p>";
                    } else {
                        echo "<p>Ranking: No disponible</p>";
                    }
                    if (isset($comentarios[$id])) {
                        echo "<p>Último comentario: " . htmlspecialchars($comentarios[$id]) . "</p>";
                    } else {
                        echo "<p>Último comentario: No disponible</p>";
                    }
                    echo "<a href='View/Form.php?$id' target='_self' title='Calificar'>Valorar producto</a>";
                }
            }

            fclose($fp);
        } else {
            echo "<p>No se pudo abrir el archivo principal.</p>";
        }
    }

    $formu = $_FILES['formu']['tmp_name'];

    ?>


</head>
<body>
<div class="container">
    <h1>Plato Favorito</h1>
    <div class="PlatoF">
        <h2>Plato fuerte</h2>
        <?php imprimir($archivo, $archivo4,1); ?>
    </div>
    <div class="Postre">
        <h2>Postres</h2>
        <?php imprimir($archivo, $archivo4,2); ?>

    </div>
<?php
echo $formu;
?>
</div>
</body>
</html>
