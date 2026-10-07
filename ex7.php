<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 7 · Duplicate and invalid CIDs (is_valid_cid() lives in helpers.php)
// Not allowed: array_count_values().
//
// Plan
// Step 1: loop over the requests and group the ids by CID: $groups[cid] = [id, id, ...].
// Step 2: loop over the groups and print only those with more than one id.
// Step 3: loop over the requests again and print every request whose CID is not valid.
//
// Note: PHP turns numeric-string array keys like '10101001234' into integers. Printing
// them is fine, but that is why step 3 loops over $requests (real strings) and not $groups:
// is_valid_cid(string $cid) would reject an integer under strict_types.

// Step 1
$groups = [];
foreach ($requests as $r) {
    $groups[$r['cid']][] = $r['id'];
}

// Step 2
foreach ($groups as $cid => $ids) {
    if (count($ids) > 1) {
        echo "Duplicate $cid: requests " . implode(', ', $ids) . "\n";
    }
}

// Step 3
foreach ($requests as $r) {
    if (!is_valid_cid($r['cid'])) {
        echo "Invalid CID in request {$r['id']}: {$r['cid']}\n";
    }
}
