<?php

/**
--- Day 12: Rain Risk ---
Your ferry made decent progress toward the island, but the storm came in faster than anyone expected. The ferry needs to take evasive actions!

Unfortunately, the ship's navigation computer seems to be malfunctioning; rather than giving a route directly to safety, it produced extremely circuitous instructions. When the captain uses the PA system to ask if anyone can help, you quickly volunteer.

The navigation instructions (your puzzle input) consists of a sequence of single-character actions paired with integer input values. After staring at them for a few minutes, you work out what they probably mean:

Action N means to move north by the given value.
Action S means to move south by the given value.
Action E means to move east by the given value.
Action W means to move west by the given value.
Action L means to turn left the given number of degrees.
Action R means to turn right the given number of degrees.
Action F means to move forward by the given value in the direction the ship is currently facing.
The ship starts by facing east. Only the L and R actions change the direction the ship is facing. (That is, if the ship is facing east and the next instruction is N10, the ship would move north 10 units, but would still move east if the following action were F.)

For example:

F10
N3
F7
R90
F11
These instructions would be handled as follows:

F10 would move the ship 10 units east (because the ship starts by facing east) to east 10, north 0.
N3 would move the ship 3 units north to east 10, north 3.
F7 would move the ship another 7 units east (because the ship is still facing east) to east 17, north 3.
R90 would cause the ship to turn right by 90 degrees and face south; it remains at east 17, north 3.
F11 would move the ship 11 units south to east 17, south 8.
At the end of these instructions, the ship's Manhattan distance (sum of the absolute values of its east/west position and its north/south position) from its starting position is 17 + 8 = 25.

Figure out where the navigation instructions lead. What is the Manhattan distance between that location and the ship's starting position?

Your puzzle answer was 796.

--- Part Two ---
Before you can give the destination to the captain, you realize that the actual action meanings were printed on the back of the instructions the whole time.

Almost all of the actions indicate how to move a waypoint which is relative to the ship's position:

Action N means to move the waypoint north by the given value.
Action S means to move the waypoint south by the given value.
Action E means to move the waypoint east by the given value.
Action W means to move the waypoint west by the given value.
Action L means to rotate the waypoint around the ship left (counter-clockwise) the given number of degrees.
Action R means to rotate the waypoint around the ship right (clockwise) the given number of degrees.
Action F means to move forward to the waypoint a number of times equal to the given value.
The waypoint starts 10 units east and 1 unit north relative to the ship. The waypoint is relative to the ship; that is, if the ship moves, the waypoint moves with it.

For example, using the same instructions as above:

F10 moves the ship to the waypoint 10 times (a total of 100 units east and 10 units north), leaving the ship at east 100, north 10. The waypoint stays 10 units east and 1 unit north of the ship.
N3 moves the waypoint 3 units north to 10 units east and 4 units north of the ship. The ship remains at east 100, north 10.
F7 moves the ship to the waypoint 7 times (a total of 70 units east and 28 units north), leaving the ship at east 170, north 38. The waypoint stays 10 units east and 4 units north of the ship.
R90 rotates the waypoint around the ship clockwise 90 degrees, moving it to 4 units east and 10 units south of the ship. The ship remains at east 170, north 38.
F11 moves the ship to the waypoint 11 times (a total of 44 units east and 110 units south), leaving the ship at east 214, south 72. The waypoint stays 4 units east and 10 units south of the ship.
After these operations, the ship's Manhattan distance from its starting position is 214 + 72 = 286.

Figure out where the navigation instructions actually lead. What is the Manhattan distance between that location and the ship's starting position?

Your puzzle answer was 39446.
 */

$data = file_get_contents('Data/day12.txt');
echo "Part 1 solution is " . (new Day12($data, 'E'))->part1() . PHP_EOL;
echo "Part 2 solution is " . (new Day12($data, 'E'))->part2(1, 10) . PHP_EOL;


class Day12
{
    private array $instructions;
    private string $orientation;
    private int $x = 0;
    private int $y = 0;
    private int $traveledX = 0;
    private int $traveledY = 0;


    public function __construct(string $data, string $orientation)
    {
        $this->instructions = $this->parseData($data);
        $this->orientation = $orientation;
    }

    public function parseData(string $data): array
    {
        $instructions = [];
        foreach (explode(PHP_EOL, $data) as $instruction) {
            $instructions[] =
                [
                    'type' => substr($instruction, 0, 1),
                    'value' => (int)(substr($instruction, 1)),
                ];
        }
        return $instructions;
    }

    public function part1()
    {
        foreach ($this->instructions as $instruction) {
            $this->executeInstruction($instruction['type'], $instruction['value'], 1);
        }
        return abs($this->x) + abs($this->y);
    }

    public function part2($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        foreach ($this->instructions as $instruction) {
            $this->executeInstruction($instruction['type'], $instruction['value'], 2);
        }
        return abs($this->traveledX) + abs($this->traveledY);
    }

    private function setOrientations($offset)
    {
        $cardinals = ['N', 'E', 'S', 'W'];
        $currentOrientationKey = array_keys($cardinals, $this->orientation)[0];
        $newOrientationKey = (count($cardinals) + $currentOrientationKey + $offset) % 4;
        $this->orientation = $cardinals[$newOrientationKey];
    }

    private function rotateWaypoint($offset)
    {
        $quadrant = $this->findQuadrant();
        $quadrant = (4 + $quadrant + $offset) % 4;

        if (abs($offset % 2) == 1) {
            $tmp = $this->x;
            $this->x = $this->y;
            $this->y = $tmp;
        }

        switch ($quadrant) {
            case 1:
                $this->x = abs($this->x);
                $this->y = abs($this->y);
                break;
            case 2:
                $this->x = -abs($this->x);
                $this->y = abs($this->y);
                break;
            case 3:
                $this->x = -abs($this->x);
                $this->y = -abs($this->y);
                break;
            case 0:
                $this->x = abs($this->x);
                $this->y = -abs($this->y);
                break;
        }
    }

    private function executeInstruction(string $type, int $value, int $part)
    {
        switch ($type) {
            case 'N':
                $this->x += $value;
                break;
            case 'E':
                $this->y += $value;
                break;
            case 'S':
                $this->x -= $value;
                break;
            case 'W':
                $this->y -= $value;
                break;
            case 'F':
                if ($part == 2) {
                    $this->moveShip($value);
                }
                if ($part == 1) {
                    $this->executeInstruction($this->orientation, $value, 1);
                }
                break;
            case 'R':
                $this->setOrientations(floor($value / 90));
                if ($part == 2) {
                    $this->rotateWaypoint(floor($value / 90));
                }
                break;
            case 'L':
                $this->setOrientations(-floor($value / 90));
                if ($part == 2) {
                    $this->rotateWaypoint(-floor($value / 90));
                }
                break;
        }
    }

    private function findQuadrant()
    {
        if ($this->x >= 0 && $this->y >= 0) {
            return 1;
        }
        if ($this->x <= 0 && $this->y >= 0) {
            return 2;
        }
        if ($this->x <= 0 && $this->y <= 0) {
            return 3;
        }
        if ($this->x >= 0 && $this->y <= 0) {
            return 0;
        }

        throw new Exception("Invalid Quadrant");
    }

    private function moveShip(int $value)
    {
        $i = 1;
        while ($i <= $value) {
            $this->traveledX += $this->x;
            $this->traveledY += $this->y;
            $i++;
        }
    }
}



