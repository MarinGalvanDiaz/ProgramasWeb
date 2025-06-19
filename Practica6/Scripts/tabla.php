<?php
function imprimirTablaDesdeCSV($archivoCSV) {
    echo '<table>';
    if (($handle = fopen($archivoCSV, "r")) !== FALSE) {
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            // Determinar clase de fila
            $claseFila = "";
            if ($row == 0) {
                $claseFila = " encabezado";
            } else if ($row == 1) {
                $claseFila = " segunda-fila";
            } else if ($row % 2 == 0) {
                $claseFila = " par";
            } else {
                $claseFila = " impar";
            }

            echo "<tr class='$claseFila'>";
            foreach ($data as $celda) {
                $tag = ($row == 0) ? "th" : "td";
                echo "<$tag>" . htmlspecialchars($celda) . "</$tag>";
            }
            echo "</tr>";
            $row++;
        }
        fclose($handle);
    }
    echo '</table>';
}
