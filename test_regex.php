<?php

$str = "{{   ('finance.account details') ??   ('Account Details') }}";
echo "Input: $str\n";

$pattern = "/\(\s*'finance\.([a-z_]+)'\s*\)\s*\?\?\s*\(\s*'([^']+)'\s*\)/i";
$result = preg_replace_callback($pattern, function ($m) {
    return "'".$m[2]."'";
}, $str);

echo "Output: $result\n";
echo 'Matched: '.(preg_match($pattern, $str) ? 'YES' : 'NO')."\n";
