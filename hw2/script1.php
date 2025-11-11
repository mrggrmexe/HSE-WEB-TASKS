<?php

function calculateTask1($K, $L, $x) {
    if ($K * $L * $x == 0) {
        throw new InvalidArgumentException("Ошибка: K, L и x не должны быть нулевыми");
    }
    
    if (!is_numeric($K) || !is_numeric($L) || !is_numeric($x)) {
        throw new InvalidArgumentException("Ошибка: Все параметры должны быть числами");
    }

    // T = cos²x (K² - L²) / (K * L * x)
    $cosX = cos($x);
    $numeratorT = pow($cosX, 2) * (pow($K, 2) - pow($L, 2));
    $denominatorT = $K * $L * $x;
    $T = $numeratorT / $denominatorT;

    // Q = √(T² * |K - L| / 0.25)
    $numeratorQ = pow($T, 2) * abs($K - $L);
    $Q = sqrt($numeratorQ / 0.25);

    return [
        'T' => $T,
        'Q' => $Q,
        'intermediate' => [
            'cos(x)' => $cosX,
            'cos²(x)' => pow($cosX, 2),
            'K² - L²' => pow($K, 2) - pow($L, 2),
            'числитель T' => $numeratorT,
            'знаменатель T' => $denominatorT
        ]
    ];
}

function testTask1() {
    echo "ТЕСТИРОВАНИЕ ЗАДАНИЯ 1\n\n";
    
    // Тест 1: Нормальные данные
    echo "Тест 1: Нормальные данные (K=2, L=3, x=1.5)\n";
    try {
        $result = calculateTask1(2, 3, 1.5);
        echo "T = " . number_format($result['T'], 6) . "\n";
        echo "Q = " . number_format($result['Q'], 6) . "\n";
        echo "Промежуточные значения:\n";
        foreach ($result['intermediate'] as $key => $value) {
            echo "  $key = " . number_format($value, 6) . "\n";
        }
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 2: Отрицательные значения
    echo "Тест 2: Отрицательные значения (K=-2, L=3, x=0.5)\n";
    try {
        $result = calculateTask1(-2, 3, 0.5);
        echo "T = " . number_format($result['T'], 6) . "\n";
        echo "Q = " . number_format($result['Q'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 3: Нулевой x (должна быть ошибка)
    echo "Тест 3: Нулевой x (K=2, L=3, x=0)\n";
    try {
        $result = calculateTask1(2, 3, 0);
        echo "T = " . number_format($result['T'], 6) . "\n";
        echo "Q = " . number_format($result['Q'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОЖИДАЕМАЯ ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 4: Нулевой K (должна быть ошибка)
    echo "Тест 4: Нулевой K (K=0, L=3, x=1)\n";
    try {
        $result = calculateTask1(0, 3, 1);
        echo "T = " . number_format($result['T'], 6) . "\n";
        echo "Q = " . number_format($result['Q'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОЖИДАЕМАЯ ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 5: Большие значения
    echo "Тест 5: Большие значения (K=10, L=5, x=2)\n";
    try {
        $result = calculateTask1(10, 5, 2);
        echo "T = " . number_format($result['T'], 6) . "\n";
        echo "Q = " . number_format($result['Q'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n";
    
    // Тест 6: Дробные значения
    echo "Тест 6: Дробные значения (K=2.5, L=1.5, x=0.75)\n";
    try {
        $result = calculateTask1(2.5, 1.5, 0.75);
        echo "T = " . number_format($result['T'], 6) . "\n";
        echo "Q = " . number_format($result['Q'], 6) . "\n";
        echo "Статус: УСПЕХ\n";
    } catch (Exception $e) {
        echo "Статус: ОШИБКА - " . $e->getMessage() . "\n";
    }
    echo "\n\n";
}

testTask1();
?>
