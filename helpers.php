<?php
declare(strict_types=1);

/**
 * helpers.php — reusable functions for the Week 2 B-PIS exercises.
 * Functions are added one exercise at a time. None of them print anything.
 */

/**
 * Tidy a name or place: trim spaces, lowercase, then capitalise each word.
 * ' sonam ' -> 'Sonam', 'paro' -> 'Paro'
 */
function tidy_name(string $text): string
{
    return ucwords(strtolower(trim($text)));
}

/** A request is pending when it is Submitted or Under review. */
function is_pending(string $status): bool
{
    return $status === 'Submitted' || $status === 'Under review';
}

/**
 * Exercise 3: build a reference such as PAR-2026-0002.
 *   Part 1: first 3 letters of the Dzongkhag, in capitals (spaces trimmed first)
 *   Part 2: the year from the submitted date (YYYY-MM-DD)
 *   Part 3: the id as 4 digits
 *
 * Decision for ids above 9999 (e.g. 12345): %04d only pads, it never cuts digits,
 * so 12345 gives "PAR-2026-12345". That is acceptable: truncating would let two
 * different ids share one reference, and a reference must be unique. The reference
 * simply becomes one digit longer.
 */
function make_reference(int $id, string $dzongkhag, string $submitted): string
{
    $code = strtoupper(substr(trim($dzongkhag), 0, 3));
    $year = substr($submitted, 0, 4);

    return sprintf('%s-%s-%04d', $code, $year, $id);
}

/**
 * Exercise 4: band for the number of days a request has waited.
 *   below 0 -> Check date   0 to 7 -> On time   8 to 14 -> Follow up   15 or more -> Overdue
 * The negative case is tested first so a future date is never called "On time".
 */
function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    }
    if ($days <= 7) {
        return 'On time';
    }
    if ($days <= 14) {
        return 'Follow up';
    }

    return 'Overdue';
}

/**
 * Exercise 5: the B-PIS workflow rules as DATA.
 * Shape: current status => list of statuses it may move to.
 * Approved has an empty list because Approved is final.
 */
const WORKFLOW = [
    'Submitted'    => ['Under review'],
    'Under review' => ['Approved', 'Rejected'],
    'Rejected'     => ['Submitted'],   // resubmission
    'Approved'     => [],              // final
];

/**
 * May a request move from $from to $to?
 * "?? []" gives an empty list for an unknown status, so there is no
 * "Undefined array key" warning and the answer is simply false.
 */
function can_move(string $from, string $to): bool
{
    return in_array($to, WORKFLOW[$from] ?? [], true);
}

/** Extension: the statuses each role is allowed to move a request TO. */
const ROLE_TARGETS = [
    'officer'   => ['Under review'],             // Karma
    'approver'  => ['Approved', 'Rejected'],     // Choki
    'requester' => ['Submitted'],                // Pema
];

/** May this role make this move? The role must allow it AND the workflow must allow it. */
function can_move_as(string $role, string $from, string $to): bool
{
    return in_array($to, ROLE_TARGETS[$role] ?? [], true) && can_move($from, $to);
}

/** Exercise 7: a valid CID is exactly 11 characters, all digits. */
function is_valid_cid(string $cid): bool
{
    return strlen($cid) === 11 && ctype_digit($cid);
}
