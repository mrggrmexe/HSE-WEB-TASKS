<?php
/**
 * ФИО: Штукмайстер Г.П.
 * Вариант: 12
 * Задание 6
 * Условие: Из массивов A1..A15 и B1..B5 сформировать C, содержащий отрицательные элементы.
 */

function readFloatsExact(int $n, string $hint): array {
    echo $hint;
    $line = fgets(STDIN);

    if ($line === false) {
        throw new RuntimeException("Ошибка ввода данных.");
    }

    $nums = array_map('floatval', preg_split('/\s+/', trim($line)));

    if (count($nums) !== $n) {
        throw new InvalidArgumentException("Ожидалось $n чисел, получено " . count($nums));
    }

    return $nums;
}

// --- Основная программа ---
try {
    $A = readFloatsExact(15, "Введите 15 элементов массива A через пробел: ");
    $B = readFloatsExact(5, "Введите 5 элементов массива B через пробел: ");

    // Отбираем отрицательные элементы
    $negA = array_values(array_filter($A, fn($v) => $v < 0));
    $negB = array_values(array_filter($B, fn($v) => $v < 0));

    $C = array_values(array_merge($negA, $negB));

    echo PHP_EOL;
    echo "Отрицательные из A: [" . implode(' ', $negA) . "]" . PHP_EOL;
    echo "Отрицательные из B: [" . implode(' ', $negB) . "]" . PHP_EOL;
    echo "Итоговый массив C (" . count($C) . " элементов): [" . implode(' ', $C) . "]" . PHP_EOL;

} catch (Exception $e) {
    fwrite(STDERR, "Ошибка: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
?>
