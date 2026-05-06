<?php
$en = include 'resources/lang/en/dashboard.php';
$ar = include 'resources/lang/ar/dashboard.php';
$missing = array_diff_key($en, $ar);
echo "Missing keys in ar/dashboard.php:\n";
print_r(array_keys($missing));
echo "\nCount: " . count($missing) . "\n";
