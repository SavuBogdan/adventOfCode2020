<?php

/**
--- Day 11: Seating System ---
Your plane lands with plenty of time to spare. The final leg of your journey is a ferry that goes directly to the tropical island where you can finally start your vacation. As you reach the waiting area to board the ferry, you realize you're so early, nobody else has even arrived yet!

By modeling the process people use to choose (or abandon) their seat in the waiting area, you're pretty sure you can predict the best place to sit. You make a quick map of the seat layout (your puzzle input).

The seat layout fits neatly on a grid. Each position is either floor (.), an empty seat (L), or an occupied seat (#). For example, the initial seat layout might look like this:

L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL

Now, you just need to model the people who will be arriving shortly. Fortunately, people are entirely predictable and always follow a simple set of rules. All decisions are based on the number of occupied seats adjacent to a given seat (one of the eight positions immediately up, down, left, right, or diagonal from the seat). The following rules are applied to every seat simultaneously:

If a seat is empty (L) and there are no occupied seats adjacent to it, the seat becomes occupied.
If a seat is occupied (#) and four or more seats adjacent to it are also occupied, the seat becomes empty.
Otherwise, the seat's state does not change.
Floor (.) never changes; seats don't move, and nobody sits on the floor.

After one round of these rules, every seat in the example layout becomes occupied:

#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##

After a second round, the seats with four or more occupied adjacent seats become empty again:

#.LL.L#.##
#LLLLLL.L#
L.L.L..L..
#LLL.LL.L#
#.LL.LL.LL
#.LLLL#.##
..L.L.....
#LLLLLLLL#
#.LLLLLL.L
#.#LLLL.##
This process continues for three more rounds:

#.##.L#.##
#L###LL.L#
L.#.#..#..
#L##.##.L#
#.##.LL.LL
#.###L#.##
..#.#.....
#L######L#
#.LL###L.L
#.#L###.##

#.#L.L#.##
#LLL#LL.L#
L.L.L..#..
#LLL.##.L#
#.LL.LL.LL
#.LL#L#.##
..L.L.....
#L#LLLL#L#
#.LLLLLL.L
#.#L#L#.##

#.#L.L#.##
#LLL#LL.L#
L.#.L..#..
#L##.##.L#
#.#L.LL.LL
#.#L#L#.##
..L.L.....
#L#L##L#L#
#.LLLLLL.L
#.#L#L#.##

At this point, something interesting happens: the chaos stabilizes and further applications of these rules cause no seats to change state! Once people stop moving around, you count 37 occupied seats.

Simulate your seating area by applying the seating rules repeatedly until no seats change state. How many seats end up occupied?

Your puzzle answer was 2418.

--- Part Two ---
As soon as people start to arrive, you realize your mistake. People don't just care about adjacent seats - they care about the first seat they can see in each of those eight directions!

Now, instead of considering just the eight immediately adjacent seats, consider the first seat in each of those eight directions. For example, the empty seat below would see eight occupied seats:

.......#.
...#.....
.#.......
.........
..#L....#
....#....
.........
#........
...#.....

The leftmost empty seat below would only see one empty seat, but cannot see any of the occupied ones:

.............
.L.L.#.#.#.#.
.............

The empty seat below would see no occupied seats:

.##.##.
#.#.#.#
##...##
...L...
##...##
#.#.#.#
.##.##.

Also, people seem to be more tolerant than you expected: it now takes five or more visible occupied seats for an occupied seat to become empty (rather than four or more from the previous rules). The other rules still apply: empty seats that see no occupied seats become occupied, seats matching no rule don't change, and floor never changes.

Given the same starting layout as above, these new rules cause the seating area to shift around as follows:

L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL

#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##

#.LL.LL.L#
#LLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLL#
#.LLLLLL.L
#.LLLLL.L#

#.L#.##.L#
#L#####.LL
L.#.#..#..
##L#.##.##
#.##.#L.##
#.#####.#L
..#.#.....
LLL####LL#
#.L#####.L
#.L####.L#

#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##LL.LL.L#
L.LL.LL.L#
#.LLLLL.LL
..L.L.....
LLLLLLLLL#
#.LLLLL#.L
#.L#LL#.L#

#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.#L.L#
#.L####.LL
..#.#.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#

#.L#.L#.L#
#LLLLLL.LL
L.L.L..#..
##L#.#L.L#
L.L#.LL.L#
#.LLLL#.LL
..#.L.....
LLL###LLL#
#.LLLLL#.L
#.L#LL#.L#

Again, at this point, people stop shifting around and the seating area reaches equilibrium. Once this occurs, you count 26 occupied seats.

Given the new visibility method and the rule change for occupied seats becoming empty, once equilibrium is reached, how many seats end up occupied?

Your puzzle answer was 2144.
 */

$data = file_get_contents('Data/day11.txt');
$grid = splitGrid($data);

echo "Part 1 answer is ";
runRoundUntilNormalized($grid , 1);
echo PHP_EOL;
echo "Part 2 answer is ";
runRoundUntilNormalized($grid , 2);
echo PHP_EOL;

function splitGrid($data)
{
    $grid = [];
    foreach (explode(PHP_EOL, $data) as $lineIndex => $lineData) {
        $grid[$lineIndex] = str_split(trim($lineData));
    }
    return $grid;
}

function runRoundUntilNormalized($grid , $type = 1)
{
    $newGrid = $grid;
    foreach ($grid as $lineIndex => $line) {
        foreach ($line as $cellIndex => $cell) {
            if ($type == 1) {
                $adjacent = getAdjacentCells($lineIndex, $cellIndex, $grid);
            } elseif ($type == 2){
                $adjacent = getFirstVisibleCells($lineIndex, $cellIndex, $grid);
            } else {
                echo "Invalid type";
            }
            if ($cell == 'L' && substr_count(implode('', $adjacent), '#') == 0) {
                $newGrid[$lineIndex][$cellIndex] = '#';
            } elseif ($cell == '#' && substr_count(implode('', $adjacent), '#') >= (3 + $type)) {
                $newGrid[$lineIndex][$cellIndex] = 'L';
            } else {
                $newGrid[$lineIndex][$cellIndex] = $cell;
            }
        }
    }
    if ($newGrid != $grid) {
        runRoundUntilNormalized($newGrid , $type);
    } else {
        $str = constructString($newGrid);
        echo substr_count($str, '#');
    }
}

/**
 * @param $newGrid
 * @return string
 */
function constructString($newGrid): string
{
    $str = '';
    foreach ($newGrid as $line) {
        foreach ($line as $newCell) {
            $str .= $newCell;
        }
        $str .= PHP_EOL;
    }
    return $str;
}

function getAdjacentCells($rowIndex, $columnIndex, $grid)
{
    $rows = count($grid);
    $columns = count($grid[0]);
    $result = [];
    foreach ([-1, 0, 1] as $rowOffset) {
        foreach ([-1, 0, 1] as $columnOffset) {
            if ($rowOffset == 0 && $columnOffset == 0) {
                continue;
            }
            if (
                0 <= $rowIndex + $rowOffset && $rowIndex + $rowOffset < $rows &&
                0 <= $columnIndex + $columnOffset && $columnIndex + $columnOffset < $columns
            ) {
                $result[] = $grid[$rowIndex + $rowOffset][$columnIndex + $columnOffset];
            }
        }
    }
    return $result;
}

function getFirstVisibleCells($rowIndex, $columnIndex, $grid)
{
    $result = [];

    $left = $columnIndex != 0;
    $right = $columnIndex != count($grid[0]) - 1;
    $top = $rowIndex != 0;
    $bottom = $rowIndex != count($grid) - 1;

    //Top Left
    if ($top || $left) {
        $offsetColumn = -1;
        for ($i = $rowIndex - 1; $i >= 0; $i--) {
            for ($j = $columnIndex + $offsetColumn; $j >= 0; $j--) {
                $offsetColumn--;
                if ($grid[$i][$j] == 'L' || $grid[$i][$j] == '#') {
                    $result[] = $grid[$i][$j];
                    break 2;
                } else {
                    break 1;
                }
            }
        }
    }
    //Top
    if ($top) {
        for ($i = $rowIndex - 1; $i >= 0; $i--) {
            if ($grid[$i][$columnIndex] == 'L' || $grid[$i][$columnIndex] == '#') {
                $result[] = $grid[$i][$columnIndex];
                break 1;
            }
        }
    }
    //Top Right
    if ($top || $right) {
        $offsetColumn = 1;
        for ($i = $rowIndex - 1; $i >= 0; $i--) {
            for ($j = $columnIndex + $offsetColumn; $j < count($grid[0]); $j++) {
                $offsetColumn++;
                if ($grid[$i][$j] == 'L' || $grid[$i][$j] == '#') {
                    $result[] = $grid[$i][$j];
                    break 2;
                } else {
                    break 1;
                }
            }
        }
    }
    //Left
    if ($left) {
        for ($j = $columnIndex - 1; $j >= 0; $j--) {
            if ($grid[$rowIndex][$j] == 'L' || $grid[$rowIndex][$j] == '#') {
                $result[] = $grid[$rowIndex][$j];
                break 1;
            }
        }
    }
    //Right
    if ($right) {
        for ($j = $columnIndex + 1; $j < count($grid[0]); $j++) {
            if ($grid[$rowIndex][$j] == 'L' || $grid[$rowIndex][$j] == '#') {
                $result[] = $grid[$rowIndex][$j];
                break 1;
            }
        }
    }
    //Bottom Left
    if ($bottom || $left) {
        $offsetColumn = -1;
        for ($i = $rowIndex + 1; $i < count($grid); $i++) {
            for ($j = $columnIndex + $offsetColumn; $j >= 0; $j--) {
                $offsetColumn--;
                if ($grid[$i][$j] == 'L' || $grid[$i][$j] == '#') {
                    $result[] = $grid[$i][$j];
                    break 2;
                } else {
                    break 1;
                }
            }
        }
    }
    //Bottom
    if ($bottom) {
        for ($i = $rowIndex + 1; $i < count($grid); $i++) {
            if ($grid[$i][$columnIndex] == 'L' || $grid[$i][$columnIndex] == '#') {
                $result[] = $grid[$i][$columnIndex];
                break 1;
            }
        }
    }
    //Bottom Right
    if ($bottom || $right) {
        $offsetColumn = 1;
        for ($i = $rowIndex + 1; $i < count($grid); $i++) {
            for ($j = $columnIndex + $offsetColumn; $j < count($grid[0]); $j++) {
                $offsetColumn++;
                if ($grid[$i][$j] == 'L' || $grid[$i][$j] == '#') {
                    $result[] = $grid[$i][$j];
                    break 2;
                } else {
                    break 1;
                }
            }
        }
    }
    return $result;
}

