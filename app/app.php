<?php

declare(strict_types = 1);

// returns a file given its path
function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach(scandir($dirPath) as $file) 
    {
        if(is_dir($file)) 
        {
            continue;
        }

        $files[] = $dirPath . $file;
    }

    return $files;
}

//returns a list of transactions given a file, and handler
//different handlers can be written for different file schemas, making this function reusable
function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    if(!file_exists($fileName)) 
    {
        trigger_error('FILE NOT FOUND: '. ' file "' . $fileName . '" does not exist', E_USER_ERROR );
    }

    $file = fopen($fileName, 'r');

    //ignore header line
    fgetcsv($file);

    $transactions = [];

    while(($transaction = fgetcsv($file)) != false) 
    {
        if($transactionHandler != null) 
        {
            $transaction = $transactionHandler($transaction);
        }

        $transactions[] = $transaction;
    }

    return $transactions;
}

//returns an associative array of transaction data
function parseTransaction(array $transactionRow): array
{
    [$date, $checkNumber, $description, $amount] = $transactionRow;

    //re-format amount to be numerical (strip commas and dollar signs)
    $amount = (float)str_replace(['$', ','], '', $amount);

    return
    [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];
}

//calculates total balances given all the transactions
function getTotals(array $transactions): array
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach($transactions as $transaction)
    {
        $totals['netTotal'] += $transaction['amount'];

        if($transaction['amount'] >= 0)
        {
            $totals['totalIncome'] += $transaction['amount'];
        }

        else 
        {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}