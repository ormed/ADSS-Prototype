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
 * Calculates eucilean distances for an array dataset
 *
 * @param array $sourceCoords In format array(x, y)
 * @param array $sourceKey Associated array key
 * @param array $data
 * @return array Of distances to the rest of the data set
 */
function euclideanDistance($sourceCoords, $sourceKey, $data)
{
    $distances = array();
    list ($x1, $y1) = $sourceCoords;
    foreach ($data as $destinationKey => $destinationCoords) {
        // Same point, ignore
        if ($sourceKey == $destinationKey) {
            continue;
        }
        list ($x2, $y2) = $destinationCoords;
        $distances[$destinationKey] = sqrt(pow($x1 - $x2, 2) + pow($y1 - $y2, 2));
    }
    asort($distances);
    $sourceCoords = $distances;
}

/**
 * Returns n-nearest neighbors
 *
 * @param array $distances Distances generated above ^
 * @param mixed $key Array key of source location
 * @param int $num Of neighbors to fetch
 * @return array Of nearest neighbors
 */
function getNearestNeighbors($distances, $key, $num)
{
    return array_slice($distances[$key], 0, $num, true);
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
