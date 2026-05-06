<?php
$en = include 'resources/lang/en/warehouse.php';
$ar = include 'resources/lang/ar/warehouse.php';
$missing = array_diff_key($en, $ar);
echo "Missing keys in ar/warehouse.php:\n";
print_r(array_keys($missing));
echo "\nCount: " . count($missing) . "\n";
