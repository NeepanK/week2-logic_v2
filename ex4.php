<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 4 · Waiting-time alert (wait_band() lives in helpers.php)
//
// Plan
// Step 1: set today's date and start three counters (overdue, follow up, on time).
// Step 2: loop over the requests and skip any that are not pending.
// Step 3: work out the days waited (line given by the sheet) and ask wait_band() for the band.
// Step 4: print "#id Name — N days — Band" using tidy names, and add 1 to the right counter.
// Step 5: print the summary line.
// Step 6: test the edges of wait_band().

// Step 1
$today = '2026-10-07';
$counts = ['Overdue' => 0, 'Follow up' => 0, 'On time' => 0];

// Steps 2-4
foreach ($requests as $r) {
    if (!is_pending($r['status'])) {
        continue;
    }
    $days = intdiv(strtotime($today) - strtotime($r['submitted']), 86400);
    $band = wait_band($days);
    $name = tidy_name($r['first']) . ' ' . tidy_name($r['last']);

    echo "#{$r['id']} $name — $days days — $band\n";

    if (isset($counts[$band])) {
        $counts[$band]++;
    }
}

// Step 5
echo "{$counts['Overdue']} overdue · {$counts['Follow up']} follow up · {$counts['On time']} on time\n";

// Step 6
echo "\nEdge tests\n";
$edges = [
    [-1, 'Check date'], [0, 'On time'], [7, 'On time'],
    [8, 'Follow up'], [14, 'Follow up'], [15, 'Overdue'],
];
foreach ($edges as [$edgeDays, $expected]) {
    $actual = wait_band($edgeDays);
    $verdict = $actual === $expected ? 'PASS' : 'FAIL';
    echo "$verdict  wait_band($edgeDays) = $actual (expected $expected)\n";
}
