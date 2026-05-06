<?php
$viewFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
$patterns = [
    '__\(\s*\'([^\'\"]+)\'' => 1,
    '@lang\(\s*\'([^\'\"]+)\'' => 1,
    'trans\(\s*\'([^\'\"]+)\'' => 1,
];
$keys = [];
foreach ($viewFiles as $file) {
    if ($file->isFile() && $file->getExtension() === 'blade.php') {
        $content = file_get_contents($file->getPathname());
        foreach ($patterns as $pattern => $group) {
            if (preg_match_all($pattern, $content, $matches)) {
                foreach ($matches[1] as $key) {
                    $keys[$key] = true;
                }
            }
        }
    }
}
sort($keys);
echo "All translation keys used in views:\n";
print_r(array_keys($keys));
echo "\nTotal: " . count($keys) . "\n";
