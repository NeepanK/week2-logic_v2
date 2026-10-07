<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 2 · Busiest Dzongkhag
// Question: which Dzongkhag has the most pending requests?
// Pending = Submitted or Under review.
// Rules: no max(), arsort() or array_count_values(); use loops and if.
//
// Plan
// Step 1: loop over every request and skip it unless it is pending.
// Step 2: tidy the Dzongkhag name so ' paro ' and 'Paro' are the same place.
// Step 3: add 1 to that Dzongkhag's counter (start it at 0 the first time we see it).
// Step 4: loop over the counters to find the highest count.
// Step 5: loop again and print EVERY Dzongkhag whose count equals the highest (ties).

// Steps 1-3: count
$counts = [];
foreach ($requests as $r) {
    if (!is_pending($r['status'])) {
        continue;
    }
    $place = tidy_name($r['dzongkhag']);
    if (!isset($counts[$place])) {
        $counts[$place] = 0;
    }
    $counts[$place]++;
}

// Step 4: find the highest count
$highest = 0;
foreach ($counts as $count) {
    if ($count > $highest) {
        $highest = $count;
    }
}

// Step 5: print every winner
foreach ($counts as $place => $count) {
    if ($count === $highest) {
        echo "Busiest: $place ($count pending)\n";
    }
}
