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

function get_timespan_string($older, $newer) {
    $Y1 = $older->format('Y');
    $Y2 = $newer->format('Y');
    $Y = $Y2 - $Y1;

    $m1 = $older->format('m');
    $m2 = $newer->format('m');
    $m = $m2 - $m1;

    $d1 = $older->format('d');
    $d2 = $newer->format('d');
    $d = $d2 - $d1;

    $H1 = $older->format('H');
    $H2 = $newer->format('H');
    $H = $H2 - $H1;

    $i1 = $older->format('i');
    $i2 = $newer->format('i');
    $i = $i2 - $i1;

    $s1 = $older->format('s');
    $s2 = $newer->format('s');
    $s = $s2 - $s1;

    if($s < 0) {
        $i = $i -1;
        $s = $s + 60;
    }
    if($i < 0) {
        $H = $H - 1;
        $i = $i + 60;
    }
    if($H < 0) {
        $d = $d - 1;
        $H = $H + 24;
    }
    if($d < 0) {
        $m = $m - 1;
        $d = $d + get_days_for_previous_month($m2, $Y2);
    }
    if($m < 0) {
        $Y = $Y - 1;
        $m = $m + 12;
    }
    $timespan_string = create_timespan_string($Y, $m, $d, $H, $i, $s);
    return $timespan_string;
}

function get_days_for_previous_month($current_month, $current_year) {
    $previous_month = $current_month - 1;
    if($current_month == 1) {
        $current_year = $current_year - 1; //going from January to previous December
        $previous_month = 12;
    }
    if($previous_month == 11 || $previous_month == 9 || $previous_month == 6 || $previous_month == 4) {
        return 30;
    }
    else if($previous_month == 2) {
        if(($current_year % 4) == 0) { //remainder 0 for leap years
            return 29;
        }
        else {
            return 28;
        }
    }
    else {
        return 31;
    }
}

function create_timespan_string($Y, $m, $d, $H, $i, $s)
{
    $found_first_diff = false;
    $timespan_string = '';
    if($Y >= 1) {
        return FALSE;
    }
    if($m >= 1) {
        return FALSE;
    }
    if($d >= 1) {
        return FALSE;
    }
    if($H >= 1) {
        return FALSE;
    }
    if($i >= 1) {
        $found_first_diff = true;
        $timespan_string .= pluralize($i, 'minute');
    }
    if(!$found_first_diff) {
        $timespan_string .= pluralize($s, 'second');
    }
    return $timespan_string;
}

function pluralize( $count, $text )
{
    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
}