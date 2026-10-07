<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 3 · Reference numbers (make_reference() lives in helpers.php)
//
// Step 1: print a reference for all 8 records.
// Step 2: run the three tests from the sheet and show PASS or FAIL.
// Step 3: show what happens with id 12345 (see the decision comment in helpers.php).

// Step 1
foreach ($requests as $r) {
    echo make_reference($r['id'], $r['dzongkhag'], $r['submitted']) . "\n";
}

// Step 2
echo "\nTests\n";
$tests = [
    [2, ' paro ',   '2026-09-20', 'PAR-2026-0002'],
    [6, 'Bumthang', '2026-10-03', 'BUM-2026-0006'],
    [1, 'Thimphu',  '2026-09-14', 'THI-2026-0001'],
];
foreach ($tests as [$id, $place, $date, $expected]) {
    $actual = make_reference($id, $place, $date);
    $verdict = $actual === $expected ? 'PASS' : 'FAIL';
    echo "$verdict  make_reference($id, '$place', '$date') = $actual (expected $expected)\n";
}

// Step 3
echo "\nid 12345 -> " . make_reference(12345, 'Paro', '2026-09-20') . "\n";
