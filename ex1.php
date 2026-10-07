<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 1 · Predict the output
//
// Method:
// Step 1: write your prediction and a one-line reason for each snippet BEFORE running.
// Step 2: run this file and compare. If you were wrong, write down what you missed.
//
// Snippet A: ?: tests "truthy"; ?? tests "set and not null".
$x = 0;
$label = $x ?: 'none';
$size = $x ?? 'none';
echo "A: $label | $size\n";

// Snippet B: continue skips the rest of one round; break leaves the loop.
$total = 0;
for ($i = 1; $i <= 10; $i++) {
    if ($i % 3 === 0) {
        continue;
    }
    if ($i > 7) {
        break;
    }
    $total += $i;
}
echo "B: $total\n";

// Snippet C: the ternary picks strtoupper($k) or $k for each key.
$m = ['b' => 2, 'a' => 1, 'c' => 3];
$out = '';
foreach ($m as $k => $v) {
    $up = $v > 1;
    $out .= $up ? strtoupper($k) : $k;
}
echo "C: $out\n";

// Snippet D: trim first, then count; negative substr offsets count from the end.
$n = strlen(trim(' Paro '));
echo 'D: ' . $n . substr('Paro', -2) . "\n";
