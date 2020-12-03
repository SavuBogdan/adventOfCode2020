<?php

$year = (int)date('Y');
$day = (int)date('d');

$url = "https://adventofcode.com/$year/day/$day/input";
$payload = executeCurl($url);
$payload = implode(PHP_EOL,array_filter(explode(PHP_EOL,$payload)));
file_put_contents("Data/day$day.txt" , $payload);

function executeCurl($url)
{
    $cookies = implode('; ', explode(PHP_EOL, file_get_contents('../cookiesAdventOfCode2020.txt')));
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_COOKIE, $cookies);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($handle);
}