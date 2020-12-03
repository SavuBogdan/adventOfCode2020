<?php

/**
 *
 */

$data = explode(PHP_EOL, file_get_contents('Data/day3.txt'));
foreach ($data as $index => $line) {
    $data[$index] = str_split($line);
}

$slopes = [
    ['x' => 1, 'y' => 1],
    ['x' => 3, 'y' => 1],
    ['x' => 5, 'y' => 1],
    ['x' => 7, 'y' => 1],
    ['x' => 1, 'y' => 2],
];


echo "Number of trees in path is : " . treeCollision($data, 3, 1) . PHP_EOL;
echo "Part 2 answer is : " . calculateMultipleSlopesMultiplied($data, $slopes) . PHP_EOL;


function calculateMultipleSlopesMultiplied($data, $slopes, $mul = 1)
{
    foreach ($slopes as $slope) {
        $mul *= treeCollision($data, $slope['x'], $slope['y']);
    }
    return $mul;
}

function treeCollision(&$data, $slopeX, $slopeY, $x = 0, $y = 0, &$trees = 0)
{
    if ($data[$y][$x % count($data[$y])] == '#') {
        $trees++;
    }
    if (isset($data[$y + $slopeY][($x + $slopeX) % count($data[$y])])) {
        treeCollision($data, $slopeX, $slopeY, $x + $slopeX, $y + $slopeY, $trees);
    }
    return $trees;
}


