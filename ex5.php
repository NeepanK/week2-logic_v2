<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 5 · Status rules (WORKFLOW, can_move() and can_move_as() live in helpers.php)
//
// Plan
// Step 1: the rules are stored in one array (WORKFLOW) in helpers.php.
// Step 2: can_move() looks up the list for $from and checks $to is in it. No if/elseif per status.
// Step 3: store the test moves AND their expected answers in an array, then loop and print.
// Step 4 (extension): can_move_as() checks the role's allowed targets, then reuses can_move().

// Step 3
echo "Moves\n";
$moves = [
    ['Submitted',    'Under review', 'Allowed'],
    ['Submitted',    'Approved',     'Blocked'],
    ['Under review', 'Rejected',     'Allowed'],
    ['Approved',     'Submitted',    'Blocked'],
    ['Rejected',     'Submitted',    'Allowed'],
    ['Closed',       'Submitted',    'Blocked'],   // unknown status: no warning, just Blocked
];
foreach ($moves as [$from, $to, $expected]) {
    $actual = can_move($from, $to) ? 'Allowed' : 'Blocked';
    $verdict = $actual === $expected ? 'PASS' : 'FAIL';
    echo "$verdict  $from → $to: $actual (expected $expected)\n";
}

// Step 4
echo "\nMoves by role\n";
$roleTests = [
    ['officer',   'Under review', 'Approved',     false],
    ['approver',  'Under review', 'Approved',     true],
    ['requester', 'Rejected',     'Submitted',    true],
    ['visitor',   'Submitted',    'Under review', false],   // unknown role: false, no warning
];
foreach ($roleTests as [$role, $from, $to, $expected]) {
    $actual = can_move_as($role, $from, $to);
    $verdict = $actual === $expected ? 'PASS' : 'FAIL';
    $shownActual = $actual ? 'true' : 'false';
    $shownExpected = $expected ? 'true' : 'false';
    echo "$verdict  can_move_as('$role', '$from', '$to') = $shownActual (expected $shownExpected)\n";
}
