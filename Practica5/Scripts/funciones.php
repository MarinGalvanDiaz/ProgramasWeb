<?php

function cargarMateriasDesdeCSV($filename) {
    $materias = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        $headers = fgetcsv($handle);
        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($headers, $data);
            $materias[] = $row;
        }
        fclose($handle);
    }
    return $materias;
}

function agruparPorAreaYCalcularPromedios($materias) {
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

    foreach ($areas as &$a) {
        $a['promedio'] = $a['cuenta'] > 0 ? $a['suma'] / $a['cuenta'] : 0;
    }

    uasort($areas, function ($a, $b) {
        return $b['promedio'] <=> $a['promedio'];
    });

    $promedioGlobal = $totalCount > 0 ? $totalSum / $totalCount : 0;

    return [$areas, $promedioGlobal];
}
function contarMaterias($materias) {
    $cursadas = 0;
    $aprobadas = 0;
    $noCursadas = 0;

    foreach ($materias as $m) {
        $cal = $m['Calificación'];
        if (is_numeric($cal)) {
            $cursadas++;
            if (floatval($cal) >= 6) {
                $aprobadas++;
            }
        } else {
            $noCursadas++;
        }
    }

    return [
        'cursadas' => $cursadas,
        'aprobadas' => $aprobadas,
        'noCursadas' => $noCursadas
    ];
}


