# Week 2 Logic Exercises: B-PIS

Royal Institute of Management · Diploma in Information Technology · Full Stack Web Development
Control structures, arrays, strings and functions with B-PIS data (all data is fictional).

| | |
|---|---|
| Name | Neepan Kumal |
| Student ID | DIT/2025/4229 |
| Date | 08/10/2026 |

## Files

| File | What it is |
|---|---|
| `data.php` | The 8 exercise records in `$requests` (copied exactly, `cid` and `submitted` as strings) |
| `helpers.php` | Shared, tested functions: `tidy_name`, `is_pending`, `make_reference`, `wait_band`, `WORKFLOW` + `can_move`, `ROLE_TARGETS` + `can_move_as`, `is_valid_cid` |
| `ex1.php` | Exercise 1: predict the output (4 snippets) |
| `ex2.php` | Exercise 2: busiest Dzongkhag (loops only, ties handled) |
| `ex3.php` | Exercise 3: reference numbers for all 8 records, 3 tests, id 12345 |
| `ex4.php` | Exercise 4: waiting-time alert, summary line, edge tests |
| `ex5.php` | Exercise 5: status rules, 6 test moves, role extension |
| `ex6.php` | Exercise 6: original code kept in a comment, fixed version, bug log |
| `ex7.php` | Exercise 7: duplicate and invalid CIDs |
| `ANSWERS.md` | The written answers for the sheet's boxes (predictions, "Think about", bug log, reflection) |

Every `ex` file starts with the header from the sheet and has its plan written as `// Step` comments above the code.

## How to run

Needs PHP 8.x on the command line.

```
php ex1.php        # ... through ex7.php
```

`ex3.php`, `ex4.php` and `ex5.php` print `PASS` or `FAIL` for every test from the sheet.

## Checked against the sheet's expected output

| Exercise | Check | Result |
|---|---|---|
| 1 | A `none \| 0`, B `19`, C `BaC`, D `4ro` | matches |
| 2 | `Busiest: Paro (2 pending)` | exact match |
| 3 | `PAR-2026-0002`, `BUM-2026-0006`, `THI-2026-0001` | 3/3 PASS |
| 4 | 5 report lines plus `3 overdue · 1 follow up · 1 on time`; edges -1, 0, 7, 8, 14, 15 | exact match, 6/6 PASS |
| 5 | 6 moves and 3 role calls (plus an unknown-role check) | 10/10 PASS, no warnings |
| 6 | `count_pending($requests)` prints 5 | 5 |
| 7 | 2 duplicate lines and 2 invalid-CID lines | exact match |

All files pass `php -l` and run with `error_reporting=E_ALL` without a single warning, notice or deprecation.

## AI-use declaration

I used AI (Claude, by Anthropic) for this exercise sheet.

- **What I asked:** to solve the Week 2 sheet and organise the files into one project folder with a README and git commits.
- **What the AI produced:** all code in `data.php`, `helpers.php` and `ex1.php` to `ex7.php`, the draft answers in `ANSWERS.md`, and the commit history. The commits were created in a single session, so their timestamps are close together and do not show the pace of my own work.
- **How it was verified:** every file was run against the expected output on the sheet (table above), the original Exercise 6 code was run and fixed one bug at a time to record real error messages, and the files were linted and run with all PHP warnings switched on.

## Milestone checklist

- [x] `data.php` with the 8 exercise records
- [x] `helpers.php` with tested functions
- [x] `ex1.php` … `ex7.php`, one file per exercise
- [ ] Exercise 1 predictions written **before running** (do this yourself: your own predictions go in the PDF)
- [x] Bug log for Exercise 6 completed (`ex6.php` and `ANSWERS.md`)
- [x] A git commit after each exercise; README updated
