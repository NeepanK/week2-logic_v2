# Written answers for the Week 2 sheet

Draft answers for the boxes in the PDF. Read them, check them against the code, and
**rewrite them in your own words** before you hand in. The weekly reflection is personal,
so the parts only you can answer are marked _(yours)_.

---

## Exercise 1: Predict the output

| Snippet | Prediction | One-line reason |
|---|---|---|
| A | `none \| 0` | `?:` treats `0` as falsy so it picks `'none'`; `??` only replaces null or unset, and `$x` is set to `0`, so it keeps `0`. |
| B | `19` | Adds 1, 2, 4, 5, 7 (skips 3 and 6 with `continue`); at 8 the `> 7` test hits `break`. |
| C | `BaC` | `b` and `c` have values above 1 so they are uppercased; `a` stays lowercase. |
| D | `4ro` | `trim` leaves `Paro` (4 characters); `substr('Paro', -2)` is the last two letters, `ro`. |

Traps to watch for (what people usually miss): `?:` and `??` look similar but test different
things; in B the `continue` runs before the `break` check, and 8 is not a multiple of 3 so it reaches `break`;
in D the length is taken **after** trimming.

## Exercise 2: Busiest Dzongkhag

**What does your program print if you forget to tidy the Dzongkhag names? Why?**
`' paro '` and `'Paro'` become two different array keys with 1 pending request each.
Then Thimphu, ' paro ', Paro, Bumthang and Punakha all tie on 1, so the program prints all five as
"busiest" and the true answer (Paro, 2 pending) is lost.

## Exercise 3: Reference numbers

**What happens with id 12345? Is that acceptable? Decide, and explain.**
`%04d` only pads, it never cuts, so the result is `PAR-2026-12345`. I decided this is acceptable:
cutting digits would let two different ids share one reference, and a reference must be unique.
(This is also written as a comment above `make_reference()` in `helpers.php`.)

## Exercise 4: Waiting-time alert

Edge results:

| `wait_band(...)` | -1 | 0 | 7 | 8 | 14 | 15 |
|---|---|---|---|---|---|---|
| My result | Check date | On time | On time | Follow up | Follow up | Overdue |

**Which edge cases did you get wrong first, and why?** _(yours)_ Common slips are 7 and 14
(using `<` instead of `<=`) and -1 (checking `$days < 0` after the other tests, so a future date
is called "On time").

## Exercise 5: Status rules

**Why is storing the rules in an array better than a long if/elseif chain?**
The rules are data, so changing the workflow means editing one array and not the logic.
The code stays short, `can_move_as()` can reuse `can_move()`, the array is easy to read and test,
and unknown statuses are handled in one place (`?? []`) instead of in every branch.

## Exercise 6: Find the bugs

Run the original, fix one bug, run again. What was actually seen:

| # | Symptom (what I saw) | Cause | Fix |
|---|---|---|---|
| 1 | `Warning: Undefined array key "Status"` printed 7 times | The key is `status` (lowercase); PHP keys are case-sensitive | `['status']` |
| 2 | `Fatal error: Uncaught TypeError: count_pending(): Return value must be of type int, none returned` | The function has no `return` | `return $total;` |
| 3 | Prints `0` (no error) | `$total + 1;` calculates a value and throws it away | `$total++;` |
| 4 | Prints `7` (no error) | `=` assigns instead of comparing, and `||` binds tighter than `=`, so `$status` becomes `true` for every record | `$status === 'Submitted' \|\| ...` |
| 5 | Prints `4` instead of 5 (no error) | The loop starts at `$i = 1`, so record 0 (Pema, Submitted) is never counted | `$i = 0` |

**Which bugs were hardest to find, and why?** Bugs 3, 4 and 5 are the hardest because PHP prints no
error for them; the only clue is a wrong number (0, 7, then 4). Bug 4 is the trickiest of all:
the code looks like a comparison, but one missing `=` makes it an assignment.

## Exercise 7: Duplicate and invalid CIDs

**Is a duplicate always an error? What should Karma do?**
No. One person can legitimately file more than one request, so the same CID twice can be fine.
But requests 1 and 4 share a CID with different names (Pema Wangmo and Tashi Penjor), which points to a typing
mistake or an identity problem. Karma should check both requests against the source record before
approving or rejecting either one, and should not delete either automatically.
Requests 3 and 7 share a CID with different names too, so the same check applies.

---

## Weekly reflection

1. **Which exercise made you think hardest, and why?** _(yours)_
2. **One bug I met: its cause and my fix.** Draft from Exercise 6: `if ($status = 'Submitted' || ...)` made every
   request count as pending because `=` assigns instead of comparing. I fixed it by using `===`, and found it
   because the count was wrong (7) with no error message.
3. **Did I use AI? What did I ask, accept or reject, and how did I verify it?** _(yours; start from the
   AI-use declaration in `README.md`)_
