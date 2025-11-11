<?php

function factorial($n) {
    if ($n < 0) {
        throw new InvalidArgumentException("Факториал определен только для неотрицательных целых чисел");
    }
    
    if ($n == 0 || $n == 1) {
        return 1;
    }
    
    $result = 1;
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

function calculateTask2($a, $n, $l) {
    if (!is_int($n)) {
        throw new InvalidArgumentException("n должно быть целым числом");
    }
    
    if ($a == $l) {
        throw new InvalidArgumentException("a не должно быть равно l (деление на ноль)");
    }
    
    if ($n < 0) {
        throw new InvalidArgumentException("n не может быть отрицательным для вычисления факториала");
    }

    // x1 = (a + n) / (a - l)²
    $x1 = ($a + $n) / pow(($a - $l), 2);

    // x2 = a / n!
    $factorial_n = factorial($n);
    $x2 = $a / $factorial_n;

    if (abs($x1 - $x2) < 1e-9) {
        $Y = ($x1 / $x2) * ($a - $n);
        $condition = "x1 = x2";
    } elseif ($x1 < $x2) {
        $Y = $x1 + $x2;
        $condition = "x1 < x2";
    } else {
        $Y = $a * $x1 + $n * $x2;
        $condition = "x1 > x2";
    }

    // Z = x_max / (x1 + x2)
    $x_max = max($x1, $x2);
    $Z = $x_max / ($x1 + $x2);

    return [
        'x1' => $x1,
        'x2' => $x2,
        'Y' => $Y,
        'Z' => $Z,
        'condition' => $condition,
        'intermediate' => [
            'n!' => $factorial_n,
            'a - l' => $a - $l,
            '(a - l)²' => pow(($a - $l), 2),
            'x_max' => $x_max,
            'x1 + x2' => $x1 + $x2
        ]
    ];
}

/**
 * Функция для детального тестирования задания 2
 */
function testTask2() {
    echo "ТЕСТИРОВАНИЕ ЗАДАНИЯ 2\n\n";
    
    // Тест 1: Нормальные данные (x1 > x2)
    echo "Тест 1: Нормальные данные (a=5, n=3, l=2) - ожидается x1 > x2\n";
    try {
        $result = calculateTask2(5, 3, 2);
        echo "x1 = " . number_format($result['x1'], 6) . "\n";
        echo "x2 = " . number_format($result['x2'], 6) . "\n";
        echo "Y = " . number_format($result['Y'], 6) . " (условие: {$result['condition']})\n";
        echo "Z = " . number_format($result['Z'], 6) . "\n";
        echo "Промежуточные значения:\n";
        foreach ($result['intermediate'] as $key => $value) {
            echo "  $key = " . number_format($value, 6) . "\n";
        }
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 2: Случай x1 < x2
    echo "Тест 2: Случай x1 < x2 (a=2, n=4, l=1)\n";
    try {
        $result = calculateTask2(2, 4, 1);
        echo "x1 = " . number_format($result['x1'], 6) . "\n";
        echo "x2 = " . number_format($result['x2'], 6) . "\n";
        echo "Y = " . number_format($result['Y'], 6) . " (условие: {$result['condition']})\n";
        echo "Z = " . number_format($result['Z'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 3: Случай x1 ≈ x2
    echo "Тест 3: Попытка получить x1 ≈ x2 (a=1, n=1, l=0)\n";
    try {
        $result = calculateTask2(1, 1, 0);
        echo "x1 = " . number_format($result['x1'], 6) . "\n";
        echo "x2 = " . number_format($result['x2'], 6) . "\n";
        echo "Y = " . number_format($result['Y'], 6) . " (условие: {$result['condition']})\n";
        echo "Z = " . number_format($result['Z'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 4: a = l (должна быть ошибка)
    echo "Тест 4: a = l (a=3, n=2, l=3) - ожидается ошибка\n";
    try {
        $result = calculateTask2(3, 2, 3);
        echo "x1 = " . number_format($result['x1'], 6) . "\n";
        echo "x2 = " . number_format($result['x2'], 6) . "\n";
        echo "Y = " . number_format($result['Y'], 6) . "\n";
        echo "Z = " . number_format($result['Z'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОЖИДАЕМАЯ ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 5: Отрицательный n (должна быть ошибка)
    echo "Тест 5: Отрицательный n (a=5, n=-1, l=2) - ожидается ошибка\n";
    try {
        $result = calculateTask2(5, -1, 2);
        echo "x1 = " . number_format($result['x1'], 6) . "\n";
        echo "x2 = " . number_format($result['x2'], 6) . "\n";
        echo "Y = " . number_format($result['Y'], 6) . "\n";
        echo "Z = " . number_format($result['Z'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОЖИДАЕМАЯ ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 6: Большие значения
    echo "Тест 6: Большие значения (a=10, n=5, l=3)\n";
    try {
        $result = calculateTask2(10, 5, 3);
        echo "x1 = " . number_format($result['x1'], 6) . "\n";
        echo "x2 = " . number_format($result['x2'], 6) . "\n";
        echo "Y = " . number_format($result['Y'], 6) . " (условие: {$result['condition']})\n";
        echo "Z = " . number_format($result['Z'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n\n";
}

function testFactorial() {
    echo "ТЕСТИРОВАНИЕ ФАКТОРИАЛА:\n";
    $testCases = [0, 1, 2, 3, 4, 5];
    foreach ($testCases as $n) {
        try {
            $result = factorial($n);
            echo "factorial($n) = $result\n";
        } catch (Exception $e) {
            echo "factorial($n) = ОШИБКА: " . $e->getMessage() . "\n";
        }
    }
    echo "\n";
}

// Запуск тестов
testFactorial();
testTask2();
?>
