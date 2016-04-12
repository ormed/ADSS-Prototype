<?php

/**
 * function get param and write it to php error log
 * used for debug
 *
 * @param $var - param to be written in error log
 * @param $readable - TRUE for readable state .
 */
function debug($var, $readable = TRUE)
{
    $dump = $readable ? print_r($var, TRUE) : var_export($var, TRUE);
    error_log(("==============================\n\n" . $dump . "\n"), 0);
}

//method that clean the input from things we dont want 
//return clean data
function cleanInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function array_median($array) {
    // perhaps all non numeric values should filtered out of $array here?
    $iCount = count($array);
    if ($iCount == 0) {
        throw new DomainException('Median of an empty array is undefined');
    }
    // if we're down here it must mean $array
    // has at least 1 item in the array.
    $middle_index = floor($iCount / 2);
    sort($array, SORT_NUMERIC);
    $median = $array[$middle_index]; // assume an odd # of items
    // Handle the even case by averaging the middle 2 items
    if ($iCount % 2 == 0) {
        $median = ($median + $array[$middle_index - 1]) / 2;
    }
    return $median;
}

/**
 * Gets result label from associated data
 *
 * @param array $data
 * @param array $neighbors Result from getNearestNeighbors()
 * @return string label
 */
function getLabel($data, $neighbors)
{
    $results = array();
    $neighbors = array_keys($neighbors);
    foreach ($neighbors as $neighbor) {
        $results[] = $data[$neighbor][2];
    }
    $values = array_count_values($results);
    $values = array_flip($values);
    ksort($values);
    return array_pop($values);
}
