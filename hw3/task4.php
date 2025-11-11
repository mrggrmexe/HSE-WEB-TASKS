<?php
/**
 * ФИО: Штукмайстер Г.П.
 * Вариант: 12
 * Задание 4
 * Условие: Вычислить α_j = Σβ_i + γ_j Σγ_k по введённым данным.
 */

function calcAlpha(array $betas, array $gammas): array {
    // Считаем суммы β и γ
    $sumBetas = array_sum($betas);
    $sumGammas = array_sum($gammas);
    $alphas = [];

    // Вычисляем каждый элемент α_j
    foreach ($gammas as $j => $gamma_j) {
        $alphas[$j + 1] = $sumBetas + $gamma_j * $sumGammas;
    }

    return $alphas;
}

/**
 * Чтение фиксированного количества чисел из консоли
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
    $betas = readFloatsExact(8, "Введите 8 β через пробел: ");
    $gammas = readFloatsExact(7, "Введите 7 γ через пробел: ");

    $alphas = calcAlpha($betas, $gammas);

    echo PHP_EOL . "Результаты вычисления α_j:" . PHP_EOL;
    foreach ($alphas as $j => $val) {
        printf("α_%d = %.3f\n", $j, $val);
    }

} catch (Exception $e) {
    fwrite(STDERR, "Ошибка: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
?>
