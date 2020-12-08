<?php

/**
 *
 */

$data = file_get_contents('Data/day8.txt');

$instructions = parseInstructions($data);

[$successfulBoot, $accumulator] = bootSequence($instructions);
echo "Part 1 answer is " . $accumulator . PHP_EOL;
echo "Part 2 answer is " . selfHeal($instructions) . PHP_EOL;

function parseInstructions($data)
{
    $instructions = explode(PHP_EOL, $data);
    $parsedInstructions = [];
    foreach ($instructions as $index => $instruction) {
        $tmp = explode(' ', $instruction);
        $parsedInstructions[$index]['type'] = $tmp[0];
        $parsedInstructions[$index]['value'] = (int)$tmp[1];
        $parsedInstructions[$index]['wasRun'] = false;
    }
    return $parsedInstructions;
}

function bootSequence($instructions)
{
    $accumulator = 0;
    $index = 0;
    while (!$instructions[$index]['wasRun']) {
        $instructions[$index]['wasRun'] = true;
        switch ($instructions[$index]['type']) {
            case 'acc':
                $accumulator += $instructions[$index]['value'];
                $index++;
                break;
            case 'jmp':
                $index += $instructions[$index]['value'];
                break;
            default:
                $index++;
                break;
        }
        if ($instructions[count($instructions) - 1]['wasRun']) {
            return [true, $accumulator];
        }
    }
    return [false, $accumulator];
}

function selfHeal($instructions)
{
    foreach ($instructions as $index => $instructionOriginal) {
        $trial = $instructions;
        if ($trial[$index]['type'] == 'jmp') {
            $trial[$index]['type'] = 'nop';
            [$successfulBoot, $accumulator] = bootSequence($trial);
            if ($successfulBoot) {
                return $accumulator;
            }
        } elseif ($trial[$index]['type'] == 'nop') {
            $trial[$index]['type'] = 'jmp';
            [$successfulBoot, $accumulator] = bootSequence($trial);
            if ($successfulBoot) {
                return $accumulator;
            }
        }
    }
    return "Unable to boot";
}
