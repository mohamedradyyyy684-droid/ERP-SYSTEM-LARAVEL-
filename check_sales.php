<?php
$en = include 'resources/lang/en/sales.php';
$ar = include 'resources/lang/ar/sales.php';
$missing = array_diff_key($en, $ar);
echo "Missing keys in ar/sales.php:\n";
print_r(array_keys($missing));
echo "\nCount: " . count($missing) . "\n";
