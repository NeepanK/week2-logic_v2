<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 6 · Find the bugs
//
// Method: run the ORIGINAL code, read every error and warning, fix ONE bug, run again.
// Bug log (what was seen, in the order each bug turns up):
//   1. Warning: Undefined array key "Status" (7 times)  -> key is 'status' (lowercase)
//   2. Fatal TypeError: Return value must be of type int, none returned
//                                                        -> add "return $total;"
//   3. Prints 0 (silent)  -> "$total + 1;" calculates but never stores; use "$total++;"
//   4. Prints 7 (silent)  -> "=" assigns (and || binds tighter than =), so $status becomes
//                            true for every record; use "==="
//   5. Prints 4 (silent)  -> loop started at $i = 1, so record 0 was skipped; start at 0
//
// The original code from the sheet (kept for the record):
/*
function count_pending(array $requests): int
{
    $total = 0;
    for ($i = 1; $i < count($requests); $i++) {
        $status = $requests[$i]['Status'];
        if ($status = 'Submitted' || $status === 'Under review') {
            $total + 1;
        }
    }
}
echo count_pending($requests); // should print 5
*/

// The fixed version:
function count_pending(array $requests): int
{
    $total = 0;
    for ($i = 0; $i < count($requests); $i++) {                    // bug 5: start at 0
        $status = $requests[$i]['status'];                         // bug 1: lowercase key
        if ($status === 'Submitted' || $status === 'Under review') {   // bug 4: ===
            $total++;                                              // bug 3: store the new total
        }
    }

    return $total;                                                 // bug 2: return the result
}

echo count_pending($requests) . "\n"; // should print 5
