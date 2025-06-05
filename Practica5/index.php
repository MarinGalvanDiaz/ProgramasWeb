<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kardex</title>
    <link rel="stylesheet" href="Style/Style.css">
    <?php
    // Cargar datos desde CSV
    $filename = 'Datos/materias.csv';
    $materias = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        $headers = fgetcsv($handle);
        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($headers, $data);
            $materias[] = $row;
        }
        fclose($handle);
    }

    // Agrupar por área y calcular promedios
    $areas = [];
    $totalSum = 0;
    $totalCount = 0;

    foreach ($materias as $m) {
        $area = $m['Área'];
        $cal = $m['Calificación'];
        if (!isset($areas[$area])) {
            $areas[$area] = [
                'materias' => [],
                'suma' => 0,
                'cuenta' => 0
            ];
        }
        $areas[$area]['materias'][] = $m;

        if (is_numeric($cal)) {
            $areas[$area]['suma'] += floatval($cal);
            $areas[$area]['cuenta']++;
            $totalSum += floatval($cal);
            $totalCount++;
        }
    }

    // Calcular promedio por área
    foreach ($areas as $k => &$a) {
        $a['promedio'] = $a['cuenta'] > 0 ? $a['suma'] / $a['cuenta'] : 0;
    }

    // Ordenar áreas por promedio descendente
    uasort($areas, function ($a, $b) {
        return $b['promedio'] <=> $a['promedio'];
    });

    $promedioGlobal = $totalCount > 0 ? $totalSum / $totalCount : 0;
    ?>
</head>
<body>

<div class="global-info">
    <h1>Kardex</h1>
    <p>Nombre: Galván Díaz Marín</p>
    <p class="promedio">Promedio Global: <?= $promedioGlobal > 0 ? number_format($promedioGlobal, 2) : "Pendiente" ?></p>
    <p>Ciclo de ingreso: 24-1</p>
    <p>Ciclo de salida: 27-2</p>
</div>

<div class="areas-container">
    <?php
    $index = 0;
    $total = count($areas);
    foreach ($areas as $area => $info):
        $prom = $info['promedio'];
        $class = $index === 0 ? "area destacada" : "area";
        if ($index === $total - 1) {
            $class .= " centrada"; // última tarjeta
        }
        $index++;
        ?>
        <div class="<?= $class ?>">
            <h2><?= htmlspecialchars($area) ?> (Promedio: <?= $prom > 0 ? number_format($prom, 2) : "Pendiente" ?>)</h2>
            <?php foreach ($info['materias'] as $materia): ?>
                <div class="materia">
                    <span class="nombre"><?= htmlspecialchars($materia['Nombre']) ?></span>
                    <span class="calificacion"><?= is_numeric($materia['Calificación']) ? number_format($materia['Calificación'], 2) : "Pendiente" ?></span>
                    <div class="detalle">Ciclo: <?= htmlspecialchars($materia['Ciclo']) ?></div>
                    <div class="detalle">Propósito: <?= htmlspecialchars($materia['Propósito']) ?></div>
                    <div class="detalle">
                        Calidad del aprendizaje:
                        <?= is_numeric($materia['Calidad']) ? str_repeat('★', intval($materia['Calidad'])) . str_repeat('☆', 5 - intval($materia['Calidad'])) : "Pendiente" ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
