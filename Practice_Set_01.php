<?php

/**
 * Calculate the total price of items.
 *
 * @param array
 * @return float The total price of the items.
 */
function calculateTotalPrice(array $items): float {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

$items = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];

$totalPrice = calculateTotalPrice($items);
echo "Total price: $" . $totalPrice . "\n";

/**
 * Remove space and turn into lowercase character.
 *
 * @param string $string The string to modify.
 * @return string The modified string.
 */
function modifyString(string $string): string {
    $string = str_replace(' ', '', $string);
    return strtolower($string);
}

$string = "This is a poorly written program with little structure and readability.";
$modifiedString = modifyString($string);
echo "Modified string: " . $modifiedString . "\n";

/**
 * Check if even or odd.
 *
 * @param int $Check number.
 * @return string printing if even or odd number.
 */
function checkEvenOdd(int $number): string {
    if ($number % 2 === 0) {
        return "The number " . $number . " is even.";
    } else {
        return "The number " . $number . " is odd.";
    }
}

$number = 42;
echo checkEvenOdd($number) . "\n";

