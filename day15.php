<?php

/**
 *
 */

$data = file_get_contents('Data/day15.txt');

$input = array_map('intval', explode(',', $data));
$input = array_combine(range(1, count($input)), array_values($input));
$input = array_flip($input);

$startTime = round(microtime(true) * 1000);
echo "Part 1 answer is " . findNthSpokenWord(2020, $input) . PHP_EOL;
echo 'Elapsed time ' . round(microtime(true) * 1000) - $startTime . "ms" . PHP_EOL;
$startTime = round(microtime(true) * 1000);
echo "Part 2 answer is " . findNthSpokenWord(30000000, $input) . PHP_EOL;
echo 'Elapsed time ' . round(microtime(true) * 1000) - $startTime . "ms" . PHP_EOL;


function findNthSpokenWord(int $limit, array $input)
{
    $turn = $last = null;
    $i = count($input);
    while ($i < $limit) {
        $last = empty($turn) ? 0 : $i - $turn;
        $turn = $input[$last] ?? null;
        $input[$last] = $i + 1;
        $i++;
    }
    return $last;
}

