<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kardex</title>
    <link rel="stylesheet" href="Style/Style.css">
    <link rel="icon" href="Images/EscudoESCOM.png">
    <?php
    require_once 'Scripts/funciones.php';
    $ruta1 = '/hosting/galvmari/home/Datos/';
    $ruta2 = 'materias.csv';
    $rutafin = $ruta1 . $ruta2;
    $materias = cargarMateriasDesdeCSV($rutafin);
    [$areas, $promedioGlobal] = agruparPorAreaYCalcularPromedios($materias);
    $estadisticas = contarMaterias($materias);
    ?>
</head>
<body>

<div class="global-info">
    <div class="Titulo">
    <h1>Kardex</h1>
    </div>
    <div class="Nombre">
        <p>Nombre: Galván Díaz Marín</p>
    </div>
    <div class="Promedio">
        <p class="promedio">Promedio
            Global: <?= $promedioGlobal > 0 ? number_format($promedioGlobal, 2) : "Pendiente" ?></p>
    </div>
    <div class="Materias">
        <p>Materias cursadas: <?= $estadisticas['cursadas'] ?></p>
        <p>Materias aprobadas: <?= $estadisticas['aprobadas'] ?></p>
        <p>Materias no cursadas: <?= $estadisticas['noCursadas'] ?></p>
    </div>
    <div class="Fechas">
        <p>Ciclo de ingreso: 24-1</p>
        <p>Ciclo de salida: 27-2</p>
    </div>
</div>

<div class="areas-container">
    <?php
    $index = 0;
    $total = count($areas);
    foreach ($areas as $area => $info):
        $prom = $info['promedio'];
        $class = $index === 0 ? "area destacada" : "area";
        if ($index === $total - 1) {
            $class .= " centrada";
        }
        $index++;
        ?>
        <div class="<?= $class ?>">
            <h2><?= htmlspecialchars($area) ?> (Promedio: <?= $prom > 0 ? number_format($prom, 2) : "Pendiente" ?>)</h2>
            <?php foreach ($info['materias'] as $materia): ?>
                <div class="materia">
                    <span class="nombre"><?= htmlspecialchars($materia['Nombre']) ?></span>
                    <span class="calificacion"><?= is_numeric($materia['Calificación']) ? number_format($materia['Calificación']) : "Pendiente" ?></span>
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
