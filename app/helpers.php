<?php

declare(strict_types = 1);

//returns a formatted dollar amount for a given numerical value
function formatDollarAmount(float $amount): string
{
    $isNegative = $amount < 0;

    return($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}

//returns a formatted date in format Jan 1, 1970 given a date in format MM/DD/YYYY
function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
}
