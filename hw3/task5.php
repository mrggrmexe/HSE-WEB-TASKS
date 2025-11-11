<?php
/**
 * ФИО: Штукмайстер Г.П.
 * Вариант: 12
 * Задание 5
 * Цель: Вычислить Y = (x-1)/(x+1) + 1/3*((x-1)/(x+1))^3 + ... + 1/11*((x-1)/(x+1))^11
 */

function calcY(float $x): float {
    $den = $x + 1.0;
    if (abs($den) < 1e-12) {
        throw new RuntimeException("Ошибка: деление на ноль (x + 1 = 0)");
    }

    $r = ($x - 1.0) / $den;
    $sum = 0.0;

    // Суммируем члены ряда с нечётными степенями
    for ($n = 1; $n <= 11; $n += 2) {
        $sum += (1.0 / $n) * pow($r, $n);
    }

    return $sum;
}

// --- Основная программа ---
try {
    echo "Введите x: ";
    $line = trim(fgets(STDIN));

    if ($line === '' || !is_numeric($line)) {
        throw new InvalidArgumentException("Ошибка: необходимо ввести числовое значение x.");
    }

    $x = floatval($line);
    $y = calcY($x);

    echo "Результат Y = " . number_format($y, 6, '.', '') . PHP_EOL;

} catch (Exception $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
}
?>
